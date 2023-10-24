<?php

namespace App\View\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use JoliTypo\Fixer;
use Symfony\Component\DomCrawler\Crawler;

class DocsContent extends Component implements Htmlable
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
     * @return \App\View\Components\DocsContent
     * @throws \DOMException
     */
    public function render()
    {
        return $this;
    }

    /**
     * @param $contents
     *
     * @return string
     * @throws \DOMException
     */
    private function detectAnchors()
    {
        $crawler = new Crawler();
        $crawler->addContent($this->content);

        $this->content = $crawler->html();

        $crawler->filter('x-docs-banner')->each(function (Crawler $elm) {
            $tag = $elm->outerHtml();

            $this->content = Str::of($this->content)
                ->replace($tag, Blade::render($tag));
        });

        $crawler
            ->filter('h2,h3,h4,h5,h6')
            ->each(function (Crawler $elm) use (&$anchors) {

                /** @var \DOMElement $node */
                $node = $elm->getNode(0);

                $content = $node->textContent;
                $id = Str::slug($content);
                $tag = $node->nodeName;

                $this->content = Str::of($this->content)
                    ->replace("<$tag>$content</$tag>", "<$tag><a href='#$id' id='$id'>$content</a></$tag>");
            });

        $crawler
            ->filter('img')
            ->each(function (Crawler $elm) use (&$anchors) {

                $imgTag = $elm->outerHtml();
                $alt = $elm->attr('alt');

                $this->content = Str::of($this->content)
                    ->replace($imgTag, "<picture alt='$alt'>$imgTag</picture>");
            });

        $fixer = new Fixer([
            'Ellipsis',
            'Dimension',
            'Unit',
            'Dash',
            'SmartQuotes',
            'NoSpaceBeforeComma',
            'CurlyQuote',
            'Trademark',
        ]);

        $crawler
            ->filter('p,li')
            ->each(function (Crawler $elm) use ($fixer) {

                $content = $elm->html();

                $paragraph = $fixer->fix($content);

                $this->content = Str::of($this->content)->replace($content, $paragraph);
            });


        return $this->content;
    }


    /**
     * @return string
     * @throws \DOMException
     */
    public function toHtml(): string
    {
        return $this->detectAnchors();
    }
}
