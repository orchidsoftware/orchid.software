---
title: Navigation
description: An important element of the graphical user interface, because with the help of it is based on the navigation project.
---

The platform panel menu is an important element of the graphical user interface because it is the main navigation through the project.

## Usage example

The default menu registration takes place in the `app/Orchid/PlatformProvider.php`:

```php
namespace App\Orchid;

use Orchid\Screen\Actions\Menu;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    // ...
    
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Example')->url('https://orchid.software/'),
        ];
    }
}
```

The methods `registerMainMenu` and `registerProfileMenu` must return the menu items that are required to be displayed.

## Location

Let's look at an example. Initially we create an `Menu` object, setting various parameters, and then add the item to a specific place.
There are several such places:

- **registerMainMenu** - The menu is displayed on each page on the left side.
- **registerProfileMenu** - The menu displayed when you click on the profile.


> **Note.** for each element during creation, the unique key which cannot repeat is generated, but it can be changed manually by means of the `slug` method.

## Links

Reference Reference:

```php
use Orchid\Screen\Actions\Menu;

Menu::make('Example')->url('https://orchid.software/');
```
 
Specifying a link through the route:
```php
Menu::make('Example')->route('route.idea');
```

## Active

To determine the link activity, use the [dwightwatson/active](https://github.com/dwightwatson/active) package
Link activity, when using `route` and `url` is set automatically,
but it is acceptable to change with the help of explicit instructions:

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

## Permission

Quite an expected situation when some links should be missing
depending on the availability of rights or other circumstances, for this:

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
Menu::make('Example')->icon('heart');
```

It is also possible to integrate into a visual group by setting the title for the first element:

```php
Menu::make('Example')->title('Analytics');
```

## Display order

Sorting set by setting the sequence number:
```php
Menu::make('Second')->sort(5);
Menu::make('First')->sort(4);
```

## Badge notifications

Menu items have the ability to notify the user about any events in the form of a numerical value, for this:

```php
Menu::make('Comments')
    ->icon('bubbles')
    ->route('platform.comments')
    ->badge(function () {
        return 10;
    });
```

## Nested menu

You can specify a single-level submenu as follows:

```php
Menu::make('Dropdown menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag')->sort(2),
        Menu::make('Sub element item 2')->icon('heart')->sort(0),
    ]),
```

To create a submenu dynamic, you need to add the main item and specify its unique name using the `slug` method. Then you can add other elements to the new item.

```php
Menu::make('Dropdown menu')
    ->slug('sub-menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag'),
        Menu::make('Sub element item 2')->icon('heart'),
    ]),
```

And then add new items in our own packages like:

```php
use Orchid\Support\Facades\Dashboard;

Dashboard::addMenuSubElements(Dashboard::MENU_MAIN, 'sub-menu', [
    Menu::make('Sub element item 3')->icon('badge')
]);
```

