---
title: Platform Menu
description: An important element of the graphical user interface, because with the help of it is based on the navigation project.
extends: _layouts.documentation.en
section: main
---

The platform panel menu is an important element of the graphical user interface, because it is the main navigation through the project.


In order to add a new item to the menu, you need to inform our application `Dashboard`.
To do this, call the method in the menu properties and pass arguments:

* The name of the menu to which you want to attach the item
* A menu object containing the name, links, etc.

## Example

Registration of the default menu takes place in the `app/Orchid/Composers` directory, but can be specified directly in` ServiceProvider`.
For example, change `app/Providers/AppServiceProvider.php` to look like this:
	
```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        $dashboard->menu->add(Menu::MAIN,
            ItemMenu::label('Idea')
                ->icon('icon-bubbles')
                ->url('https://orchid.software')
        );
    }
}
```

## Location

Let us analyze the example, initially we create the `ItemMenu` object, setting various parameters, then we add an element to a specific place `Menu::MAIN`. There are several such places:

- **Menu::MAIN** - The menu displayed on each page on the left side.
- **Menu::SYSTEMS** - The menu that forms the navigation on the system page.
- **Menu::PROFILE** - The menu displayed when you click on the profile.
- **Name of your own menus** - Makes submenus and attaches items.

## Options


Basic use:

```php
use Orchid\Platform\ItemMenu;

ItemMenu::label('Example');
```

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
Link activity, when using `route` and` url` is set automatically,
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
ItemMenu::label('Example')->icon('icon-heart');
```

It is also possible to integrate into a visual group by setting the title for the first element:

```php
ItemMenu::label('Example')->title('Analytics');
```

### Display order

Sorting is set by setting the sequence number:
 ```php
ItemMenu::label('Second')->sort(5);
ItemMenu::label('First')->sort(4);
```

### Notifications

Menu items have the ability to notify the user about any events in the form of a numerical value, for this:

```php
ItemMenu::label('Comments')
    ->icon('icon-bubbles')
    ->route('platform.systems.comments')
    ->badge(function () {
        return 10;
    });
```

## Nested menu

To be able to create a submenu, you need to add the main item and specify its unique name using the `slug` method, then you can add other elements to the new item.

```php
$dashboard->menu
    ->add(Menu::MAIN,
        ItemMenu::label('My menu')
            ->slug('Idea')
    )
    ->add('Idea',
        ItemMenu::label('Sub element')
    );
```


