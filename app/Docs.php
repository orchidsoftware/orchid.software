<?php

namespace App;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Symfony\Component\Yaml\Yaml;

class Docs
{
    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $locale
     * @param string $path
     */
    public function __construct(string $locale, string $path)
    {
        app()->setLocale($locale);

        $this->locale = $locale;
        $this->path = "/$locale/$path.md";
    }

    /**
     * @param string $view
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function view(string $view)
    {
        $page = Storage::disk('docs')->get($this->path);

        $variables = Str::of($page)->after('---')->before('---');

        $variables = Yaml::parse($variables);

        $all = collect()->merge($variables)->merge([
            'content' => Blade::render(Str::of($page)->after('---')->after('---')->markdown()),
            'edit'    => $this->editLinkGitHub(),
        ]);

        return view($view, $all);
    }

    /**
     * @return string
     */
    protected function editLinkGitHub()
    {
        return "https://github.com/orchidsoftware/orchid.software/edit/master/docs$this->path";
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public static function ahref(string $locale)
    {
        $pattern = "/$locale/";

        $url = str_ireplace([
            config('app.url') . '/ru',
            config('app.url') . '/en',
        ], $pattern, URL::current());

        if (!Str::contains($url, $pattern)) {
            $url .= $pattern;
        }

        $url = config('app.url') . str_replace('//', '/', parse_url($url, PHP_URL_PATH));

        return Str::finish($url, '/');
    }
}
