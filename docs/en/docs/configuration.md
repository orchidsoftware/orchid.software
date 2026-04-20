---
title: Configuration
description: Learn how to configure Laravel Orchid's powerful features to customize and optimize your application. Our comprehensive documentation on the Configuration page will guide you through the process.
---


The package uses the standard configuration system for Laravel. It stores the main parameters in the `config` directory, and the main file for the platform is the file `platform.php`. Each setting comes with a comment explaining its purpose.

> **Note.** After caching your configuration files, don’t forget to clear the cache if you make changes. Run `php artisan config:clear` so your changes take effect. Prefer reading values via `config('platform.key')` and avoid using `env()` directly in application code.

In this section, we will delve into the configuration file and provide a detailed description of each parameter.

## Domain

```php
'domain' => env('PLATFORM_DOMAIN', null),
```

For many projects, the address of the location of the administration panel plays an important role. For example, the application is located at `example.com`, and the platform is at `admin.example.com` or on a third-party domain.

To specify the address you would like to use for the platform, you can set the `domain` parameter in the configuration file:

```php
'domain' => 'admin.example.com',
```
 
It is important to note that your web server settings must be configured correctly for this to work. For example, if you are using Apache, you will need to set up a virtual host for the domain you specified in the configuration file.


## Prefix

```php
'prefix' => env('PLATFORM_PREFIX', '/admin'),
```

The `prefix` parameter defines the URL path segment for the admin panel. The default is `/admin`, so the login page is available at `https://example.com/admin/login`. You can change it to any path, such as `dashboard` or `panel`.

For example, if you set the prefix to `dashboard`, the URL for the admin login page would be `https://example.com/dashboard/login`:

```php
'prefix' => '/dashboard',
```

> **Note:** The router expects a leading slash when using the default; the config default is `/admin`. Changing the prefix affects all dashboard routes, so update any links or redirects that reference the old path.


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


## Guard

```php
'guard' => env('AUTH_GUARD', 'web'),
```

