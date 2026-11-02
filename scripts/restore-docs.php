<?php

require dirname(__DIR__).'/vendor/autoload.php';

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;

$site = dirname(__DIR__);
$platform = $argv[1] ?? dirname($site).'/platform';
$staging = sys_get_temp_dir().'/orchid-docs-recovery-'.bin2hex(random_bytes(6));
$filesystem = new Filesystem();
$recoveryComplete = false;
register_shutdown_function(function () use ($filesystem, $staging, &$recoveryComplete) {
    if ($recoveryComplete) {
        $filesystem->deleteDirectory($staging);
    } elseif (is_dir($staging)) {
        fwrite(STDERR, "Recovery staging retained for inspection: $staging\n");
    }
});

$snapshots = [
    '2.x'  => ['platform', 'a61e0f36d45555eb8388b886c5090f391a9a61df', 'docs', '2.2.7 tag'],
    '3.x'  => ['platform', '568c81fdc352301dd601f16723be10ffab267754', 'docs', '3.11.0 tag'],
    '4.x'  => ['site', 'a5d9ba60d70343780c39d09951928aebb58bd533', 'source', 'Last snapshot before the explicit 5.0 documentation update 5e53fe3d7'],
    '5.x'  => ['site', '06a0014ab00db98dad70b5d707e6351171ceb5f0', 'source', 'Last snapshot before the explicit 6.0 documentation update 3cb8459be'],
    '6.x'  => ['site', '2f38e303b75b21307a05dd9a95f19ef0bace939d', 'source', 'Explicit 6.4.0 documentation update'],
    '7.x'  => ['site', 'fc12a71435ed8f43f48467ef9c63b3959d95518d', 'source', '7.0 tag'],
    '8.x'  => ['site', '9a3e807f2a52d85a852eb3df32a851a64344c4f6', 'source', '8.0 tag'],
    '9.x'  => ['site', '3f1ac70f0d22301327eae33e3c62f8c5b54989bb', 'source', '9.0 tag'],
    '10.x' => ['site', 'be2e6c5bacfcbaad657809fbe09c2040d65c4fe2', 'source', '10.0 tag'],
    '11.x' => ['site', '47bacaba29bef3149c29ec7d07080b5ec55b1b02', 'docs', 'Last snapshot before the 12.0 upgrade guide update 2a85d1c5c'],
    '12.x' => ['site', 'dee09768ed08fe453eb0a76eb23e0393cf514e60', 'docs', 'Last snapshot before the 13.0 upgrade guide update 11d1e92fc'],
    '13.x' => ['site', 'b57c9c40725afae2e52a702b2cd800a99214df7d', 'docs', '13.0 tag'],
];
$supplements = [
    '2.x' => [
        'en/tutorial_clinic'  => ['5e26dfe0c1cad3c97799701d70af3ab40d4753fb', true],
        'en/tutorial_monitor' => ['5e26dfe0c1cad3c97799701d70af3ab40d4753fb', true],
        'ru/tutorial_monitor' => ['b5bab646f22a4f15e44e0f2287a5b07ef3bbcb7c', true],
    ],
    '3.x' => [
        'en/tutorial_blog' => ['df0160a7ed4ad9ae011e90594a78754abfedf3ef', false],
    ],
];

