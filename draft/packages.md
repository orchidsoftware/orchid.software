# Package Development

This documentation page provides an overview of various aspects of package development for Orchid. It covers topics such as routes, navigation, permissions, layouts, and icons.

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


## Versioning

When developing a package that supports multiple versions, it is advised to utilize Composer for version management. Composer provides comprehensive tools for resolving version conflicts. If, for any reason, Composer is not suitable for your project, you can consider using the following constant:

```php
Orchid\Platform\Dashboard::VERSION
```

This constant returns a string representation of the current version being used.
