<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Parsedown;

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
     * Documentation constructor.
     */
    public function __construct()
    {
        $this->parse = new Parsedown();
        $this->storage =  Storage::disk('docs');
    }

    /**
     * @param string $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($page = 'installation'){

       $lang = App::getLocale();

       $menu = $this->storage->get("/$lang/documentation.md");
       $contents = $this->storage->get("/$lang/$page.md");

       return view('pages.docs',[
           'menu' => $this->parse->text($menu),
           'content' => $this->parse->text($contents)
       ]);
    }
}
