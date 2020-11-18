<?php

use Illuminate\Support\Str;

return [
    'baseUrl'         => 'http://localhost:3000',
    'production'      => false,
    'siteName'        => 'Orchid - Laravel Admin Panel',
    'siteDescription' => 'A free Laravel package that abstracts standard business logic and allows code-driven rapid application development of back office applications like admin panels and dashboards.',

    // Algolia DocSearch credentials
    'docsearchApiKey'    => '',
    'docsearchIndexName' => '',

    // navigation menu
    'navigation' => require_once('navigation.php'),

    // helpers
    'isActive' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },
    'isActiveParent' => function ($page, $menuItem) {
        if (is_object($menuItem) && $menuItem->children) {
            return $menuItem->children->contains(function ($child) use ($page) {
                return trimPath($page->getPath()) == trimPath($child);
            });
        }
    },
    'url' => function ($page, $path) {
        return Str::startsWith($path, 'http') ? $path : '/'.trimPath($path);
    },

    'ahref' => function($page, $locale){

      $pattern = "/$locale/";

      $url = str_ireplace([
        $page->baseUrl . '/ru',
        $page->baseUrl . '/en',
      ], $pattern, $page->getUrl());

      if(!Str::contains($url,$pattern)){
        $url .= $pattern;
      }


      $url = $page->baseUrl . str_replace('//', '/', parse_url($url,PHP_URL_PATH));

      return Str::finish($url, '/');
    },

    'editGitHub' => function($page) {

        $path = trimPath($page->getPath());

        if (is_dir(__DIR__ . '/source/' . $path)) {
            $path .= '/index.md';
        }else{
            $path .= '.md';
        }

        return "https://github.com/orchidsoftware/orchid.software/edit/master/source/$path";
    },

    'icons' => function () {
        return collect(scandir(Orchid\IconPack\Path::getFolder()))
            ->filter(function ($value){
                return !($value === '.' || $value === '..');
            })
            ->map(function ($value) {
                return str_replace('.svg','', $value);
            });
    },

    'getIcon' => function ($page, string $icon) {

        if (file_exists(Orchid\IconPack\Path::getFolder() . "/$icon.svg")) {

            return file_get_contents(Orchid\IconPack\Path::getFolder() . "/$icon.svg");
        }

    },

    'getBlogItems' => function () {

        if(isset($this->rssBlogItems)){
            return $this->rssBlogItems;
        }

        try {
            $lastNews = collect();

            foreach (Feed::loadAtom('https://blog.orchid.software/feed.atom')->entry as $entry) {
                $lastNews->push($entry);
            }

            return $this->rssBlogItems = $lastNews->take(3)->toArray();
        } catch (\Exception $exception) {
            return $this->rssBlogItems = [];
        }
    },
];