function git(string $repository, array $arguments): string
{
    $process = proc_open(['git', '-C', $repository, ...$arguments], [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
    $output = stream_get_contents($pipes[1]);
    $error = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    if (proc_close($process) !== 0) {
        throw new RuntimeException($error);
    }

    return $output;
}

function writeRecovered(string $path, string $content): void
{
    if (is_file($path)) {
        if (file_get_contents($path) !== $content) {
            throw new RuntimeException("Refusing to overwrite modified file $path");
        }

        return;
    }

    if (! is_dir(dirname($path))) {
        mkdir(dirname($path), 0777, true);
    }
    file_put_contents($path, $content);
}

function json(array $value): string
{
    return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR)."\n";
}

function normalize(string $page, string $slug, bool $blade): string
{
    if (preg_match('/\A---\R(.*?)\R---\R?(.*)\z/s', $page, $matches)) {
        $metadata = Yaml::parse($matches[1]);
        $body = $matches[2];
        foreach (['extends', 'section', 'lang', 'menu', 'githubEdit'] as $key) {
            unset($metadata[$key]);
        }
    } else {
        $body = $page;
        if (preg_match('/\A\s*#\s*([^\r\n]+)\R(?:-+\R)?\s*/', $body, $matches)) {
            $metadata = ['title' => trim($matches[1])];
            $body = substr($body, strlen($matches[0]));
        } else {
            $metadata = ['title' => ucfirst(str_replace(['-', '_'], ' ', basename($slug)))];
        }
    }

    if ($blade) {
        preg_match_all('/<p\b[^>]*>.*?<\/p>/s', $body, $paragraphs);
        $body = implode("\n\n", $paragraphs[0]);
    }

    return "---\n".Yaml::dump($metadata, 2, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK)."---\n\n".ltrim($body);
}

$sources = [];
foreach ($snapshots as $version => [$repositoryName, $commit, $root, $evidence]) {
    $repository = $repositoryName === 'site' ? $site : $platform;
    $files = array_filter(explode("\n", trim(git($repository, ['ls-tree', '-r', '--name-only', $commit]))));
    $pages = [];
    $bladePages = [];
    foreach ($files as $file) {
        $pattern = $repositoryName === 'platform'
            ? '#^docs/([^/]+)/(.*)\.(md|blade\.php)$#'
            : '#^'.preg_quote($root, '#').'/([^/]+)/docs/(.*)\.(md|blade\.php)$#';
        if (! preg_match($pattern, $file, $matches)) {
            continue;
        }
        [, $locale, $slug, $extension] = $matches;
        $pages[$locale][$slug] = normalize(git($repository, ['show', "$commit:$file"]), $slug, $extension === 'blade.php');
        if ($extension === 'blade.php') {
            $bladePages[] = "$locale/$slug";
        }
    }
    $supplementaryPages = [];
    foreach ($supplements[$version] ?? [] as $path => [$sourceCommit, $incomplete]) {
        [$locale, $slug] = explode('/', $path, 2);
        $sourcePath = "docs/$path.md";
        $pages[$locale][$slug] = normalize(git($platform, ['show', "$sourceCommit:$sourcePath"]), $slug, false);
        $supplementaryPages[$path] = [
            'repository'          => 'orchidsoftware/platform',
            'commit'              => $sourceCommit,
            'path'                => $sourcePath,
            'incomplete_original' => $incomplete,
        ];
    }

    $navigation = [];
    if ($repositoryName === 'platform') {
        foreach ($pages as $locale => $articles) {
            $html = $articles['documentation'] ?? '';
            $html = preg_replace('/<!--.*?-->/s', '', $html);
            preg_match_all('#<h4\b[^>]*>(.*?)</h4>\s*<ul\b[^>]*>(.*?)</ul>#s', $html, $groups, PREG_SET_ORDER);
            foreach ($groups as $group) {
                preg_match_all('#<a\b[^>]*href="([^"]+)"[^>]*>(.*?)</a>#s', $group[2], $links, PREG_SET_ORDER);
                foreach ($links as $link) {
                    $navigation[$locale][strip_tags($group[1])][strip_tags($link[2])] = $link[1];
                }
            }
        }
    } else {
        $navigationPath = $root === 'source' ? 'navigation.php' : 'config/site.php';
        $temporary = tempnam(sys_get_temp_dir(), 'orchid-navigation-');

        try {
            file_put_contents($temporary, git($repository, ['show', "$commit:$navigationPath"]));
            $originalNavigation = require $temporary;
        } finally {
            unlink($temporary);
        }
        $originalNavigation = $originalNavigation['navigation'] ?? $originalNavigation;
        foreach ($originalNavigation as $locale => $groups) {
            $groups = isset($groups['docs']) ? array_merge($groups['docs'], $groups['layouts'] ?? []) : $groups;
            foreach ($groups as $title => $links) {
                $navigation[$locale][$title] = $links['children'] ?? $links;
            }
        }
    }

    $assetCommit = $repositoryName === 'site' ? $commit : trim(git($site, ['rev-list', '-1', '--before='.trim(git($repository, ['show', '-s', '--format=%cI', $commit])), 'master']));
    $assetFiles = array_flip(array_filter(explode("\n", trim(git($site, ['ls-tree', '-r', '--name-only', $assetCommit])))));
    $assets = [];
    $assetFallbacks = [];
    $missingAssets = [];
    $counts = [];
    foreach ($pages as $locale => $articles) {
        foreach ($articles as $slug => $page) {
            preg_match_all('#(?:!\[[^\]]*\]\(|src=["\'])([^\s\)"\']+)#', $page, $images);
            foreach (array_unique($images[1]) as $image) {
                $url = parse_url($image);
                if (isset($url['host']) && ! in_array($url['host'], ['orchid.software', 'www.orchid.software'], true)) {
                    continue;
                }
                $path = $url['path'] ?? '';
                if (! str_starts_with($path, '/') || str_starts_with($path, '/avatar/')) {
                    continue;
                }
                $paths = ['public'.$path, 'source'.$path, 'public'.str_replace('/assets/img/', '/img/', $path), 'source/assets'.$path];
                $sourcePath = null;
                foreach ($paths as $candidate) {
                    if (isset($assetFiles[$candidate])) {
                        $sourcePath = $candidate;
                        break;
                    }
                }
                $assetSourceCommit = $assetCommit;
                if ($sourcePath === null && $path === '/img/scheme/behaviors.jpg') {
                    $assetSourceCommit = 'de6d63c9897405a2ca000143542d261662ad6edc';
                    $sourcePath = 'public/img/scheme/behaviors.jpg';
                    $assetFallbacks[$image] = "$assetSourceCommit:$sourcePath";
                }
                if ($sourcePath === null) {
                    $missingAssets[$image] = true;

                    continue;
                }
                $bytes = git($site, ['show', "$assetSourceCommit:$sourcePath"]);
                $publicPath = str_replace('/assets/img/', '/img/', $path);
                if (is_file($site.'/public'.$publicPath) && file_get_contents($site.'/public'.$publicPath) === $bytes) {
                    $target = $publicPath;
                } else {
                    $target = '/img/docs-archive/'.substr(hash('sha256', $bytes), 0, 16).'-'.basename($path);
                    writeRecovered($site.'/public'.$target, $bytes);
                }
                $page = str_replace($image, $target, $page);
                $assets[$image] = $target;
            }
            $pages[$locale][$slug] = $page;
            writeRecovered("$staging/docs/$version/$locale/$slug.md", $page);
        }

        $linked = [];
        foreach ($navigation[$locale] ?? [] as $group => $links) {
            foreach ($links as $title => $link) {
                $path = parse_url($link, PHP_URL_PATH);
                if (preg_match('#^/'.preg_quote($locale, '#').'/docs(?:/(.*))?$#', rtrim($path, '/'), $matches)) {
                    $slug = ($matches[1] ?? '') ?: 'index';
                    if (! isset($articles[$slug]) && isset($articles[$slug.'/index'])) {
                        $slug .= '/index';
                    }
                    if (! isset($articles[$slug])) {
                        unset($navigation[$locale][$group][$title]);

                        continue;
                    }
                    $navigation[$locale][$group][$title] = "/$locale/docs".($slug === 'index' ? '' : '/'.$slug);
                    $linked[$slug] = true;
                } else {
                    unset($navigation[$locale][$group][$title]);
                }
            }
            if (! $navigation[$locale][$group]) {
                unset($navigation[$locale][$group]);
            }
        }
        foreach ($articles as $slug => $page) {
            if (! isset($linked[$slug]) && $slug !== 'documentation') {
                preg_match('/\A---\R(.*?)\R---/s', $page, $matches);
                $title = Yaml::parse($matches[1])['title'];
                $group = $locale === 'ru' ? 'Другие статьи' : 'Additional articles';
                $navigation[$locale][$group][$title] = "/$locale/docs".($slug === 'index' ? '' : '/'.$slug);
            }
        }
        $counts[$locale] = count($articles);
    }
    $navigation = array_intersect_key($navigation, $pages);
    writeRecovered("$staging/docs/$version/navigation.json", json($navigation));
    $sources[$version] = [
        'repository'                         => 'orchidsoftware/'.($repositoryName === 'site' ? 'orchid.software' : 'platform'),
        'commit'                             => $commit,
        'original_root'                      => $root,
        'evidence'                           => $evidence,
        'pages'                              => $counts,
        'supplementary_pages'                => $supplementaryPages,
        'unavailable_articles'               => $version === '4.x' ? ['en/tutorial_blog'] : [],
        'icon_catalogs_without_dynamic_loop' => $bladePages,
        'asset_commit'                       => $assetCommit,
        'assets'                             => $assets,
        'asset_fallbacks'                    => $assetFallbacks,
        'unavailable_assets'                 => array_keys($missingAssets),
    ];
    echo $version.' '.array_sum($counts)." pages\n";
}
$formatter = new Process(['python3', __DIR__.'/format-archive-docs.py', '--root', $staging, '--project', $site], $site);
$formatter->setTimeout(null)->mustRun();
echo $formatter->getOutput();
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($staging, FilesystemIterator::SKIP_DOTS));
$recovered = [];
$conflicts = [];
foreach ($files as $file) {
    $relative = substr($file->getPathname(), strlen($staging) + 1);
    $recovered[$relative] = file_get_contents($file->getPathname());
    if (is_file($site.'/'.$relative) && file_get_contents($site.'/'.$relative) !== $recovered[$relative]) {
        $conflicts[] = $relative;
    }
}
if ($conflicts) {
    throw new RuntimeException('Recovered content differs: '.implode(', ', $conflicts));
}
foreach ($recovered as $relative => $content) {
    writeRecovered($site.'/'.$relative, $content);
}
writeRecovered("$site/docs/sources.json", json($sources));

$recoveryComplete = true;
