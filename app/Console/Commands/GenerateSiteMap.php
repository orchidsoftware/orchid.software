<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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

        collect($files)->filter(function (string $file) {
            return Str::of($file)->endsWith('.html');
        })->map(function (string $file) {
            return (string) Str::of($file)->remove('index.html');
        })->map(function ($path) {
            return Url::create($path)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);
        })->each(function (Url $url) use ($sitemap) {
            $sitemap->add($url);
        });


        $sitemap->writeToDisk($disk, 'sitemap.xml');

        return 0;
    }
}
