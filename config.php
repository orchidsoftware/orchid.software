<?php

use Illuminate\Support\Str;

return [
    'baseUrl'         => 'http://localhost:3000',
    'production'      => false,
    'siteName'        => 'Orchid - Laravel Admin Panel',
    'siteDescription' => 'RAD platform for building a business application using the Laravel framework. Can act as the basis for web applications or perform the functions of CMS, CMF or admin panel for your site.',

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
];
