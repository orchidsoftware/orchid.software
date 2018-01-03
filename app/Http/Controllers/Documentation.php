<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $this->storage = Storage::disk('docs');
        $this->crawler = new Crawler();
    }

    /**
     * @param string $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($page = 'index')
    {

        $lang = App::getLocale();

        $page = $this->getPage($lang, $page);

        return view('pages.docs', [
            'menu'        => $this->getMenu($lang),
            'anchors'     => $page['anchors'],
            'content'     => $page['content'],
            'title'       => $page['title'],
            'description' => $page['description'],
        ]);
    }


    /**
     * @param $lang
     *
     * @return mixed
     */
    private function getMenu($lang)
    {

        return Cache::remember('menu' . $lang, 60, function () use ($lang) {
            $menu = $this->storage->get("/$lang/documentation.md");

            return $this->parse->text($menu);
        });
    }


    /**
     * @param $lang
     * @param $page
     *
     * @return mixed
     */
    private function getPage($lang, $page)
    {
        return Cache::remember('page'.$page . $lang, 60, function () use ($lang, $page) {
            $contents = $this->storage->get("/$lang/$page.md");
            $contents = $this->parse->text($contents);

            $this->crawler->addHtmlContent($contents);
            $title = $this->crawler->filter('h1')->first()->text();
            $description = $this->crawler->filter('p')->first()->text();

            $anchors = [];
            $this->crawler->filter('h2,h3,h4,h5,h6')->each(function ($elm) use (&$anchors) {
                /** @var Crawler $elm */
                /** @var \DOMElement $node */
                $node = $elm->getNode(0);
                $text = $node->textContent;
                $id = Str::slug($text);
                $anchors[] = [
                    'text' => $text,
                    'level' => $node->tagName,
                    'id' => $id
                ];

                while ($node->hasChildNodes()) {
                    $node->removeChild($node->firstChild);
                }

                $node->appendChild(new \DOMElement('a', $text));
                $node->firstChild->setAttribute('href', '#' . $id);
                $node->firstChild->setAttribute('name', $id);
            });

            $contents = preg_replace('/<h1[^>]*>(.*)<\/h1>/', '', $this->crawler->html());
            $contents = preg_replace('/^<body>(.*)<\/body>$/s', '$1', $contents);

            return [
                'anchors'     => $anchors,
                'content'     => $contents,
                'title'       => $title,
                'description' => $description,
            ];
        });
    }

}
