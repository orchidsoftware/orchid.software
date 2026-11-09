---
title: Rows
description: Build forms with fields and fluent layout objects.
---

Rows groups [form fields](/en/docs/field) into a vertical form. Construct it directly or use the Layout facade.
Both forms create the same concrete Rows object; neither requires a subclass or an Artisan command.

## Create rows

```php
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

public function layout(): iterable
{
    return [
        Rows::make([
            Input::make('user.name')->title('Name'),
            Input::make('user.email')->type('email')->title('Email'),
        ])->title('Profile'),

        Layout::rows([
            Input::make('user.phone')->title('Phone'),
        ]),
    ];
}
```

Field names bind to the data returned by the screen's `query()` method. For example, `user.name` reads the `name`
attribute of the `user` model. Use `title()` for the group's heading and `canSee($condition)` to control visibility.
Visibility does not replace server-side authorization.

Read data-dependent configuration from the screen's public properties in `layout()`.
Keep asynchronous data changes in the Listener handler.

## Reuse a form

Extract a factory only when multiple screens need the same form. Return a configured Rows object from an ordinary class:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AddressLayout
{
    public static function make(string $prefix): Rows
    {
        return Rows::make([
            Input::make($prefix.'.city')->title('City'),
            Input::make($prefix.'.street')->title('Street'),
        ])->title('Address');
    }
}

// In the screen's layout():
return [AddressLayout::make('customer.address')];
```

Return the factory result, not `AddressLayout::class`: this class is a factory, not a Layout subclass.
Existing named Rows subclasses can still be used. New forms do not need to override `fields()` or `$title`.
The `orchid:rows` generator has been removed.
