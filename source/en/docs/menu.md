---
title: Platform Menu
description: An important element of the graphical user interface, because with the help of it is based on the navigation project.
extends: _layouts.documentation
section: main
---

The platform panel menu is an important element of the graphical user interface because it is the main navigation through the project.

## Usage example

The default menu registration takes place in the `app/Orchid/PlatformProvider.php`:

```php
namespace App\Orchid;

use Orchid\Platform\ItemMenu;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    // ...
    
    public function registerMainMenu(): array
    {
        return [
            ItemMenu::label('Example')->url('https://orchid.software/'),
        ];
    }
}
```

The methods `registerMainMenu`, `registerProfileMenu`, and `registerSystemMenu` must return the menu items that are required to be displayed.

## Location

Let's look at an example. Initially we create an `ItemMenu` object, setting various parameters, and then add the item to a specific place.
There are several such places:

- **registerMainMenu** - The menu is displayed on each page on the left side.
- **registerSystemMenu** - The menu that forms the navigation on the system page.
- **registerProfileMenu** - The menu displayed when you click on the profile.

## Options


Basic use:

```php
use Orchid\Platform\ItemMenu;

ItemMenu::label('Example');
```

> **Note.** for each element during creation, the unique key which cannot repeat is generated, but it can be changed manually by means of the `slug` method.

### Setting Links

Reference Reference:

 ```php
ItemMenu::label('Example')->url('https://orchid.software/');
```
 
Specifying a link through the route:
 ```php
ItemMenu::label('Example')->route('route.idea');
```


To determine the link activity, use the [dwightwatson/active](https://github.com/dwightwatson/active) package
Link activity, when using `route` and `url` is set automatically,
but it is acceptable to change with the help of explicit instructions:

```php
ItemMenu::label('Example')
    ->route('route.idea')
    ->active('route.idea*');
    
ItemMenu::label('Example')
    ->route('route.idea')
    ->active([
        'route.idea',
        'route.other'
    ]);
    
ItemMenu::label('Example')
    ->url('/pages/contact')
    ->active('not:pages/contact');
```

### Permission

Quite an expected situation when some links should be missing
depending on the availability of rights or other circumstances, for this:

 ```php
ItemMenu::label('Example')->permission('platform.idea');
```

or any other check returning a boolean value:

 ```php
ItemMenu::label('Example')->canSee(true);
```

#### Appearance

For a menu item, you can specify a graphic icon with:

```php
ItemMenu::label('Example')->icon('heart');
```

It is also possible to integrate into a visual group by setting the title for the first element:

```php
ItemMenu::label('Example')->title('Analytics');
```

### Display order

Sorting set by setting the sequence number:
 ```php
ItemMenu::label('Second')->sort(5);
ItemMenu::label('First')->sort(4);
```

### Badge notifications

Menu items have the ability to notify the user about any events in the form of a numerical value, for this:

```php
ItemMenu::label('Comments')
    ->icon('bubbles')
    ->route('platform.systems.comments')
    ->badge(function () {
        return 10;
    });
```

## Nested menu

To be able to create a submenu, you need to add the main item and specify its unique name using the `slug` method, then you can add other elements to the new item.

```php
ItemMenu::label('My menu')
    ->slug('Idea')
    ->childs();
    
ItemMenu::label('Sub element')
    ->place('Idea');
```

When the children have different display rules, so as not to list them all in the parent, you can use the `hiddenEmpty` method. He will hide it when the subitems are unavailable:

```php
ItemMenu::label('Dropdown menu')
    ->slug('parent-hidden-menu')
    ->childs()
    ->hideEmpty();

ItemMenu::label('Sub element item 1')
    ->place('parent-hidden-menu')
    ->canSee(false);
    
ItemMenu::label('Sub element item 2')
    ->place('parent-hidden-menu')
    ->canSee(false);
```

