---
title: Side menu
description: Add contextual navigation to a group of related screens.
---

SideMenu displays vertical navigation inside a screen. Use it for links shared by related screens, such as settings.
Configure the main application menu in the service provider.

## Add a side menu

Place the menu beside the screen's content using Columns:

```php
use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\SideMenu;

public function query(): array
{
    return [
        'user' => auth()->user(),
    ];
}

public function layout(): iterable
{
    return [
        Columns::make([
            SideMenu::make([
                Menu::make('Profile')->route('orchid.profile'),
                Menu::make('Users')->route('orchid.users')->permission('orchid.users'),
            ])->label('Account navigation'),
            Rows::make([
                Input::make('user.name')->title('Name'),
            ]),
        ]),
    ];
}
```

The example reads the name from the `user` value returned by `query()`.
The `label()` method sets the menu's accessible navigation label.

Menu items support `route()`, `list()`, `permission()`, and `canSee()`, as in the main menu.
Hidden entries are excluded, and the layout does not render when no entries are visible.
The menu collapses on smaller screens.

A leaf link such as `/settings/profile` also matches `/settings/profile?tab=security`, but not descendant paths.
Parent entries cover their child links and descendant paths. Use `active()` to supply custom matching rules.

Hiding a menu item does not authorize its destination. Protect the target screen and its actions separately.

## Share navigation between screens

Define a named layout when several screens use the same navigation:

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

Return the class from each screen's `layout()` method:

```php
use App\Orchid\Layouts\SettingsMenu;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;

public function layout(): iterable
{
    return [
        Columns::make([
            SettingsMenu::class,
            Rows::make([
                Input::make('user.name')->title('Name'),
            ]),
        ]),
    ];
}
```
