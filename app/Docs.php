<?php

namespace App;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravelsu\Highlight\CommonMark\HighlightExtension;
use Symfony\Component\Yaml\Yaml;

class Docs
{
    protected ?Documentation $documentation = null;

    protected string $page;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $locale
     * @param string $path
     */
    public function __construct(string $locale, string $path, ?string $version = null)
    {
        app()->setLocale($locale);

        $this->locale = $locale;
        $this->path = "/$locale/$path.md";

        abort_unless(preg_match('~^[a-z0-9_-]+(?:/[a-z0-9_-]+)*$~iD', $path), 404);

        if (Str::startsWith($path, 'docs/')) {
            $this->documentation = new Documentation($locale, $version);
            $this->page = Str::after($path, 'docs/');
            $this->path = $this->documentation->path($this->page);
        }
    }

    /**
     * @param string $view
     *
     * @throws FileNotFoundException
     *
     * @return View|RedirectResponse
     */
    public function view(string $view)
    {
        abort_unless(Storage::disk('docs')->exists($this->path), 404);

        $page = Storage::disk('docs')->get($this->path);
        $variables = Yaml::parse(Str::of($page)->after('---')->before('---'));

        if ($this->documentation && (isset($variables['redirect']) || request()->route('version') === Documentation::latest())) {
            $target = isset($variables['redirect'])
                ? $this->documentation->rewriteUrl($variables['redirect'])
                : $this->documentation->url($this->page);
            $target = rtrim($target, '/').'/';

            if (! request()->headers->has('X-Laravel-Export')) {
                return redirect()->away(url(rtrim($target, '/')).'/'.(request()->getQueryString() ? '?'.request()->getQueryString() : ''), 301);
            }

            return view('documentation-redirect', ['target' => $target, 'locale' => $this->locale]);
        }

        $all = collect()->merge($variables)->merge([
            'content' => Str::of($page)->after('---')->after('---')->markdown(
                extensions: [new HighlightExtension()]
            ),
            'edit'          => $this->editLinkGitHub(),
            'documentation' => $this->documentation,
            'docPage'       => $this->page ?? null,
            'canonical'     => $this->documentation ? $this->documentation->url($this->page).'/' : null,
        ]);

        return view($view, $all);
    }

    /**
     * @return string
     */
    protected function editLinkGitHub()
    {
        return 'https://github.com/orchidsoftware/orchid.software/edit/master/docs/'.ltrim($this->path, '/');
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    public static function ahref(string $locale, bool $fallback = true)
    {
        $path = parse_url(URL::current(), PHP_URL_PATH) ?: '/';

        if (preg_match('~^/(?:en|ru)/docs(?:/([^/]+))?(?:/(.*))?/?$~', $path, $matches)) {
            $version = $matches[1] ?? '';
            $page = $matches[2] ?? 'index';

            if (! preg_match('~^\d+\.x$~', $version)) {
                $page = trim($version.'/'.($matches[2] ?? ''), '/') ?: 'index';
                $version = Documentation::latest();
            }

            if (! Storage::disk('docs')->exists("$version/$locale/index.md")) {
                if (! $fallback) {
                    return null;
                }

                $version = Documentation::latest();
            }

            $documentation = new Documentation($locale, $version);

            if (! $fallback) {
                if (! $documentation->hasPage($page)) {
                    return null;
                }
                $translation = Storage::disk('docs')->get($documentation->path($page));
                $metadata = Yaml::parse(Str::of($translation)->after('---')->before('---'));
                if (isset($metadata['redirect'])) {
                    return null;
                }
            }

            return url($documentation->url($documentation->hasPage($page) ? $page : 'index')).'/';
        }

        if (! $fallback && preg_match('~^/(?:en|ru)/(hig|community|recipes)(?:/(.*))?/?$~', $path, $matches)) {
            $page = trim($matches[2] ?? '', '/') ?: 'index';
            if (! Storage::disk('docs')->exists("$locale/{$matches[1]}/$page.md")) {
                return null;
            }
        }

        $path = preg_replace('~^/(?:en|ru)(?=/|$)~', "/$locale", $path, 1, $replacements);

        return url($replacements ? $path : "/$locale");
    }
}
