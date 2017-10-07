<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orchid\CMS\Core\Models\Page;

class PluginController extends Controller
{
    public function index(){

        $plugins = Page::type('plugins')->paginate();

        return view('pages.plugins',[
            'plugins' => $plugins
        ]);
    }
}
