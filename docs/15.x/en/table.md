---
title: Table
description: Display records with configurable columns, pagination, totals, and empty states.
---

A Table displays records returned by a screen's `query()` method. Pass the data key and columns to `make()`,
then return the table from `layout()`:

```php
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;

public function query(): array
{
    return [
        'patients' => Repository::elements([
            ['name' => 'Alex', 'created_at' => '2026-01-01'],
        ]),
    ];
}

public function layout(): iterable
{
    return [
        Table::make('patients', [
            TD::make('name'),
            TD::make('created_at'),
        ])->title('Patients'),
    ];
}
```

The first argument selects the data returned by `query()`. The second argument defines the columns.
The data key must be nonempty.

The source can be an array, collection, paginator, or cursor paginator. For default cell rendering,
each record must be a model using `Orchid\Screen\AsSource` or a `Repository`.
`Repository::elements()` wraps each array in a Repository, as shown above.

## Introduction to Cells

Each `TD` object defines one column. Its name selects a value from each record:

```php
use Orchid\Screen\TD;

TD::make('last_name');
```

The optional second argument sets the column heading:

```php
TD::make('last_name', 'Last name');
```

> Column headers are rendered with their raw HTML content. This gives you the flexibility to include rich formatting or
> special characters directly in the header. Just remember to ensure that any dynamic content is safe and sanitized to
> maintain a secure and polished interface.

## Alignment

Set cell alignment with `align()`:

```php
TD::make('last_name')->align(TD::ALIGN_LEFT);
TD::make('last_name')->align(TD::ALIGN_CENTER);
TD::make('last_name')->align(TD::ALIGN_RIGHT);
```

## Sorting

