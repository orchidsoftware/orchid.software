<?php

use App\Docs;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Orchid\IconPack\Path;

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

Route::get('/design-system', function (): View {
    app()->setLocale('ru');

    return view('design-system');
})->name('design-system');

Route::get('/{locale?}', function (string $locale = 'en') {
    app()->setLocale($locale);

    return view('welcome');
})->where('locale', 'en|ru');

Route::get('/{locale?}/donations', function (string $locale = 'en') {
    app()->setLocale($locale);

    return view('donations');
})->where('locale', 'en|ru');

Route::get('/{locale?}/discussions', function (string $locale = 'en') {
    app()->setLocale($locale);

    return view('discussions');
})->where('locale', 'en|ru');

Route::get('/{locale?}/changelog', function (string $locale = 'en') {
    app()->setLocale($locale);

    $response = Http::get('https://raw.githubusercontent.com/orchidsoftware/platform/master/CHANGELOG.md')
        ->body();

    $content = Str::of($response)->markdown();

    return view('changelog', [
        'content' => $content,
    ]);
})->where('changelog', 'en|ru');

Route::get('/{locale?}/license', function (string $locale = 'en') {
    app()->setLocale($locale);

    return view('license');
})->where('locale', 'en|ru');

$showIcons = function (string $locale, ?string $version = null) {

    $icons = collect(scandir(Path::getFolder()))
        ->filter(function ($value) {
            return ! ($value === '.' || $value === '..');
        })
        ->filter(function (string $icon) {
            return file_exists(Path::getFolder()."/$icon");
        })
        ->mapWithKeys(function ($icon) {
            return [str_replace('.svg', '', $icon) => file_get_contents(Path::getFolder()."/$icon")];
        });

    return (new Docs($locale, 'docs/orchid-icons', $version))
        ->view('icons')
        ->with('icons', $icons);

};

Route::get('/{locale}/docs/{version}/orchid-icons', $showIcons)
    ->where(['locale' => 'en|ru', 'version' => '\d+\.x']);

Route::get('/{locale}/docs/orchid-icons', $showIcons)->where('locale', 'en|ru');

Route::get('/{locale}/docs/{version}/{page?}', function (string $locale, string $version, string $page = 'index') {
    return (new Docs($locale, "docs/$page", $version))->view('docs');
})->where(['locale' => 'en|ru', 'version' => '\d+\.x', 'page' => '.*']);

Route::get('/{locale}/{type}/{page?}', function (string $locale, string $type, string $page = 'index') {
    return (new Docs($locale, "$type/$page"))->view('docs');
})->where('locale', 'en|ru')
    ->where('page', '(.*)');

Route::view('llms.txt', 'llms', [
    'name'        => config('site.name'),
    'description' => config('site.description'),
    'navigation'  => config('site.navigation.en'),
]);
