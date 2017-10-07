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

$router->group([
    'prefix'     => Localization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'carbon-localize'],
], function () {



    /*
    |--------------------------------------------------------------------------
    | Auth Routes
    |--------------------------------------------------------------------------
    |
    */
    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');
    // Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');
    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');


    /*
    |--------------------------------------------------------------------------
    | Catalog Routes
    |--------------------------------------------------------------------------
    |
    */
    $this->get('catalog/{catalog}', 'CatalogController@index')->name('catalog');
    $this->get('category/{category}', 'CatalogController@category')->name('category');
    $this->get('catalog/{catalog}/{item}', 'CatalogController@show')->name('item');


    /*
    |--------------------------------------------------------------------------
    | Static Routes
    |--------------------------------------------------------------------------
    |
    */
    $this->get('/about', 'AboutController@index')->name('about');
    $this->post('/contacts', 'ContactsController@send')->name('contacts.submit');
    $this->get('/contacts', 'ContactsController@index')->name('contacts');
    $this->get('docs/{catalog?}', 'Documentation@show')->name('docs');

    $this->get('/', 'AboutController@welcome');


    $this->get('blog', 'BlogController@index')->name('articles');
    $this->get('rss', 'BlogController@rss')->name('rss');
    $this->get('blog/{blog}', 'BlogController@show')->name('article');
    $this->put('/comment/{item}', 'CommentController@update')->name('comment.add');

    $this->get('/news',function (){
        return view('pages.news');
    });

    $this->get('/plugins', 'PluginController@index')->name('plugins');

    $this->view('/ui','pages.ui');

    $this->get('/home', 'HomeController@index')->name('home');

});