The `guard` option specifies which Laravel [authentication guard](https://laravel.com/docs/authentication) is used when accessing the dashboard. Use this when you have multiple user types, such as customers and admins, with separate guards. The default is `web`.

For more on using a custom guard with Orchid, see [Authentication](/en/docs/authentication#guard).


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

## Profile Route

The `profile` option defines the route name for the user profile page. When users click their profile or avatar, they will be sent to this route.

```php
'profile' => 'platform.profile',
```

You may change this to a custom route name if you have defined your own profile screen.

## Asset Resources


```php
'resource' => [
    'stylesheets' => [],
    'scripts'     => [],
],
```

The `resource` parameter allows you to add your own stylesheets or JavaScript scripts to the admin panel. You can globally add paths to the corresponding arrays in the configuration file.

For example, if you want to include a custom stylesheet on every page of the admin panel, you can add the path to the `stylesheets` array:

```php
'resource' => [
    'stylesheets' => [
        '/path/to/custom.css'
    ],
    'scripts'     => [
        '/path/to/custom.js', // Local path in the public directory
        'https://cdn.example.com/app.js', // CDN path
    ],
],
```

It's worth noting that the resource file must be present in the `public` directory to be able to access it.

## Vite

If you use [Vite](https://laravel.com/docs/vite) for frontend assets, add the entry paths to the `vite` array so they are included on orchid pages:

```php
'vite' => [
    'resources/js/app.js',
    'resources/css/app.css',
],
```

See [JavaScript and Vite](/en/docs/javascript) for details.

## Appearance Patterns

To change some templates, you do not need to publish the entire package. You can customize a part of the user interface to specify a logo, accompanying documents, and more.

```php
'template' => [
    'header' => null,
    'footer' => null,
],
```

For a full guide on customizing the logo, header, footer, and overall look of the Orchid, see [Branding](/en/docs/brand).

## Attachment Defaults

Orchid stores uploaded files using Laravel's filesystem. You can set the default disk and an optional custom filename generator:

```php
'attachment' => [
    'disk'      => env('PLATFORM_FILESYSTEM_DISK', 'public'),
    'generator' => \Orchid\Attachment\Engines\Generator::class,
],
```

Use the `disk` key to point to any disk defined in `config/filesystems.php`. The `generator` class is used to create unique filenames for new uploads.

## Icons

```php
'icons' => [
    'bs'  => \Orchid\Support\BootstrapIconsPath::getFolder(),
],
```

Orchid uses SVG icon sets that you can extend or override. The `icons` array maps a short name to a path where SVG files are stored. The default set `bs` points to Bootstrap Icons.

To add a custom set, add an entry with the name and path:

```php
'icons' => [
    'bs'  => \Orchid\Support\BootstrapIconsPath::getFolder(),
    'fa'  => storage_path('app/fontawesome'),
],
```

In layouts and actions, reference an icon by the set name and the file name (without `.svg`): for example, `->icon('bs.heart')` or `->icon('fa.user')`. For more, see [Icons](/en/docs/icons).

## Notifications

The notification bell in the navigation bar polls for new notifications. You can disable it or change the polling interval:

```php
'notifications' => [
    'enabled'  => true,
    'interval' => 60,
],
```

`interval` is the number of seconds between polling requests.

## Search

The sidebar search feature uses [Laravel Scout](https://laravel.com/docs/scout) to search through the models you list here. Each model must be searchable (using Scout's `Searchable` trait) and have a [Presenter](/en/docs/presenters) that implements the search display interface.

```php
'search' => [
    \App\Models\User::class,
    \App\Models\Post::class,
],
```

After adding or removing models, run `php artisan config:clear` so the dashboard picks up the change.

> **Tip.** For the full setup (Scout, Presenter, and display), see [Global Search](/en/docs/global-search).

## Turbo (Hotwire)

Turbo Drive powers the smooth, app-like navigation in the dashboard. You can tune caching and how the page updates after actions:

```php
'turbo' => [
    'cache'          => true,
    'prefetch'       => true,
    'refresh-method' => 'replace',
    'refresh-scroll' => 'preserve',
],
```

For screens that use toggles or other controls that update the DOM, `refresh-method` set to `morph` and `refresh-scroll` to `preserve` often give the best experience. See the [Screens](/en/docs/screens) and [JavaScript](/en/docs/javascript) documentation for more on Turbo.

## Workspace

The workspace option sets the template that wraps screen content—either a compact width or full width:

```php
'workspace' => 'platform::workspace.compact',
```

Options: `platform::workspace.compact`, `platform::workspace.full`.

## Fallback Page

When a request does not match any Orchid route, Orchid can render its own 404 page. Set to `false` if you register your own routes under the same domain and prefix and want to handle 404 responses yourself:

```php
'fallback' => true,
```

## Prevents Abandonment

When enabled, Orchid can warn users before leaving a page if they have unsaved changes. You can disable it globally here. Individual screens can override this via `needPreventsAbandonment()`:

```php
'prevents_abandonment' => true,
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

## Service Provider

```php
'provider' => \App\Orchid\PlatformProvider::class,
```

The `provider` value is the class name of the service provider where the platform registers its menu, permissions, and other bootstrap logic. By default, this is `\App\Orchid\PlatformProvider::class`.

You only need to change this if you move Orchid's bootstrap (for example, the `PlatformProvider` class) to another namespace. In that case, point this option to your custom provider class.

> **Note.** The provider class should extend `Orchid\Platform\OrchidServiceProvider` and implement `menu()` and, if needed, `permissions()`.

## Overriding Blade Templates


Backend pages are created using [Blade](https://laravel.com/docs/blade). You can change these using Laravel's template override mechanism. This approach works the same for all Laravel packages, not just Orchid.

> 🚨 **Alert!** 
> Overridden templates do not receive updates or bug fixes.
> Think of this as turning off the autopilot.

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
