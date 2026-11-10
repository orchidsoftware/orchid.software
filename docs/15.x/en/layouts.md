---
title: Layouts
description: Arrange forms, tables, and other content on a screen.
---

Layouts display the data returned by a screen's `query()` method. Return layouts from `layout()` and combine them
to arrange fields, records, charts, and other content.

## Compose a screen

This example displays the signed-in user's profile fields beside a paginated list of users:

```php
use Orchid\Platform\Models\User;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

public function query(): array
{
    return [
        'user'  => auth()->user(),
        'users' => User::paginate(),
    ];
}

public function layout(): iterable
{
    return [
        Columns::make([
            Rows::make([
                Input::make('user.name')->title('Name'),
                Input::make('user.email')->type('email')->title('Email'),
            ])->title('Profile'),

            Table::make('users', [
                TD::make('name'),
                TD::make('email'),
            ])->title('Users'),
        ]),
    ];
}
```

Rows displays the profile fields. Their names, such as `user.name`, select values from the `user` entry.
Table reads records from `users`, and Columns places the form and table side by side.

## Available layouts

Choose a layout for the content you want to display. All classes below are in `Orchid\Screen\Layouts`.

| Layout | Purpose | Construction |
| --- | --- | --- |
| [Rows](/en/docs/rows) | Form fields | `Rows::make($fields)` |
| [Table](/en/docs/table) | A list of records | `Table::make('users', $columns)` |
| [Legend](/en/docs/legend) | One record | `Legend::make($sights)->target('user')` |
| [Sortable](/en/docs/grouping#sortable) | Draggable records | `Sortable::make('items', $sights)` |
| Selection | A group of filters | `Selection::make($filters)->inline()` |
| TabMenu | Navigation tabs | `TabMenu::make($menus)` |
| [SideMenu](/en/docs/side-menu) | Vertical navigation | `SideMenu::make($menus)` |
| [Columns](/en/docs/grouping) | Equal-width columns | `Columns::make($layouts)` |
| [Split](/en/docs/grouping) | Two sections with adjustable widths | `Split::make($layouts)` |
| [Tabs](/en/docs/grouping) | Switchable groups of layouts | `Tabs::make($namedLayouts)` |
| [Accordion](/en/docs/grouping) | Expandable groups of layouts | `Accordion::make($namedLayouts)` |
| [Block](/en/docs/grouping) | Layouts with a heading, description, and actions | `Block::make($layouts)` |
| Blank | Layouts without an additional container | `Blank::make($layouts)` |
| [Modal](/en/docs/modals) | A dialog containing layouts | `Modal::make('edit', $layouts)` |
| [Wrapper](/en/docs/custom-template) | A Blade view containing layouts | `Wrapper::make('custom-view', $namedLayouts)` |
| [View](/en/docs/custom-template) | A Blade view with data | `View::make('custom-view', $data)` |
| Component | A Blade component | `Component::make(Hello::class)` |
| Metric | Labeled values | `Metric::make(['Users' => 'users'])` |
| Browsing | An embedded web page | `Browsing::make($url)` |
| [Chart](/en/docs/charts) | A chart | `Chart::make('visits')->title('Daily visits')` |
| [Card](/en/docs/display-elements) | A card from a Cardable object | `Card::make($card)` |
| [Persona](/en/docs/display-elements) | One person from a Personable object | `Persona::make($person)` |
| [Facepile](/en/docs/display-elements) | Avatars from a collection of Personable objects | `Facepile::make($people)` |

The Cardable and Personable contracts are in `Orchid\Screen\Contracts`.
See [Display elements](/en/docs/display-elements) for complete examples.

## Reuse layouts

When several screens use the same layout, extract a method or class that returns a configured layout object.
Return the resulting object from `layout()`. See [reusing forms](/en/docs/rows#reuse-a-form) for an example.

For forms that update when a field changes, see [Listeners](/en/docs/listener).
