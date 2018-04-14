<?php

namespace App\Console\Commands;

use App\Docs;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Parsedown;
use Symfony\Component\DomCrawler\Crawler;

class SearchIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * @var Parsedown
     */
    public $parse;

    /**
     * @var
     */
    public $crawler;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->parse = new Parsedown();
        $this->crawler = new Crawler();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $storage = Storage::disk('docs');

        Docs::where('type','docs')->forceDelete();

        foreach ($storage->allFiles() as $slug) {
            $this->index($slug, $storage->get($slug));
        }
    }

    /**
     * @param string $slug
     */
    public function index(string $slug, string $content)
    {
        $local = stristr($slug, '/', true);
        $name = str_replace(".md", "", stristr($slug, '/'));
        $slug = '/' . $local . '/docs' . $name;


        $html = $this->parse->text($content);
        $crawler = new Crawler($html);

        try {
            $title = $crawler->filter('h1')->first()->text();
            $descriptions = $crawler->filter('p')->first()->text();
        }catch (\Exception $exception){
           return;
        }

        Docs::firstOrNew([
            'slug' => $slug
        ])->fill([
            'user_id' => 0,
            'status'  => 'active',
            'type'    => 'docs',
            'content' => [
                $local => [
                    'title'        => $title,
                    'descriptions' => $descriptions,
                ],
            ],
            'options' => [
                'markdown' => $content,
                'locale'   => $local,

            ],
            'slug'    => $slug
        ])->save();

    }
}
