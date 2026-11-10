---
title: Side menu
description: Add contextual navigation to a group of related screens.
---

SideMenu displays vertical navigation inside a screen. Use it for links shared by related screens, such as settings.
The main application menu remains in the service provider.

For a menu used once, create it directly. Keep a named class when several screens share its navigation:

```php
use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Layouts\SideMenu;

SideMenu::make([
    Menu::make('Profile')->route('orchid.profile'),
])->label('Account navigation');
```

## Create a side menu

Generate a layout and define its links and accessible navigation label:

```shell
php artisan orchid:side-menu SettingsMenu
```

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Layouts\SideMenu;

class SettingsMenu extends SideMenu
{
    protected string $label = 'Settings';

    protected function navigations(): iterable
    {
        return [
            Menu::make('Profile')->route('orchid.profile'),
            Menu::make('Users')->route('orchid.users')->permission('orchid.users'),
            Menu::make('Roles')->route('orchid.roles')->permission('orchid.roles'),
        ];
    }
}
```

## Add it to a screen

Return the layout class from `layout()`. For example, place it next to the screen's fields:

```php
use App\Orchid\Layouts\SettingsMenu;
use Orchid\Support\Facades\Layout;

public function layout(): iterable
{
    return [
        Layout::columns([
            SettingsMenu::class,
            Layout::rows([
                // Fields for this screen...
            ]),
        ]),
    ];
}
```

Menu items support the same `route()`, `list()`, `permission()`, and `canSee()` methods as the main menu.
Hidden entries are removed; the layout does not render when no entries remain.
The menu collapses on smaller screens. A leaf link such as `/settings/profile` also matches
`/settings/profile?tab=security`, but not descendant paths.
Parent entries cover their child links and descendant paths. Use `active()` to supply custom matching rules.

Hiding a menu item does not authorize its destination. Protect the target screen and its actions separately.
