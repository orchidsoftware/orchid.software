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

$this->view('{locale?}', 'pages.welcome')->name('index');
$this->get('{locale}/docs/{catalog?}', 'Documentation@show')->name('docs');

$this->view('{locale}/developer','pages.developer');
$this->view('{locale}/order','pages.order');


$this->get('{locale}/blog','BlogController@index')->name('blog');
$this->get('{locale}/blog/{blog}','BlogController@show')->name('blog.show');

$this->get('{locale}/plugins', 'PluginController@index')->name('plugins');
$this->get('{locale}/plugins/{vendor?}/{package?}', 'PluginController@show')->name('plugins.show');

$this->view('{locale}/ui','pages.ui');
$this->view('{locale}/privacy-policy','pages.privacy-policy');
$this->view('{locale}/code-of-conduct','pages.code-of-conduct');

$this->view('{locale}/icons','pages.icons');
$this->view('{locale}/help-and-discussion','pages.help-and-discussion')->name('help');

