<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\View\ViewRenderer;

class GenerateDocumentList
{
    /**
     * @var Crawler
     */
    public $crawler;

    /**
     * GenerateDocumentList constructor.
     */
    public function __construct()
    {
        if (!is_dir('cache')) {
            mkdir('cache');
        }

        $this->crawler = new Crawler();
    }

    /**
     * @param Jigsaw $jigsaw
     */
    public function handle(Jigsaw $jigsaw)
    {
        collect($jigsaw->getOutputPaths())
            ->reject(function ($path) {
                return !Str::is('*docs*', $path);
            })
            ->each(function ($path) use ($jigsaw) {
                $path = Str::finish('/'.$path, '/').'index.html';

                $file = $jigsaw->readOutputFile($path);

                //try {
                $page = $this->AddedAncors($file, $jigsaw);
                //}catch (\Exception $exception){
                //    $page = $file;
                //}

                file_put_contents($jigsaw->getDestinationPath().$path, $page);
            });

        /*
        $patch = $jigsaw->getSourcePath();
        $docs  = '/docs';

        foreach (glob($patch.$docs . '/*.md') as $file) {
            $file = str_replace($patch, '', $file);
            $file = $jigsaw->readSourceFile($file);
            $page = $this->AddedAncors($file);

            $jigsaw->writeOutputFile($file,$page);
        }

        $jigsaw->readSourceFile('docs/en/access.md');
        */
    }

    /**
     * @param $contents
     *
     * @return array
     */
    private function AddedAncors($page, $jigsaw)
    {
        $this->crawler = new Crawler();
        $this->crawler->addHtmlContent($page);

        //$title       = $this->crawler->filter('h1')->first()->text();
        //$description = $this->crawler->filter('p')->first()->text();

        $anchors = [];
        $this->crawler->filter('main')
            ->first()
            ->filter('h2,h3,h4,h5,h6')->each(function ($elm) use (&$anchors) {

            /** @var Crawler $elm */
                /** @var \DOMElement $node */
                $node = $elm->getNode(0);
                $text = $node->textContent;
                $id = Str::slug($text);
                $anchors[] = [
                'text'  => $text,
                'level' => $node->tagName,
                'id'    => $id,
            ];
                while ($node->hasChildNodes()) {
                    $node->removeChild($node->firstChild);
                }
                $node->appendChild(new \DOMElement('a', $text));
                $node->firstChild->setAttribute('href', '#'.$id);
                $node->firstChild->setAttribute('name', $id);
            });
        //$contents = preg_replace('/<h1[^>]*>(.*)<\/h1>/', '', $this->crawler->html());
        //$contents = preg_replace('/^<body>(.*)<\/body>$/s', '$1', $contents);

        $view = $jigsaw->app->make(ViewRenderer::class);
        $anchors = $view->render('source/_layouts/anchors.blade.php', collect([
            'anchors' => $anchors,
        ]));

        return str_replace('<!--Docs Anchors-->', $anchors, $this->crawler->html());
    }
}
