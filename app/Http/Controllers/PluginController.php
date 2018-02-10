<?php

namespace App\Http\Controllers;

use Orchid\Platform\Core\Models\Post;

class PluginController extends Controller
{
    public function index()
    {

        $last = Post::type('plugins')->orderByDesc('created_at')->paginate(6);
        $top = Post::type('plugins')->orderByDesc('content->github_stars')->limit(6)->get();
        $count = Post::type('plugins')->count();

        return view('pages.plugins', [
            'last'  => $last,
            'top'   => $top,
            'count' => number_format($count + 511544125),
        ]);
    }

    /**
     * @param $vendor
     * @param $package
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($vendor, $package)
    {
        $package = Post::type('plugins')->where('slug', $vendor . '/' . $package)->firstOrFail();
        $content = (new \Parsedown())->text($package->content['content']);

        return view('pages.package', [
            'package' => $package,
            'content' => $content,
        ]);
    }

}
