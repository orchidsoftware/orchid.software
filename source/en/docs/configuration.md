---
title: Platform configuration
description: ORCHID uses the standard configuration system for Laravel.
extends: _layouts.documentation.en
section: main
---

The platform uses the standard configuration system for Laravel.
The main parameters are located in the `config` directory, and the main file for the platform is
file `platform.php`. Each setting comes with a commentary explaining the main point.

> ** Note. ** If you cache your configuration files, do not forget to clear them after the change. Using the command `php artisan config: clear`

Below we dive into the configuration file and give a detailed description of each parameter.

## Platform Address

```php
'domain' => env('DASHBOARD_DOMAIN', null),
```

For many projects, the address of the location of the administration panel plays an important role.
For example, the application is located at `example.com`, and the platform is at `admin.example.com` or on a third-party domain.

For this you need to specify the address you would like to open.

```php
'domain' => 'admin.example.com',
```
 
Remember that your web server settings must be configured properly.


## Platform Prefix


```php
'prefix' => env('DASHBOARD_PREFIX', 'dashboard'),
```
 
Provides the ability to change the `dashboard` prefix to any other name, such as` admin` or `administrator`.


## Middleware

```php
'middleware' => [
    'public'  => ['web'],
    'private' => ['web', 'platform'],
],
```

You can add/change intermediate layers (middleware) for the graphical interface.
Currently there are two groups of `public` that can be seen by an unauthorized user,
for example, the "Login" or "Password Recovery" page and `private` which, on the contrary, only authorized users see.


You can add as many new intermediate layers as you like.
for example, the filtering layer requests only from the white list of IP addresses.


## Login page

```php
'auth' => true,
```

It is possible to completely disable the supplied authorization form and make your own, for example, using the command:

```php
php artisan make:auth
```

## Home Page

The main page of the application is recorded in the form of the **name route** that the user will see when entering or clicking on logos and links.
```php
'index' => 'platform.main',
```

## Dashboard Resources


```php
'resource' => [
    'stylesheets' => [],
    'scripts'     => [],
],
```

As you work, you may need to add your own style sheets or javascript scripts.
globally, on each page, it is necessary to add paths for them to the corresponding arrays.

It is also possible to specify resources through the `Dashboard` object, for example, in a service provider:


```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        $dashboard->registerResource('stylesheets', 'custom.css');
        $dashboard->registerResource('scripts', 'custom.js');
    }
}
```


## Appearance Patterns

To change some templates, it is not necessary to publish the entire package; you can customize part of the user interface to specify a logo, accompanying documents, etc.

```php
'template' => [
    'header' => 'platform::header',
    'footer' => 'platform::footer',
],
```


## Model Classes

The desire to change the behavior of some classes from the standard delivery is quite normal, in order for the platform to use your model classes instead of its own, it is necessary to register their substitution in advance using:

```php
Dashboard::useModel(\Orchid\Platform\Models\User::class, \App\User::class);
```

You can use the configuration parameter, which allows you to define all the substitutions at once:

```php
Dashboard::configure([
    'models' => [
        User::class => MyCustomClass::class,
    ],
]);
```
