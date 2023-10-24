<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/{locale?}', function (string $locale = 'en') {
    app()->setLocale($locale);

    return view('welcome');
})->where('locale', 'en|ru');

Route::get('/{locale?}/donations', function (string $locale = 'en') {
    app()->setLocale($locale);

    return view('donations');
})->where('locale', 'en|ru');

Route::get('/{locale?}/license', function (string $locale = 'en') {
    app()->setLocale($locale);

    return view('license');
})->where('locale', 'en|ru');


Route::get('/{locale}/{type}/orchid-icons', function (string $locale, string $type) {

    $icons = collect(scandir(\Orchid\IconPack\Path::getFolder()))
        ->filter(function ($value) {
            return !($value === '.' || $value === '..');
        })
        ->filter(function (string $icon) {
            return file_exists(Orchid\IconPack\Path::getFolder() . "/$icon");
        })
        ->mapWithKeys(function ($icon) {
            return [str_replace('.svg', '', $icon) => file_get_contents(Orchid\IconPack\Path::getFolder() . "/$icon")];
        });

    return (new App\Docs($locale, "$type/orchid-icons"))
        ->view('icons')
        ->with('icons', $icons);

})->where('locale', 'en|ru');


Route::get('/{locale}/{type}/{page?}', function (string $locale, string $type, string $page = 'index') {
    return (new App\Docs($locale, "$type/$page"))->view('docs');
})->where('locale', 'en|ru')
    ->where('page', '(.*)');
