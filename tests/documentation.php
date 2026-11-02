<?php

use App\Documentation;
use App\DocumentationDestination;
use App\View\Components\DocsContent;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Export\Destination;
use Spatie\Export\Jobs\ExportPath;
use Symfony\Component\DomCrawler\Crawler;

require dirname(__DIR__).'/vendor/autoload.php';
$app = require dirname(__DIR__).'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['app.debug' => false]);

$checks = 0;
$check = function (bool $condition, string $message) use (&$checks): void {
    if (! $condition) {
        throw new RuntimeException($message);
    }
    $checks++;
};

$kernel = $app->make(Kernel::class);
$get = function (string $path, int $status = 200) use ($kernel, $check): string {
    $request = Request::create('https://orchid.software'.$path);
    $request->headers->set('X-Laravel-Export', 'true');
    $response = $kernel->handle($request);
    $check($response->getStatusCode() === $status, "$path returned {$response->getStatusCode()}, expected $status");
    $content = $response->getContent();
    $kernel->terminate($request, $response);

    return $content;
};

$versions = Documentation::versions();
$latest = Documentation::latest();
$check($latest === '14.x', 'Stable 14.x remains the default when development 15.x is available');
$check($versions[0] === '15.x', 'Development 15.x is available in the version list');
$check((new Documentation('en', '15.x'))->isDevelopment(), '15.x is identified as development');
$check(! (new Documentation('en', '14.x'))->isDevelopment(), '14.x is stable');
$check(! (new Documentation('en', '13.x'))->isDevelopment(), 'Older versions are archives');
$check(array_diff(array_map(fn (int $version) => "$version.x", range(2, 14)), $versions) === [], 'Every authentic major from 2.x through 14.x is restored');

foreach (['en', 'ru'] as $locale) {
    $html = $get("/$locale/docs");
    $crawler = new Crawler($html);
    $check($crawler->filter('#docs-version option[selected]')->text() === "$latest".($locale === 'ru' ? ' (актуальная)' : ' (latest)'), 'Unversioned documentation selects the latest');
    $check($crawler->filter('link[rel=canonical]')->attr('href') === "https://orchid.software/$locale/docs/", 'Stable URLs have unversioned canonicals');
    $check($crawler->filter('#docs-version optgroup[label="Current"] option')->each(fn (Crawler $option) => trim(explode(' ', $option->text())[0])) === ['15.x', '14.x'], 'Current group contains stable and development versions');
    $check($crawler->filter('#docs-version optgroup[label="Legacy"] option')->count() === 12, 'Versions below 14.x are grouped as Legacy');

    foreach ($versions as $version) {
        if (! is_file(base_path("docs/$version/$locale/index.md"))) {
            continue;
        }

        $documentation = new Documentation($locale, $version);
        $html = $get($documentation->url());
        $crawler = new Crawler($html);
        $check($crawler->filter('#docs-version option[selected]')->attr('value') === $documentation->url(), 'Selected version stays selected');
        $check($crawler->filter('main .alert-warning')->count() === (int) ($version !== $latest), 'Only archived pages show the archive notice');

        foreach ($documentation->navigation() as $links) {
            foreach ($links as $url) {
                if (str_starts_with($url, "/$locale/docs/$version")) {
                    $page = substr($url, strlen("/$locale/docs/$version/")) ?: 'index';
                    $check($documentation->hasPage($page), "Navigation points to missing $locale $version $page");
                }
            }
        }
    }
}

$stable = new Documentation('en');
$check($stable->url('screens') === '/en/docs/screens', 'Stable links omit the version');
$check($stable->rewriteUrl('/en/docs/screens#example') === '/en/docs/screens#example', 'Stable article links omit the version');
$check($stable->switcher('screens')['14.x'] === '/en/docs/screens', 'Selecting stable uses the unversioned URL');
$request = Request::create('https://orchid.software/en/docs/14.x/screens');
$response = $kernel->handle($request);
$check($response->getStatusCode() === 301 && $response->headers->get('Location') === 'https://orchid.software/en/docs/screens/', 'Live stable aliases permanently redirect');
$kernel->terminate($request, $response);

$untranslated = new Crawler($get('/en/docs/authentication'));
$check($untranslated->filter('link[hreflang="ru"]')->count() === 0, 'Missing translations never use the index as hreflang');
$check($untranslated->filter('link[hreflang="en"]')->attr('href') === 'https://orchid.software/en/docs/authentication/', 'Available hreflang identifies the same article');

$hig = new Crawler($get('/en/hig'));
$check($hig->filter('link[hreflang="ru"]')->count() === 0, 'Unavailable guide translations are not advertised');
$deprecated = new Crawler($get('/en/docs/14.x/access'));
$check($deprecated->filter('link[rel="canonical"]')->attr('href') === 'https://orchid.software/en/docs/permissions/', 'Deprecated aliases point directly to the final canonical');

$translatedAlias = new Crawler($get('/ru/docs/access'));
$check($translatedAlias->filter('link[hreflang="en"]')->count() === 0, 'Redirects are not used as language alternates');

$legacyLayouts = new Crawler($get('/ru/docs/6.x/layouts'));
$check($legacyLayouts->filter('main h2')->count() >= 5, 'Historical layout sections render as headings outside code blocks');

