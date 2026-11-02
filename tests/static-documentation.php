<?php

use App\Documentation;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\UriResolver;
use Illuminate\Contracts\Console\Kernel;
use Symfony\Component\DomCrawler\Crawler;

require dirname(__DIR__).'/vendor/autoload.php';
$app = require dirname(__DIR__).'/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();
$root = rtrim($argv[1] ?? base_path('storage/app/public'), '/');
$origin = 'https://orchid.software';
$checks = 0;
$check = function (bool $condition, string $message) use (&$checks): void {
    if (! $condition) {
        throw new RuntimeException($message);
    }
    $checks++;
};
$fileFor = function (string $path) use ($root): string {
    $file = $root.'/'.ltrim($path, '/');

    return is_file($file) ? $file : rtrim($file, '/').'/index.html';
};
$indexable = [];
$paths = Documentation::exportPaths();
foreach ($paths as $path) {
    $file = $fileFor($path);
    $check(is_file($file), "Missing exported page $path");
    $page = new Crawler(file_get_contents($file));
    $check($page->filter('link[rel="canonical"]')->count() === 1, "Expected one canonical on $path");
    $canonical = $page->filter('link[rel="canonical"]')->attr('href');
    $check(str_starts_with($canonical, $origin.'/'), "Nonproduction canonical on $path");
    $target = $fileFor(parse_url($canonical, PHP_URL_PATH));
    $check(is_file($target), "Canonical target missing on $path");
    $targetPage = new Crawler(file_get_contents($target));
    $check($targetPage->filter('meta[http-equiv="refresh"]')->count() === 0, "Canonical points to a redirect on $path");
    $check($targetPage->filter('link[rel="canonical"]')->attr('href') === $canonical, "Canonical target disagrees on $path");
    $redirect = $page->filter('meta[http-equiv="refresh"]')->count() > 0;
    $versioned = preg_match('~^/(en|ru)/docs/\d+\.x(?:/|$)~', $path);
    if (! $redirect) {
        $check($page->filter('meta[name="robots"][content="noindex, follow"]')->count() === (int) (bool) $versioned, "Incorrect indexing policy on $path");
        if (! $versioned) {
            $indexable[$canonical] = true;
        }
    } else {
        $check($page->filter('#docs-version')->count() === 0, "Redirect duplicates article on $path");
        $check($page->filter('meta[http-equiv="refresh"]')->attr('content') === '0;url='.$canonical, "Redirect and canonical disagree on $path");
    }
    if (! $redirect) {
        $check($page->filter('link[rel="stylesheet"]')->count() > 0, "Missing stylesheet on $path");
    }
    foreach ($page->filter('link[rel="stylesheet"], script[src]') as $asset) {
        $url = new Uri($asset->getAttribute($asset->nodeName === 'script' ? 'src' : 'href'));
        $check($url->getHost() === 'orchid.software', "Nonproduction frontend asset on $path");
        $check(is_file($fileFor($url->getPath())), "Missing frontend asset on $path");
    }
    foreach ($page->filter('img[src]') as $image) {
        $url = UriResolver::resolve(new Uri($origin.$path.'/'), new Uri($image->getAttribute('src')));
        if (in_array($url->getHost(), ['orchid.software', 'www.orchid.software'], true)) {
            $check(is_file($fileFor(rawurldecode($url->getPath()))), "Missing image {$url->getPath()} on $path");
        }
    }
    foreach ($page->filter('link[hreflang]') as $alternate) {
        $url = $alternate->getAttribute('href');
        $check(str_starts_with($url, $origin.'/'), "Nonproduction language alternate on $path");
        $alternateFile = $fileFor(parse_url($url, PHP_URL_PATH));
        $check(is_file($alternateFile), "Missing language alternate on $path");
        $translation = new Crawler(file_get_contents($alternateFile));
        $check($translation->filter('link[rel="canonical"]')->attr('href') === $url, "Language alternate is not canonical on $path");
        $reciprocal = $translation->filter('link[hreflang]')->each(fn (Crawler $link) => $link->attr('href'));
        $check(in_array($canonical, $reciprocal, true), "Nonreciprocal language alternate on $path");
    }
    foreach ($page->filter('a[href]') as $link) {
        $url = UriResolver::resolve(new Uri($origin.$path.'/'), new Uri($link->getAttribute('href')));
        if (! in_array($url->getHost(), ['orchid.software', 'www.orchid.software'], true)) {
            continue;
        }
        $linkPath = rawurldecode($url->getPath());
        $check(is_file($fileFor($linkPath)), "Broken local link $linkPath on $path");
    }
}
$sitemap = simplexml_load_file($root.'/sitemap.xml');
$check($sitemap !== false, 'Sitemap is not valid XML');
$locations = array_map('strval', $sitemap->xpath('//*[local-name()="loc"]'));
$check(count($locations) === count(array_unique($locations)), 'Duplicate sitemap URLs');
foreach ($locations as $url) {
    $check($url === $origin || str_starts_with($url, $origin.'/'), "Nonproduction sitemap URL $url");
    $check(! preg_match('~/docs/\d+\.x(?:/|$)~', $url), "Versioned URL in sitemap $url");
    $file = $fileFor(parse_url($url, PHP_URL_PATH) ?: '/');
    $check(is_file($file), "Missing sitemap target $url");
    $page = new Crawler(file_get_contents($file));
    $check($page->filter('meta[http-equiv="refresh"]')->count() === 0, "Sitemap target redirects $url");
    $check($page->filter('meta[name="robots"][content="noindex, follow"]')->count() === 0, "Sitemap target is noindex $url");
    $check($page->filter('link[rel="canonical"]')->attr('href') === $url, "Sitemap target is not canonical $url");
}
foreach (array_keys($indexable) as $url) {
    $check(in_array($url, $locations, true), "Stable article missing from sitemap $url");
}
echo "Passed $checks static checks across ".count($paths).' documentation files and '.count($locations)." sitemap URLs.\n";
