<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orchid\CMS\Core\Models\Post;

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
}