$preview = new Crawler($get('/en/docs/15.x'));
$check($preview->filter('.docs-archive')->attr('aria-label') === 'Development documentation', 'Development is not labeled as archived');
$check($preview->filter('.docs-archive .action')->attr('href') === '/en/docs', 'Development notice links to stable documentation');
$check(str_contains($preview->filter('#docs-version option[selected]')->text(), 'development'), 'Switcher labels the development version');
$legacyTypo = new Documentation('en', '6.x');
$check($legacyTypo->rewriteUrl('/eb/docs/quickstart') === '/en/docs/6.x/quickstart', 'Historical locale typo resolves within its own version');
$older = new Documentation('en', '7.x');
$check($older->switcher('screens')['13.x'] === '/en/docs/13.x/screens', 'Switching versions preserves existing articles');
$check($older->switcher('cell-types')['7.x'] === '/en/docs/7.x', 'Missing articles fall back to the selected version index');
$check($older->rewriteUrl('https://orchid.software/en/docs/screens/?q=1#example') === '/en/docs/7.x/screens?q=1#example', 'Internal links retain query and fragment');
$check($older->rewriteUrl('https://laravel.com/docs/installation') === 'https://laravel.com/docs/installation', 'External links remain external');
$check($older->rewriteUrl('/en/docs/13.x/screens') === '/en/docs/13.x/screens', 'Explicit cross-version links stay explicit');
$check($older->rewriteUrl('en/docs/table/') === '/en/docs/7.x/table', 'Historical relative links stay in the selected version');
$check((new Documentation('en', '7.x'))->hasPage('layouts'), 'Historical directory-index articles resolve');
$check($older->switcher('layouts/index')['6.x'] === '/en/docs/6.x/layouts', 'Switching from a directory index preserves a flat article');
$check((new Documentation('en', '6.x'))->switcher('layouts')['7.x'] === '/en/docs/7.x/layouts', 'Switching from a flat article preserves a directory index');
$get('/en/docs/7.x/layouts');

$content = (new DocsContent('<p><a href="/en/docs/screens#example">Screens</a></p><pre><code>/en/docs/screens#example</code></pre>', $older))->toHtml();
$check(str_contains($content, 'href="/en/docs/7.x/screens#example"'), 'Rendered article links use the selected version');
$check(str_contains($content, '<code>/en/docs/screens#example</code>'), 'Code examples remain unchanged');
$missingLink = new Crawler((new DocsContent('<p><a href="/en/docs/tutorial_blog/#vidzhet">Example</a></p>', new Documentation('en', '4.x')))->toHtml());
$check($missingLink->filter('a[href]')->count() === 0, 'Unrecovered historical articles do not create broken crawl targets');
$check(str_contains($missingLink->text(), 'page unavailable in this archive'), 'Unrecovered historical links are visibly labeled');

foreach (['/en/docs/99.x', '/en/docs/14.x/no-such-page', '/en/docs/7.x/cell-types', '/en/docs/14.x/../../config/app', '/en/docs/14.x/../navigation'] as $path) {
    $get($path, 404);
}
$get('/en/community/code-of-conduct');
$get('/en/hig');

$paths = Documentation::exportPaths();
$check(in_array('/en/docs/14.x/packages/crud', $paths, true), 'Nested documentation pages are exported');
$check(in_array('/en/docs/packages/crud', $paths, true), 'Legacy links are exported');
foreach ($paths as $path) {
    $html = $get($path);
    $page = new Crawler($html);
    if (preg_match('~^/(en|ru)/docs/14\.x(?:/|$)~', $path)) {
        $check($page->filter('meta[http-equiv="refresh"]')->count() === 1, 'Stable aliases export as redirects');
        $check($page->filter('#docs-version')->count() === 0, 'Redirect pages contain no duplicate article');
    } else {
        $check($page->filter('meta[name="robots"][content="noindex, follow"]')->count() === (int) (bool) preg_match('~^/(en|ru)/docs/\d+\.x(?:/|$)~', $path), 'Only stable unversioned articles are indexable');
    }
}

$destination = new class implements Destination
{
    public array $files = [];

    public function write(string $path, string $content): void
    {
        $this->files[$path] = $content;
    }

    public function clean(): void
    {
        throw new RuntimeException('Unexpected clean');
    }
};

foreach (['/en/docs/7.x', '/en/docs/7.x/screens', '/ru/docs/13.x/installation', '/en/docs', '/en/docs/14.x/packages/crud'] as $path) {
    (new ExportPath($path))->handle($kernel, new DocumentationDestination($destination), $app->make(UrlGenerator::class));
    $file = ltrim($path, '/').'/index.html';
    $check(isset($destination->files[$file]), "Exporter writes $file");
    $check(str_contains($destination->files[$file], str_contains($path, '/14.x/') ? 'http-equiv="refresh"' : 'id="docs-version"'), 'Static HTML contains a redirect or the version switcher');
}

$directory = sys_get_temp_dir().'/orchid-sitemap-check-'.bin2hex(random_bytes(6));
$disk = Storage::build(['driver' => 'local', 'root' => $directory, 'throw' => true]);
Storage::set('seo_check', $disk);
$previousDisk = config('export.disk');
config(['export.disk' => 'seo_check']);
foreach (['/en/docs/screens', '/en/docs/14.x/screens', '/en/docs/13.x/screens', '/en/docs/15.x'] as $path) {
    $disk->put(ltrim($path, '/').'/index.html', $get($path));
}
$disk->put('duplicate/index.html', $get('/en/docs/screens'));
Artisan::call('make:sitemap');
$locations = simplexml_load_string($disk->get('sitemap.xml'))->xpath('//*[local-name()="loc"]');
$check(array_map('strval', $locations) === ['https://orchid.software/en/docs/screens/'], 'Sitemap contains only unique indexable canonicals, excluding archives, development and redirects');
config(['export.disk' => $previousDisk]);
File::deleteDirectory($directory);

echo "Passed $checks checks across ".count($versions).' versions and '.count($paths)." export paths.\n";
