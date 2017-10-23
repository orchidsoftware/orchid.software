<?php

namespace App\Http\Controllers;

use Orchid\CMS\Core\Models\Post;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class NewsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $news = Post::published()->where('type', 'blog')
            ->orderBy('publish_at', 'DESC')
            ->simplePaginate(10);

        return view('pages.news', [
            'news' => $news,
        ]);

    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post){
        return view('pages.article',[
            'article' => $post,
        ]);
    }


    /**
     * RSS
     */
    public function rss()
    {
        $feed = App::make("feed");
        $feed->setCache(60, 'rss-news-' . App::getLocale());
        if (!$feed->isCached()) {
            // creating rss feed with our most recent 20 posts
            $news = Post::where('type', 'blog')
                ->whereNotNull('content->' . App::getLocale())
                ->whereDate('publish_at', '<', time())
                ->orderBy('publish_at', 'DESC')
                ->limit(20)
                ->get();
            // set your feed's title, description, link, pubdate and language
            $feed->title = 'ORCHID - Simple and flexible control panel';
            $feed->description = 'ORCHID - Simple and flexible control panel';
            $feed->logo = config('app.url') . '/img/orchid.svg';
            $feed->link = url('rss');
            $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
            $feed->pubdate = $news[0]->created_at;
            $feed->lang = App::getLocale();
            $feed->setShortening(true); // true or false
            $feed->setTextLimit(100); // maximum length of description text
            foreach ($news as $new) {
                // set item's title, author, url, pubdate, description, content, enclosure (optional)*
                $feed->add(
                    $new->getContent('name'),
                    'ORCHID - Simple and flexible control panel',//$post->author,
                    URL::to($new->slug),
                    $new->created_at,
                    $new->getContent('description'),
                    $new->getContent('body')
                );
            }
        }
        return $feed->render('atom');
    }

}
