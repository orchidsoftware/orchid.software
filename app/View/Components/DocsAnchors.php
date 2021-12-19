<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Symfony\Component\DomCrawler\Crawler;

class DocsAnchors extends Component
{
    /**
     * @var string
     */
    protected $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     * @throws \DOMException
     */
    public function render()
    {
        return view('components.docs-anchors', [
            'anchors' => $this->findAnchors(),
        ]);
    }


    /**
     * @param $contents
     *
     * @return array
     * @throws \DOMException
     */
    private function findAnchors()
    {
        $crawler = new Crawler();
        $crawler->addContent($this->content);

        $anchors = [];
        $crawler
            ->filter('h2,h3,h4,h5,h6')
            ->each(function ($elm) use (&$anchors) {

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
                $node->firstChild->setAttribute('href', '#' . $id);
                $node->firstChild->setAttribute('name', $id);
            });


        return $anchors;
    }

}
