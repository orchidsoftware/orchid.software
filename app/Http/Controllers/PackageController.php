<?php

namespace App\Http\Controllers;

use Orchid\Platform\Core\Models\Post;

class PackageController extends Controller
{
    public function index()
    {
        $top = Post::type('packages')->orderByDesc('content->github_stars')->limit(12)->get();
        $count = Post::type('packages')->count();

        return view('pages.packages', [
            'top'   => $top,
            'count' => number_format($count),
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
        $package = Post::type('packages')
            ->where('slug', $vendor . '/' . $package)
            ->with('tags')
            ->firstOrFail();
        $content = (new \Parsedown())->text($package->content['content']);


        $similars = Post::withTag($package->tags->implode('slug', ', '))
            ->type('packages')
            ->where('id', '!=', $package->id)
            ->limit(3)
            ->get();

        //dd($package->content);

        return view('pages.package', [
            'package' => $package,
            'content' => $content,
        ]);
    }

}
