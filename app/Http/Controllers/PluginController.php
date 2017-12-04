<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orchid\Platform\Core\Models\Post;

class PluginController extends Controller
{
    public function index(){

        $plugins = Post::type('plugins')->paginate();
        $top = Post::type('plugins')->orderByDesc('content->github_stars')->limit(10)->get();

        return view('pages.plugins',[
            'plugins' => $plugins,
            'top' => $top
        ]);
    }

    /**
     * @param $vendor
     * @param $package
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($vendor,$package){
       $package = Post::type('plugins')->where('slug',$vendor.'/'.$package)->firstOrFail();
       $content = ( new \Parsedown())->text($package->content['content']);

       //dd($package->content,$content);
       return view('pages.package',[
           'package' => $package,
           'content' => $content
       ]);
    }

}
