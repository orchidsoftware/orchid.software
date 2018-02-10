<?php

namespace App\Http\Controllers;

use Orchid\Platform\Core\Models\Post;

class BlogController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $posts = Post::published()->where('type', 'blog')
            ->orderBy('publish_at', 'DESC')
            ->simplePaginate(5);

        return view('pages.news', [
            'posts' => $posts,
        ]);

    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale,Post $post){
        return view('pages.article',[
            'post' => $post,
        ]);
    }
}
