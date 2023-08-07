# Package Development

This documentation page provides an overview of various aspects of package development for Orchid. It covers topics such as routes, navigation, permissions, layouts, and icons.

> **Note for beginners:** Please be aware that the Orchid documentation page primarily focuses on demonstrating the usage and features of the Orchid platform. It does not cover more fundamental topics like creating a Composer package, registering it on Packagist, or basic Laravel package development. If you are new to PHP and Laravel, it is recommended to consult other beginner-friendly resources that specifically address those topics before diving into the Orchid documentation. ↩

## Routes

To define routes in your package, you can use the standard Laravel routing mechanisms. Create a routes file in your package and register it in the `boot` method of your service provider.

## Navigation

// ...

## Permissions

Laravel Orchid provides a powerful permission system that allows you to control access to different parts of your package. To define permissions for your package, you can use the `ItemPermission` class.

```php
public function boot(Dashboard $dashboard)
{
    $permissions = ItemPermission::group('Package')
            ->addPermission('platform.package.permission', 'Description');

    $dashboard->registerPermissions($permissions);
}
```

In the `boot` method of your service provider, you can define permissions for your package. Specify the group name, permission key, and description. The `Dashboard` class is injected to register the permissions.


## Assets

### Register

```php
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class PackageServiceProvider extends ServiceProvider
{
    public function boot(Dashboard $dashboard)
    {
        $dashboard->registerResource('stylesheets', '/path/to/custom.css');
        $dashboard->registerResource('scripts', '/path/to/custom.js');
    }
}
```

It’s worth noting that the resource file must be present in the `public` directory to be able to access it.

### Publish

// ...

## Layouts

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

## Icons

To use icons from different icon sets in your package, you can utilize the `IconFinder` class provided by Orchid. Register the icon directory in your service provider's `boot` method.

```php
public function boot(IconFinder $iconFinder)
{
    $iconFinder->registerIconDirectory('fa', '/path/to/fontawesome');
}
```

In this example, the FontAwesome icon set is registered. You should specify an identifier and the path to the icon directory. Once registered, you can use the registered icons in your package's views or components.



## Model Classes

To override the default model with your own model in Orchid, you can use the `useModel` wrapper provided by the `Dashboard` class. This allows you to easily customize the behavior of model classes. Here's how you can use it:

```php
use Orchid\Platform\Models\User;
use Name\Package\UserPackage;

// Get the default Orchid\Platform\Models\User
$user = Dashboard::modelClass(User::class);

// Override the default model with Name\Package\UserPackage
Dashboard::useModel(User::class, UserPackage::class);

// Get the overridden Name\Package\UserPackage
$user = Dashboard::modelClass(User::class);
```

In the example above, you start by getting the default `User` model provided by Orchid using `Dashboard::modelClass(User::class)`. To override this model, you use `Dashboard::useModel()` and pass the original model class (`User`) as the first argument and your new model class (`UserPackage`) as the second argument.

Once you have overridden the model, subsequent calls to `Dashboard::modelClass(User::class)` will return the overridden `UserPackage` model instead of the default `User` model, allowing you to customize the behavior of model classes according to your specific requirements.


## Dashboard Macros

Macros allow you to add your own custom functions to existing classes efficiently. To add the `hello` macro to the `Dashboard` class, you can utilize the `macro` method provided by Laravel:

```php
Dashboard::macro('hello', fn () => 'Hello Word!');
```

The code above defines the `hello` macro by specifying the macro name ('hello') and the closure that will be executed when the macro is called. In this case, the closure simply returns the string `'Hello Word!'`.

Once the macro is defined, you can use it by invoking the `hello` method on the `Dashboard` class:

```php
$result = Dashboard::hello();
```

By calling `Dashboard::hello()`, the closure defined in the macro will be executed, and the string `'Hello Word!'` will be returned. The returned value can be assigned to a variable for further processing if needed.


## Versioning

When developing a package that supports multiple versions, it is advised to utilize Composer for version management. Composer provides comprehensive tools for resolving version conflicts. If, for any reason, Composer is not suitable for your project, you can consider using the following constant:

```php
Orchid\Platform\Dashboard::VERSION
```

This constant returns a string representation of the current version being used.
