---
title: Configuration
description: Learn how to configure Laravel Orchid's powerful features to customize and optimize your application. Our comprehensive documentation on the Configuration page will guide you through the process.
---


The package uses the standard configuration system for Laravel. It stores the main parameters in the `config` directory, and the main file for the platform is the file `platform.php`. Each setting comes with a comment explaining its purpose.

> **Note.** After caching your configuration files, don’t forget to clear the cache if you make changes. Use the `php artisan config:clear` command to refresh it.

In this section, we will delve into the configuration file and provide a detailed description of each parameter.

## Domain

```php
'domain' => env('DASHBOARD_DOMAIN', null),
```

For many projects, the address of the location of the administration panel plays an important role. For example, the application is located at `example.com`, and the platform is at `admin.example.com` or on a third-party domain.

To specify the address you would like to use for the platform, you can set the `domain` parameter in the configuration file:

```php
'domain' => 'admin.example.com',
```
 
It is important to note that your web server settings must be configured correctly for this to work. For example, if you are using Apache, you will need to set up a virtual host for the domain you specified in the configuration file.


## Prefix


```php
'prefix' => env('DASHBOARD_PREFIX', 'admin'),
```
 
The `prefix` parameter allows you to change the default `admin` prefix to any other name, such as `admin` or `administrator`. This is useful if you want to use a different prefix for your admin panel or if the default prefix is already in use by another part of your application. 
 
For example, if you set the prefix to `dashboard`, the URL for the admin login page would be `https://example.com/dashboard/login` instead of `https://example.com/admin/login`. 
 
 To change the prefix, you can update the prefix parameter in the configuration file:
 
 ```php
 'prefix' => 'dashboard',
 ```
 
 It's worth noting that changing the prefix will also change the URL of all routes within the admin panel, so make sure to update any links or redirects that reference the old prefix.


## Middleware

```php
'middleware' => [
    'public'  => [
        'web', 
        'cache.headers:private;must_revalidate;etag'
    ],
    'private' => [
        'web',
        'platform',
        'cache.headers:private;must_revalidate;etag'
    ],
],
```

The `middleware` parameter allows you to add or change the middleware (intermediate layers) used for the admin panel. By default, the platform comes with two groups of middleware: `public` and `private`.

The `public` middleware is applied to routes that can be accessed by an unauthorized user, such as the login page. The `private` middleware, on the other hand, is applied to routes that can only be accessed by authorized users, such as the dashboard page.

You can add as many new middleware as you like. For example, you can add a middleware that filters requests from a specific IP address range or a middleware that checks for a valid API token.



## Login Page

```php
'auth' => true,
```

The `auth` parameter controls whether the package uses its own simple login interface or not. By default, it is set to `true`, which means the platform will use its own login interface.


If you require more advanced features such as password recovery or two-factor authentication, you can set auth to false and use a package like [Jetstream](https://laravel.com/docs/authentication#authentication-quickstart) or roll your own login interface.

To use a package like Jetstream, you will need to install it and configure it according to its documentation. If you roll your own login interface, you will need to create the necessary controllers, views, and routes for the login process.

```php
'auth' => false,
```

## Home Page

The `index` parameter controls the main page of the admin panel that the user will see when they first log in or click on the logo or links in the navigation bar.

```php
'index' => 'platform.main',
```

The default value for this parameter is `platform.main`, which corresponds to the main dashboard page of the platform.

You can change this to any other route you have defined in your application. For example, if you want to redirect users to a custom dashboard page, you can update the `index` parameter to point to that route:

```php
'index' => 'custom.dashboard',
```

It's worth noting that you will need to create the corresponding route and controller for the new home page.


## Dashboard Resources


```php
'resource' => [
    'stylesheets' => [],
    'scripts'     => [],
],
```

The `resource` parameter allows you to add your own stylesheets or javascript scripts to the admin panel. You can globally add paths to the corresponding arrays in the configuration file.

For example, if you want to include a custom stylesheet on every page of the admin panel, you can add the path to the `stylesheets` array:

```php
'resource' => [
    'stylesheets' => [
        '/path/to/custom.css'
    ],
    'scripts'     => [
        '/path/to/custom.js', // Local path in the public directory
        'https://cdn.example.com/app.js', // CDN path
        Vite::asset('resources/js/app.js'), // Vite asset
    ],
],
```

It's worth noting that the resource file must be present in the `public` directory to be able to access it.

## Appearance Patterns

To change some templates, it is unnecessary to publish the entire package; you can customize a part of the user interface to specify a logo, accompanying documents, etc.

```php
'template' => [
    'header' => null,
    'footer' => null,
],
```


## Overriding Blade Templates


Backend pages are created using [Blade](https://laravel.com/docs/blade). You can change these using Laravel's template override mechanism (this is the same for all packages, not just Orchid);

> 🚨 **Alert!** Overridden templates do not receive updates or bug fixes. Think of this as turning off the autopilot.

Following Laravel's mechanism for overriding templates from packages is to create the `/resources/views/vendor/platform/` directory in your application and create new templates with the same path as the original templates. 

For example, to override `/vendor/orchid/platform/resources/views/partials/search.blade.php`, create a new template at
`/resources/views/vendor/platform/partials/search.blade.php`. An illustrative example: 


```php
your-project/
├─ ...
└─ resources/
   └─ views/
      └─ vendor/
         └─ platform/
            └─ partials/
                └─ search.blade.php          
```



## Model Classes

The desire to change the behavior of some classes from the standard delivery is quite normal. For the platform to use your model classes instead of its own, it is necessary to register their substitution in advance using:

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
    public function boot()
    {
        Dashboard::useModel(
            \Orchid\Platform\Models\User::class, 
            \App\Models\User::class
        );
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
