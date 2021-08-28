---
title: Platform configuration
description: ORCHID uses the standard configuration system for Laravel.
extends: _layouts.documentation
section: main
---

The platform uses the standard configuration system for Laravel.
It locates the main parameters in the `config` directory, and the main file for the platform is
file `platform.php`. Each set comes with a commentary explaining the main point.

> **Note.** If you cache your configuration files, do not forget to clear them after the change. Using the command `php artisan config:clear`

Below we dive into the configuration file and give a detailed description of each parameter.

## Platform domain

```php
'domain' => env('DASHBOARD_DOMAIN', null),
```

For many projects, the address of the location of the administration panel plays an important role.
For example, the application is located at `example.com`, and the platform is at `admin.example.com` or on a third-party domain.

For this you need to specify the address you would like to open.

```php
'domain' => 'admin.example.com',
```
 
Remember that your web server settings must be configured correctly.


## Platform prefix


```php
'prefix' => env('DASHBOARD_PREFIX', 'dashboard'),
```
 
It provides the ability to change the `dashboard` prefix to any other name, such as `admin` or `administrator`.


## Middleware

```php
'middleware' => [
    'public'  => ['web'],
    'private' => ['web', 'platform'],
],
```

You can add/change intermediate layers (middleware) for the graphical interface.
Currently, two groups of `public` can be seen by an unauthorized user,
for example, the "Login" page and `private` which, on the contrary, only authorized users to see.


You can add as many new intermediate layers as you like.
For example, the filtering layer requests only from the white list of IP addresses.


## Login page

```php
'auth' => true,
```

By default, Orchid uses its own simple login interface when `auth` is `true`. If you require more advanced functions
such as password recovery or 2FA, set `auth` to `false` and use the package [Jetstream](https://laravel.com/docs/authentication#authentication-quickstart)
or roll your own.

## Home page

The main page of the application is recorded in the **name route** that the user will see when entering or clicking on logos and links.
```php
'index' => 'platform.main',
```

## Dashboard resources


```php
'resource' => [
    'stylesheets' => [],
    'scripts'     => [],
],
```

As you work, you may need to add your style sheets or javascript scripts.
Globally, on each page, it is necessary to add paths for them to the corresponding arrays.

It is also possible to specify resources through the `Dashboard` object, for example, in a service provider:


```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    public function boot(Dashboard $dashboard)
    {
        $dashboard->registerResource('stylesheets', 'custom.css');
        $dashboard->registerResource('scripts', 'custom.js');
    }
}
```


## Appearance patterns

To change some templates, it is unnecessary to publish the entire package; you can customize a part of the user interface to specify a logo, accompanying documents, etc.

```php
'template' => [
    'header' => null,
    'footer' => null,
],
```


## Model classes

The desire to change the behavior of some classes from the standard delivery is quite normal. For the platform to use your model classes instead of its own, it is necessary to register their substitution in advance using:

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Support\Facades\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Dashboard::useModel(\Orchid\Platform\Models\User::class, \App\User::class);
    }
}
```

You can use the configuration parameter, which allows you to define all the substitutions at once:

```php
Dashboard::configure([
    'models' => [
        User::class => MyCustomClass::class,
    ],
]);
```
