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

// ...

## Icons

To use icons from different icon sets in your package, you can utilize the `IconFinder` class provided by Orchid. Register the icon directory in your service provider's `boot` method.

```php
public function boot(IconFinder $iconFinder)
{
    $iconFinder->registerIconDirectory('fa', '/path/to/fontawesome');
}
```

In this example, the FontAwesome icon set is registered. You should specify an identifier and the path to the icon directory. Once registered, you can use the registered icons in your package's views or components.
