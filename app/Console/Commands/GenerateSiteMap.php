<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Symfony\Component\DomCrawler\Crawler;

class GenerateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create and generate sitemaps';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $disk = config('export.disk');
        $files = \Storage::disk($disk)->allFiles();

        $sitemap = Sitemap::create();

        collect($files)->filter(fn (string $file) => Str::endsWith($file, '.html'))
            ->map(function (string $file) use ($disk) {
                $crawler = new Crawler(\Storage::disk($disk)->get($file));
                $robots = $crawler->filter('meta[name="robots"]');

                if ($robots->count() && str_contains(strtolower($robots->attr('content')), 'noindex')) {
                    return null;
                }

                $canonical = $crawler->filter('link[rel="canonical"]');
                $path = '/'.Str::beforeLast($file, 'index.html');
                $url = $canonical->count() ? $canonical->attr('href') : url($path);

                if ($crawler->filter('meta[http-equiv="refresh"]')->count()) {
                    return null;
                }

                return $url;
            })->filter()->unique()->each(function (string $url) use ($sitemap) {
                $sitemap->add(Url::create($url));
            });

        $sitemap->writeToDisk($disk, 'sitemap.xml');

        return 0;
    }
}
