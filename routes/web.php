<?php

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



    $this->view('{locale?}', 'pages.welcome')
        ->name('index')
        ->where('locale','^(?!dashboard).*$');

    $this->get('{locale}/docs/{catalog?}', 'Documentation@show')
        ->name('docs')
        ->where('locale','^(?!dashboard).*$');

    $this->view('{locale}/developer', 'pages.developer')->where('locale','^(?!dashboard).*$');
    $this->view('{locale}/order', 'pages.order')->where('locale','^(?!dashboard).*$');


    $this->get('{locale}/blog', 'BlogController@index')
        ->name('blog')
        ->where('locale','^(?!dashboard).*$');

    $this->get('{locale}/blog/{blog}', 'BlogController@show')
        ->name('blog.show')
        ->where('locale','^(?!dashboard).*$');

    $this->get('{locale}/plugins', 'PluginController@index')
        ->name('plugins')
        ->where('locale','^(?!dashboard).*$');

    $this->get('{locale}/plugins/{vendor?}/{package?}', 'PluginController@show')
        ->name('plugins.show')
        ->where('locale','^(?!dashboard).*$');

    $this->view('{locale}/ui', 'pages.ui')->where('locale','^(?!dashboard).*$');

    $this->view('{locale}/privacy-policy', 'pages.privacy-policy')->where('locale','^(?!dashboard).*$');

    $this->view('{locale}/code-of-conduct', 'pages.code-of-conduct')->where('locale','^(?!dashboard).*$');


    $this->view('{locale}/icons', 'pages.icons')
        ->name('icons')
        ->where('locale','^(?!dashboard).*$');
    $this->view('{locale}/help-and-discussion', 'pages.help-and-discussion')
        ->name('help')
        ->where('locale','^(?!dashboard).*$');
