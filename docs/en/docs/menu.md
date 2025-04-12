---
title: Navigation
description: Learn how to use Laravel Orchid to create powerful and dynamic navigation menus for your application. From customizing the main menu to creating multi-level dropdown menus, our documentation covers all the features and functions you need to effectively navigate your application.
---

The platform panel menu is an important element of the graphical user interface because it is the main navigation through the project.

## Usage

The default menu registration takes place in the `app/Orchid/PlatformProvider.php`:

```php
namespace App\Orchid;

use Orchid\Screen\Actions\Menu;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    // ...
    
    public function menu(): array
    {
        return [
            Menu::make('Example')->url('https://orchid.software/'),
        ];
    }
}
```

> **Note:** When creating each element, a unique key is automatically generated, which should not be repeated. However, you can manually change the key using the `slug` method.

## Links

Create links with the `Menu` class using a URL or route. To create a link with a URL, use the `url` method:

```php
use Orchid\Screen\Actions\Menu;

Menu::make('Example')->url('https://orchid.software/');
```

To create a link with a route, use the `route` method and provide the name of the route:

```php
Menu::make('Example')->route('route.idea');
```

Make sure the route is defined in your app's routes file.

## Active State

To determine the link activity, already use the [dwightwatson/active](https://github.com/dwightwatson/active) package,
when using `route` and `url` is set automatically, but it is acceptable to change with the help of explicit instructions:

```php
Menu::make('Example')
    ->route('route.idea')
    ->active('route.idea*');
    
Menu::make('Example')
    ->route('route.idea')
    ->active([
        'route.idea',
        'route.other'
    ]);
    
Menu::make('Example')
    ->url('/pages/contact')
    ->active('not:pages/contact');
```

## Permission-Based

Quite an expected situation when some links should be missing
depending on the [availability of rights](/en/docs/access) or other circumstances, for this:

```php
Menu::make('Example')->permission('platform.idea');
```

or any other check returning a boolean value:

```php
Menu::make('Example')->canSee(true);
```

## Appearance

For a menu item, you can specify a graphic icon with:

```php
Menu::make('Example')->icon('bs.heart');
```

It is also possible to integrate into a visual group by setting the title for the first element:

```php
Menu::make('Example')->title('Analytics');
```

## Badge Notification

Menu items have the ability to notify the user about any events in the form of a numerical value, for this:

```php
Menu::make('Comments')
    ->icon('bubbles')
    ->route('platform.comments')
    ->badge(fn () => 10);
```

## Sorting Items

Sorting set by setting the sequence number:

```php
Menu::make('Second')->sort(5);
Menu::make('First')->sort(4);
```

## Creating Nested Menus

You can specify a single-level submenu as follows:

```php
Menu::make('Multi Level')
    ->icon('code')
    ->list([
        Menu::make('Second Level Item 1')->icon('bs.bag')->sort(2),
        Menu::make('Second Level Item 2')->icon('bs.heart')->sort(0),
    ]),
```

To create a submenu dynamic, you need to add the main item and specify its unique name using the `slug` method. Then you can add other elements to the new item.

```php
Menu::make('Multi Level')
    ->slug('sub-menu')
    ->icon('code')
    ->list([
        Menu::make('Second Level Item 1')->icon('bs.bag'),
        Menu::make('Second Level Item 2')->icon('bs.heart'),
    ]),
```

And then add new items in our own packages like:

```php
use Orchid\Support\Facades\Dashboard;

Dashboard::addMenuSubElements('sub-menu', [
    Menu::make('Second Level Item 2')->icon('badge')
]);
```

> **Note:** The graphical interface supports menu nesting up to the second level. For more details on creating effective and intuitive navigation, explore our [design guidelines](https://orchid.software/en/hig/navigation).
