<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Documentation
{
    public readonly string $version;

    public function __construct(public readonly string $locale, ?string $version = null)
    {
        $this->version = $version ?? self::latest();

        abort_unless(in_array($this->version, self::versions(), true), 404);
        abort_unless(in_array($locale, ['en', 'ru'], true), 404);
        abort_unless($this->hasPage('index'), 404);
    }

    public static function versions(): array
    {
        $versions = array_map('basename', glob(base_path('docs/*.x'), GLOB_ONLYDIR));
        usort($versions, fn (string $left, string $right) => version_compare($right, $left));

        return $versions;
    }

    public static function latest(): string
    {
        return '14.x';
    }

    public function isDevelopment(): bool
    {
        return version_compare($this->version, self::latest(), '>');
    }

    public function path(string $page): string
    {
        $page = preg_replace('~/index$~', '', $page);
        $path = "$this->version/$this->locale/$page.md";

        return ! Storage::disk('docs')->exists($path)
            && Storage::disk('docs')->exists("$this->version/$this->locale/$page/index.md")
                ? "$this->version/$this->locale/$page/index.md"
                : $path;
    }

    public function hasPage(string $page): bool
    {
        return preg_match('~^[a-z0-9_-]+(?:/[a-z0-9_-]+)*$~iD', $page)
            && Storage::disk('docs')->exists($this->path($page));
    }

    public function url(string $page = 'index'): string
    {
        $page = preg_replace('~/index$~', '', $page);

        return "/$this->locale/docs".($this->version === self::latest() ? '' : "/$this->version").($page === 'index' ? '' : "/$page");
    }

    public function navigation(): array
    {
        $navigation = json_decode(file_get_contents(base_path("docs/$this->version/navigation.json")), true, 512, JSON_THROW_ON_ERROR);

        foreach ($navigation[$this->locale] ?? [] as $title => $links) {
            foreach ($links as $label => $url) {
                $navigation[$this->locale][$title][$label] = $this->rewriteUrl($url);
            }
        }

        return $navigation[$this->locale] ?? [];
    }

    public function switcher(string $page): array
    {
        $links = [];

        foreach (self::versions() as $version) {
            if (! Storage::disk('docs')->exists("$version/$this->locale/index.md")) {
                continue;
            }

            $documentation = new self($this->locale, $version);
            $links[$version] = $documentation->url($documentation->hasPage($page) ? $page : 'index');
        }

        return $links;
    }

    public function rewriteUrl(string $url): string
    {
        $parts = parse_url($url);

        if ($parts === false || isset($parts['host']) && ! in_array($parts['host'], ['orchid.software', 'www.orchid.software'], true)) {
            return $url;
        }

        $path = $parts['path'] ?? '';
        $path = preg_replace('~^/eb/docs(?=/|$)~', '/en/docs', $path);
        if (preg_match('~^(?:en|ru)/docs(?:/|$)~', $path)) {
            $path = '/'.$path;
        }
        if (! preg_match('~^/(en|ru)/(?:docs|documentation)(?:/(.*))?$~', $path, $matches)) {
            return $url;
        }

        $page = trim($matches[2] ?? '', '/');
        $version = $this->version;
        if (preg_match('~^(\d+\.x)(?:/(.*))?$~', $page, $explicit)) {
            $version = $explicit[1];
            $page = $explicit[2] ?? 'index';
        }

        $page = preg_replace('~(?:\.html|\.md)$~', '', $page);
        $page = $page === '' ? 'index' : $page;

        return "/{$matches[1]}/docs".($version === self::latest() ? '' : "/$version").($page === 'index' ? '' : "/$page")
            .(isset($parts['query']) ? '?'.$parts['query'] : '')
            .(isset($parts['fragment']) ? '#'.$parts['fragment'] : '');
    }

    public static function exportPaths(): array
    {
        $paths = [];
        $latest = self::latest();

        foreach (self::versions() as $version) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(base_path("docs/$version"), \FilesystemIterator::SKIP_DOTS));

            foreach ($files as $file) {
                if ($file->getExtension() !== 'md') {
                    continue;
                }

                $path = substr($file->getPathname(), strlen(base_path("docs/$version/")), -3);
                [$locale, $page] = explode('/', $path, 2);
                if (! in_array($locale, ['en', 'ru'], true)) {
                    continue;
                }

                $suffix = $page === 'index' ? '' : "/$page";
                $paths[] = "/$locale/docs/$version$suffix";

                if (str_ends_with($page, '/index')) {
                    $paths[] = "/$locale/docs/$version/".substr($page, 0, -6);
                }

                if ($version === $latest) {
                    $paths[] = "/$locale/docs$suffix";
                }
            }
        }

        return $paths;
    }
}
