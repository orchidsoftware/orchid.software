---
title: Rows
description: Arrange form fields in a vertical layout.
---

Rows groups [form fields](/en/docs/field) into a vertical form.

## Create rows

```php
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

public function query(): array
{
    return ['user' => auth()->user()];
}

public function layout(): iterable
{
    return [
        Rows::make([
            Input::make('user.name')->title('Name'),
            Input::make('user.email')->type('email')->title('Email'),
        ])->title('Profile'),
    ];
}
```

The Profile group displays the signed-in user's name and email. Field names such as `user.name` read values from
the `user` entry returned by `query()`. Use `title()` for the group's heading and `canSee($condition)` to control
visibility.
Visibility does not replace server-side authorization. To handle submissions, add a [screen
action](/en/docs/screens#screen-actions).

Read data-dependent configuration from the screen's public properties in `layout()`.
For forms that respond to field changes, see [Listeners](/en/docs/listener).

You can also create rows through the [Layout facade](/en/docs/layouts#using-the-layout-facade):
`Layout::rows($fields)`.

## Reuse a form

To share a form between screens, create a class with a method that returns a Rows instance:

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

```

Call the method from the screen's `layout()`:

```php
use App\Orchid\Layouts\AddressLayout;

public function layout(): iterable
{
    return [AddressLayout::make('customer.address')];
}
```
