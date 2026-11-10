---
title: Layout objects
description: Compose screens with concrete layouts and fluent configuration.
---

Layouts compose the data returned by `query()` into a screen. Build them as ordinary objects, then configure them
through methods. You do not need a subclass to declare fields, columns, or nested layouts.

## Compose a screen

```php
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

public function layout(): iterable
{
    return [
        Columns::make([
            Rows::make([
                Input::make('user.name')->title('Name'),
            ])->title('Profile'),

            Table::make('users', [
                TD::make('name'),
                TD::make('email'),
            ])->compact(),
        ]),
    ];
}
```

The example expects `user` and `users` in the screen repository. Fields, table render callbacks, pagination, and
permission checks keep their existing behavior.

## Direct construction and the facade

The Layout facade is a short alias for the same object factories:

```php
Rows::make([Input::make('name')]);
Layout::rows([Input::make('name')]);

Table::make('users', [TD::make('name')]);
Layout::table('users', [TD::make('name')]);
```

Import `Orchid\Support\Facades\Layout` to use the aliases. There is one rendering implementation for both forms.
Table and Sortable take a required data key as their first argument. Legend can read the root repository without a target.

## Available objects

All classes below live in `Orchid\Screen\Layouts`:

| Object | Construction |
| --- | --- |
| Rows | `Rows::make($fields)` |
| Table | `Table::make('users', $columns)` |
| Legend | `Legend::make($sights)->target('user')` |
| Sortable | `Sortable::make('items', $sights)` |
| Selection | `Selection::make($filters)->inline()` |
| TabMenu | `TabMenu::make($menus)` |
| SideMenu | `SideMenu::make($menus)->label('Settings')` |
| Columns, Split | `Columns::make($layouts)`, `Split::make($layouts)` |
| Tabs, Accordion | `Tabs::make($namedLayouts)`, `Accordion::make($namedLayouts)` |
| Block, Blank | `Block::make($layouts)`, `Blank::make($layouts)` |
| Modal | `Modal::make('edit', $layouts)` |
| Wrapper | `Wrapper::make('custom-view', $namedLayouts)` |
| View | `View::make('custom-view', $data)` |
| Component | `Component::make(Hello::class)` |
| Metric | `Metric::make(['Users' => 'users'])` |
| Browsing | `Browsing::make($url)` |
| Chart | `Chart::make('visits', 'Visits')` |
| Card, Persona, Facepile | `Card::make($card)`, `Persona::make($person)`, `Facepile::make($people)` |

## Reuse only where needed

Keep local definitions in the screen. For shared definitions, an ordinary factory may return a configured object.
Return that object from `layout()`; a factory class name alone is not a Layout.
Named layout subclasses remain available for reusable menus and specialized behavior. `make()` preserves their class.

Listener remains a behavior class: its `handle()` method processes an asynchronous request, and its route reconstructs
that named handler. Its contract has not been replaced with serialized callbacks.

The generators `orchid:rows` and `orchid:table` are removed. Generators for Chart, Selection, TabMenu, SideMenu,
and Listener remain available when an application needs a named class. No generator is required for direct construction.
