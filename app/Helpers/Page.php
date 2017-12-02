<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Orchid\Platform\Core\Models\Page;


/**
 * Get page by slug
 */
/*
if (!function_exists('getPage')) {
    function getPage(string $slug) : Page
    {
        return Cache::remember('static-page-' . App::getLocale() . '-' . $slug, 60, function () use ($slug) {
            return Page::where('slug', $slug)->first() ?: new Page();
        });

    }
}
*/
