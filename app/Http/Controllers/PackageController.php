<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Platform\Core\Models\Post;
use Symfony\Component\DomCrawler\Crawler;

class PackageController extends Controller
{
    public function index()
    {
        $top = Post::type('package')
            ->orderByDesc('content->github_stars')
            ->limit(12)
            ->get();

        $count = Post::type('package')
            ->count();

        return view('packages.packages', [
            'top'   => $top,
            'count' => number_format($count),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        $results = Post::search($request->get('query',''))
            ->where('type','package')
            ->paginate();

        return view('packages.search', [
            'results'   => $results,
        ]);
    }

    /**
     * @param $vendor
     * @param $package
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($lang, $vendor, $package)
    {
        $package = Post::type('package')
            ->where('slug', $vendor . '/' . $package)
            ->with('tags')
            ->firstOrFail();
        $content = (new \Parsedown())->text($package->content['content']);

        $crawler = new Crawler();
        $crawler->addHtmlContent($content);

        $crawler->filter('h2,h3,h4,h5,h6')->each(function ($elm) use (&$anchors) {
            /** @var Crawler $elm */
            /** @var \DOMElement $node */
            $node = $elm->getNode(0);
            $text = $node->textContent;
            $id = Str::slug($text);

            while ($node->hasChildNodes()) {
                $node->removeChild($node->firstChild);
            }

            $node->appendChild(new \DOMElement('a', $text));
            $node->firstChild->setAttribute('href', '#' . $id);
            $node->firstChild->setAttribute('name', $id);
        });

        $content = preg_replace('/^<body>(.*)<\/body>$/s', '$1', $crawler->html());


        $similars = Post::withTag($package->tags->implode('slug', ', '))
            ->type('package')
            ->where('id', '!=', $package->id)
            ->limit(3)
            ->get();

        return view('packages.package', [
            'package' => $package,
            'content' => $content,
            'similars' => $similars
        ]);
    }

}