Apply sorting to the database query in the screen's `query()` method. For Eloquent models, configure
[automatic HTTP sorting and filtering](/en/docs/filters/#automatic-http-filtering-and-sorting).

Call `sort()` to make the column heading a sorting control:

```php
TD::make('last_name')->sort();
```

## Filtration

When building simple tables, the use of separate filters may seem overkill. Therefore, you can display the field for
filtering right above the column heading.

It will only define the visible part. You can specify the filtering logic yourself or rely on "Automatic HTTP
Filtering." You can find out more on the
["Eloquent Filters" page](/en/docs/filters/#automatic-http-filtering-and-sorting).

To add a field, call the filter method and pass the instance of the class you would like to display:

```php
TD::make('SKU')->filter(Input::make()->mask('A-999999'));

TD::make('color')->filter(
    Select::make()
        ->options(['red' => 'Red', 'green' => 'Green'])
        ->empty()
);
```

> **Note:** there is no need to specify the field name. It will be delivered and overwritten automatically by the column
> name.

When working with filters, it is possible to use the `filterValue()` method, which allows you to modify the displayed
filter values. For example, you can replace an ID value with a display name. Here is an example of using the
`filterValue()` method:

```php
TD::make('id')->filterValue(function ($value) {
    return User::find($value)?->name ?? $value;
});
```

The `$value` value passed to the function will contain the filter value that was applied.

## Width

You can control the width of the cell using the `width` method:

```php
TD::make('last_name')->width('100px');
```

## Show/Hide

Users can hide columns by default. Use `cantHide()` to keep a column visible:

```php
TD::make('last_name')->cantHide();
```

Use `defaultHidden()` to hide a column initially while allowing users to show it:

```php
TD::make('last_name')->defaultHidden();
```

> **Note**: To hide the button and modal for selecting visible columns from the table footer, you need to call
> `cantHide()` on every column.

## Data Output

Use `render()` to calculate a cell value from the current record:

```php
TD::make('full_name')
    ->render(fn ($user) => e($user->first_name.' '.$user->last_name)),
```

> **Note.** The returned string will not be escaped. You need to take care of this yourself with the `e()` helper or use
> a `Blade` view.

The callback can also return a Blade view:

```php
TD::make('full_name')
    ->render(fn ($user) => view('blade_template', [
        'user' => $user,
    ])),
```

You can also return fields and actions:

```php
use Orchid\Screen\Actions\Link;

TD::make('name')
    ->render(fn ($user) => Link::make($user->name)->route('orchid.users.edit', $user)),
```

Sometimes you want to show more elements in a single column, for example more buttons. For this you can use a `Group`:

```php
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;

TD::make()
    ->render(fn ($user) => Group::make([
        Link::make('Edit')->route('orchid.users.edit', $user),
        Link::make('Email')->href('mailto:'.$user->email),
    ])),
```

For example, display a checkbox for each line for a bulk action:

```php
TD::make()
    ->render(fn (User $user) => CheckBox::make('users[]')
        ->value($user->id)
        ->placeholder($user->name)
        ->checked(false)
    ),
```

When a cell needs data outside the table's dataset, declare a public property on the Screen and return its value from
`query()`. Orchid fills that property before `layout()` runs. The callback keeps the Screen as `$this`:

```php
namespace App\Orchid\Screens;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;

class ProductListScreen extends Screen
{
    public int $tax = 0;

    public function query(): array
    {
        return [
            'products' => [(object) ['price' => 100]],
            'tax'      => 20,
        ];
    }

    public function layout(): iterable
    {
        return [
            Table::make('products', [
                TD::make('price')->render(fn (object $product) => $product->price + $this->tax),
            ]),
        ];
    }
}
```

## Working with the Loop Variable

The `$loop` variable will be available in the second argument of the `render` closure function. This variable provides
access to some useful bits of information such as the current loop index and whether this is the first or last iteration
through the loop:

```php
TD::make()->render(fn (Model $model, object $loop) => $loop->index),
```

The `$loop` variable contains a variety of other useful properties which you can find in the
[Laravel documentation](https://laravel.com/docs/12.x/blade#loops).

## Using Components

Use a [Blade component](https://laravel.com/docs/blade#components) when several columns or screens share rendering
logic.
For example, this component displays an order's status:

```php
namespace App\View\Components;

use App\Models\Order;
use Illuminate\View\Component;

class OrderShortInformation extends Component
{
    public function __construct(public readonly Order $order) {}

    public function render(): string
    {
        return '<span>{{ $order->status }}</span>';
    }
}
```

This example expects an Order model with a `status` attribute. Pass the component class to the column:

```php
use App\View\Components\OrderShortInformation;

TD::make('status')->component(OrderShortInformation::class);
```

`component()` passes the entire row to the component's `$order` parameter. Blade escapes the status value.
Use named arguments for additional constructor parameters, as shown in [Customizing component
arguments](#customizing-component-arguments).

## Passing Cell Values to Components

The `component` method passes the entire row to the component. When a component only needs the value of the current
cell, use `asComponent()` instead.

For example, you might want to display a value in a specific format:

```php
namespace App\View\Components;

use Illuminate\View\Component;

class Numeric extends Component
{
    public string $value;

    public function __construct(
        float $value,
        int $decimals = 0,
        string $decimal_separator = '.',
        string $thousands_separator = ',',
    ) {
        $this->value = number_format($value, $decimals, $decimal_separator, $thousands_separator);
    }

    public function render(): string
    {
        return '{{ $value }}';
    }
}
```

For a price of `1234.56`, the following column displays `1,235`:

```php
TD::make('price')->asComponent(Numeric::class);
// 1,235
```

Pass formatting parameters as an array:

```php
TD::make('price')->asComponent(Numeric::class, [
    'decimals'            => 2,
    'decimal_separator'   => ',',
    'thousands_separator' => ' ',
]);
// 1 234,56
```

For built-in cell formatters, see [Cell Types](/en/docs/cell-types). It covers date, number, boolean, currency, and
percentage formats.

## Customizing Component Arguments

Arguments passed to `component` may be closures. Orchid evaluates each closure with the current row before rendering the
component. This lets you calculate a component argument from one or more model attributes without adding an accessor to
the model or creating another component.

For example, the value displayed by `DateTimeSplit` can be selected from several date attributes:

```php
use App\Models\Order;
use Orchid\Screen\Components\Cells\DateTimeSplit;

TD::make('last_activity', 'Last Updated')
    ->component(
        DateTimeSplit::class,
        value: fn (Order $order) => $order->shipped_at
            ?? $order->packed_at
            ?? $order->created_at,
    );
```

Use `component` rather than `asComponent()` when the closure needs the entire row. Closures passed to `asComponent()`
receive only the value of the selected cell.

## Table options

Configure presentation through fluent methods:

```php
Table::make('users', [
    TD::make('name'),
    TD::make('email'),
])
    ->striped()
    ->compact()
    ->bordered()
    ->hoverable()
    ->onEachSide(2);
```

These methods enable a presentation option and do not take boolean flags.
`onEachSide()` controls pagination links around the current page.

## Add totals

Use `totals()` for the footer cells. Their values come from the root query repository, rather than the table data key:

```php
Table::make('orders', [
    TD::make('name'),
    TD::make('price'),
])->totals([
    TD::make('label')->render(fn () => 'Total:'),
    TD::make('total_price'),
]);

// In query():
return [
    'orders'      => $orders,
    'total_price' => $orders->sum('price'),
];
```

## Empty states

The default empty state distinguishes an empty collection from a filtered query with no matches.
When filters are active, it offers an action that removes `filter`, `page`, and `cursor` parameters.
Override only the pieces your application needs:

```php
use Orchid\Screen\Actions\Link;

Table::make('orders', [TD::make('name')])
    ->emptyIcon('bs.inbox')
    ->emptyTitle('No orders')
    ->emptyDescription('New orders will appear here.')
    ->emptyAction(Link::make('Create order')->route('orchid.orders.create'));
```

The example expects a route named `orchid.orders.create`. Use `emptyAction(null)` to hide the empty-state action.
Without a custom action, the table offers the default clear-filters action when filters are active.
