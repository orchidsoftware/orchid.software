---
title: Package Development
description: Learn how to develop packages for Orchid
---

> ⚠️ **Attention:** This section is still a work in progress and isn't 100% ready for use. 🚧
>
> It may lack complete information or contain inaccuracies. If you are not an enthusiast or experienced user, it is recommended to wait until this section is finalized and verified before relying on the information provided here. Updates will be made to ensure the section is complete and accurate as soon as possible. Thank you for your patience and understanding.



## Package Service Providers

In Laravel, a service provider is a crucial component that sets up and configures the various features and functionality of a package. 
The Orchid package also requires a service provider to integrate with your Laravel application.

> **Note for beginners:** Please be aware that the Orchid documentation page primarily focuses on demonstrating the usage and features of the Orchid platform.
>  It does not cover more fundamental topics like creating a Composer package, registering it on Packagist, or basic Laravel package development.
>  If you are new to PHP and Laravel, it is recommended to consult other beginner-friendly resources that specifically address those topics before diving into the Orchid documentation. ↩

To learn more about service providers in Laravel and how they work, you can refer to the [official Laravel documentation on service providers](https://laravel.com/docs/providers).

The Orchid package provides its own service provider called `Orchid\Platform\OrchidServiceProvider`.
This service provider extends the core Laravel `ServiceProvider` class and provides additional functionality specific to the Orchid package.
It allows you to register menus, permissions, routes, and other features within the Orchid dashboard.


To create a custom service provider for your package that extends the functionality of the `OrchidServiceProvider`, you can follow this example:

- Create a new file called `MyPackageServiceProvider.php` in your package directory.
- In the `MyPackageServiceProvider` class, extend the `OrchidServiceProvider` class provided by Orchid:

```php
use Orchid\Platform\OrchidServiceProvider;

class MyPackageServiceProvider extends OrchidServiceProvider
{
   // Your package-specific code here
}
```

This will allow you to utilize the features and methods provided by the `OrchidServiceProvider` class while also adding your own customizations and configurations specific to your package.


## Define Routes

To define routes in your package, create a `routes` method within your service provider.
You can use the standard Laravel routing mechanisms to register your routes with the `Router` instance.

```php
use Illuminate\Routing\Router;

/**
 * Define routes setup.
 *
 * @param \Illuminate\Routing\Router $router
 *
 * @return void
 */
public function routes(Router $route): void
{
    // Define your routes here
    $route->screen('private-route', MyPackageScreen::class)
        ->name('package');
}
```


## Define Permissions

Laravel Orchid provides a flexible permission system to control access to different parts of your package. 
To define permissions, override the `permissions` method in your service provider. 
This method should return an array of `ItemPermission` instances provided by the Orchid package.

```php
use Orchid\Platform\ItemPermission;

/**
 * Register permissions for the application.
 *
 * @return ItemPermission[]
 */
public function permissions(): array
{
    // Define your permissions here
    return [
        ItemPermission::group('Package Name')
            ->addPermission('platform.package.option', 'View Options')
            ->addPermission('platform.package.other', 'View Content'),
    ];
}
```

Specify the group name, permission key, and description for each permission.


## Define Navigation

To define navigation menus for your package, override the `menu` method in your service provider.
This method should return an array of `Menu` instances provided by the Orchid package.

```php
use Orchid\Screen\Actions\Menu;

/**
 * Register the application menu.
 *
 * @return Menu[]
 */
public function menu(): array
{
    // Define your menu items here
    return [
        Menu::make('My Package')
            ->icon('bs.book')
            ->route('package.index'),
    ];
}
```


## Define Resources

Laravel Orchid allows you to register custom resources like stylesheets and scripts that can be included in the dashboard. To register these resources, you need to define them in your service provider by overriding the appropriate methods.

### Stylesheets

To define the stylesheets to be registered, override the `stylesheets` method in your service provider. This method should return an array of strings, where each string represents the path to a stylesheet that you want to include.

```php
/**
 * Define the stylesheets to be registered.
 *
 * @return string[]
 */
protected function stylesheets(): array
{
    return [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', // CDN Path
        '/absolute/path/to/your/styles.css', // Absolute Path
        Vite::asset('resources/css/app.css'), // Vite Asset
    ];
}
```

### Scripts

To define the scripts to be registered, override the `scripts` method in your service provider. This method should return an array of strings, where each string represents the path to a JavaScript file that you want to include.

```php
/**
 * Define the scripts to be registered.
 *
 * @return string[]
 */
protected function scripts(): array
{
    return [
        'https://cdn.jsdelivr.net/npm/vue@3.2.26/dist/vue.global.js', // CDN Path
        '/absolute/path/to/your/script.js', // Absolute Path
        Vite::asset('resources/js/app.js'), // Vite Asset
    ];
}
```



## Define Icons

To utilize icons from different icon sets in your package, you can specify the icon paths and prefixes within the `icons` method of your service provider.

```php
/**
 * Get the icon paths and prefixes.
 *
 * @return array
 */
public function icons(): array
{
    // Define your icon sets here
    return ['fa' => '/path/to/fontawesome'];
}
```

In this example, you can define the paths and prefixes for different icon sets. Once registered, you can use the icons within your package's views or components.



## Versioning

When developing a package that supports multiple versions, it is advised to utilize Composer for version management.
Composer provides comprehensive tools for resolving version conflicts. If, for any reason, Composer is not suitable for your project, you can consider using the following constant:

```php
Orchid\Platform\Dashboard::version()
```

This constant returns a string representation of the current version being used.


## Extending Layouts

The `Layouts` class is grouping several ones; to add a new feature to it, it is enough to specify it in the service provider as:

```php
use Orchid\Screen\Layout;
use Orchid\Screen\LayoutFactory;
use Orchid\Screen\Repository;

LayoutFactory::macro('hello', function (string $name) {
    return new class($name) extends Layout
    {
        /**
         * @ string
         */
        public $name;

        /**
         * Hello constructor.
         *
         * @param string $name
         */
        public function __construct(string $name)
        {
            $this->name = $name;
        }

        /**
         * @param Repository $repository
         *
         * @return mixed
         */
        protected function build(Repository $repository)
        {
            return view('hello')->with('name', $this->name);
        }

    };
});
```

Then on the screen, the call will look like:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::hello('Alexandr Chernyaev')
    ];
}
```

