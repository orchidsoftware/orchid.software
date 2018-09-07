<?php

namespace App\Http\Controllers;

use App\Docs;
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
     * @param        $locale
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function show($locale, $slug = 'index')
    {
        $page = $this->getPage($locale, $slug);

        return view('pages.docs', [
            'locale'      => $locale,
            'slug'        => $slug,
            'menu'        => $this->getMenu($locale),
            'anchors'     => $page['anchors'],
            'content'     => $page['content'],
            'title'       => $page['title'],
            'description' => $page['description'],
        ]);
    }

    /**
     * @param $locale
     * @param $page
     *
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function getPage($locale, $page)
    {
        if (!$this->storage->has("/$locale/$page.md")) {
            abort(404);
        }

        $contents = $this->storage->get("/$locale/$page.md");
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
                'text'  => $text,
                'level' => $node->tagName,
                'id'    => $id
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

    }

    /**
     * @param $locale
     *
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function getMenu($locale)
    {
        $menu = $this->storage->get("/$locale/documentation.md");

        return $this->parse->text($menu);
    }

    /**
     * @param        $locale
     * @param string $query
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search($locale, $query = '')
    {
        $search = Docs::search($query)
            ->get()
            ->where('options.locale', $locale)
            ->take(5);

        return view('pages.search', [
            'search' => $search,
        ]);
    }

}
