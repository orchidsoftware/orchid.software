<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Parsedown;
use Symfony\Component\DomCrawler\Crawler;

class Documentation
{
    /**
     * @var Parsedown
     */
    public $parse;

    /**
     * @var Storage
     */
    public $storage;

    /**
     * @var
     */
    public $crawler;

    /**
     * Documentation constructor.
     */
    public function __construct()
    {
        $this->parse = new Parsedown();
        $this->storage =  Storage::disk('docs');
        $this->crawler = new Crawler();
    }

    /**
     * @param string $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($page = 'installation'){

       $lang = App::getLocale();

       $menu = $this->storage->get("/$lang/documentation.md");
       $contents = $this->storage->get("/$lang/$page.md");
       $contents = $this->parse->text($contents);


       $this->crawler->addHtmlContent($contents);
       $title = $this->crawler->filter('h1')->first()->text();
       $description = $this->crawler->filter('p')->first()->text();


       return view('pages.docs',[
           'menu' => $this->parse->text($menu),
           'content' => $contents,
           'title' => $title,
           'description' => $description,
       ]);
    }
}
