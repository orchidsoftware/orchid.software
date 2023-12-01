---
title: Table
description: Learn how to use the Laravel Orchid Table to display and organize data in your application. Discover various customization options and integrations with other Orchid features.
---


With the table layout, you can easily display large amounts of data in a structured and organized manner. Simply specify the fields you want to include in the table, and the table layout will take care of the rest, including sorting, filtering, and pagination. You can also customize the appearance of the table by setting various options, such as the table headings, row value, and more. Whether you are displaying a list of users, products, orders, or any other data, the table layout is a powerful and flexible tool for presenting your data in a clear and concise way.


To create a new table layout, you can use the following Artisan command:

```php
php artisan orchid:table PatientListLayout
```


Example:
```php
namespace App\Orchid\Layouts;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class PatientListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'patients';

    /**
     * @return TD[]
     */
    protected function columns() : array
    {
        return [
            TD::make('name'),
            TD::make('created_at')->sort(),
        ];
    }
}
```

Tables also support writing through short syntax without creating a class:

```php
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

Layout::table('clients', [
    TD::make('name'),
    TD::make('created_at')->sort(),
]);
```

![This image shows an illustrative table, which is a common way to display data in a structured and organized format.](/img/layouts/table.png)


## Introduction to Cells

A table is only a general wrapper for which you need to specify `TD` classes. Designed to create a single cell.

```php
use Orchid\Screen\TD;

TD::make('last_name');
```

The `make` method is the main method, sets the key name from the array and the display name.

```php
TD::make('last_name', 'Last name');
```


## Alignment

Content alignment control can be controlled using the `align` method:

```php
TD::make('last_name')->align(TD::ALIGN_LEFT);
TD::make('last_name')->align(TD::ALIGN_CENTER);
TD::make('last_name')->align(TD::ALIGN_RIGHT);
```

## Sorting

Sorting the selection should be done in the `query` screen,
for models, you can use automatic `http` [sorting and
filtering](/en/docs/filters/#automatic-http-filtering-and-sorting)

To enable active sorting by this column
you must specify the `sort` method:

```php
TD::make('last_name')->sort();
```

## Filtration

When building simple tables, the use of separate filters may seem overkill.
Therefore, you can display the field for filtering right above the column heading.

It will only define the visible part. You can specify the filtering logic yourself or rely on "Automatic HTTP Filtering".
You can find out more on the ["Eloquent Filters" page](/en/docs/filters/#automatic-http-filtering-and-sorting).

To add a field, call the filter method and pass the instance of the class you would like to display:

```php
TD::make('SKU')->filter(Input::make()->mask('A-999999'));
```

> **Note**: There is no need to specify the field name. It will be delivered and overwritten automatically by the column name.

Filtering multiple values can be done with a Select, and with an optional second argument of filter. By default it lets filter for any/all of the given values.

```php
TD::make('color')->filter(TD::FILTER_SELECT, ['red'=>'Red', 'green'=>'Green']);
```

When working with filters, it is possible to use the `filterValue()` method, which allows you to modify the displayed filter values.
For example, you can replace an ID value with a display name. Here is an example of using the `filterValue()` method:

```php
TD::make('id')->filterValue(function ($value) {
    $user = User::find($value);
    return $user->name;
})
```

The `$value` value passed to the function will contain the filter value that was applied.


## Width

You can control the width of the cell using the `width` method:

```php
TD::make('last_name')->width('100px');
```

## Show/Hide

By default, the user can hide any column for himself, but you can
prohibit doing this by specifying:

```php
TD::make('last_name')->cantHide();
```

And also hide by default, but can be shown at the request of the user.

```php
TD::make('last_name')->defaultHidden();
```


## Data Output

In some cases, you may need to display combined data, the `render` method is for this purpose intended. It implements the ability to generate cells according to the function:
 
```php
TD::make('full_name')
    ->render(fn($user) => e($user->first_name . ' ' . $user->last_name)),
```

> **Note.** The returned string will not be escaped! You need to take care of this yourself with the `e()` helper or use `Blade` view.


The loopback function must return any string value:

```php
TD::make('full_name')
    ->render(fn($user) => view('blade_template', [
        'user' => $user,
    ])),
```

Please note that you can use fields and actions:

```php
use Orchid\Screen\Actions\Link;

TD::make()
    ->render(fn ($user) => Link::make($user->last_name)->route('platform.user.edit', $user)),
```

Sometimes you want to show more elements in a single column, for example more buttons. For this you can use a `Group`:

```php
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;

TD::make()
    ->render(fn($user) => Group::make([
        Link::make('Show')->route('platform.user.show', $user),
        Link::make('Edit')->route('platform.user.edit', $user),
    ])),
```

For example, display a checkbox for each line for a bulk action:

```php
TD::make()
    ->render(fn(User $user) => CheckBox::make('users[]')
        ->value($user->id)
        ->placeholder($user->name)
        ->checked(false)
    ),
```

Sometimes it may be necessary to get the value from the `query` screen, rather than relying only on the `target`. You can get the value as follows:

```php
use Orchid\Screen\Actions\Link;

TD::make('price')
    ->render(fn ($product) => $product->price + $this->query->get('tax')),
```

## Working with the Loop Variable


The `$loop` variable will be available in the second argument of the `render` closure function. This variable provides access to some useful bits of information such as the current loop index and whether this is the first or last iteration through the loop:

```php
TD::make()->render(fn (Model $model, object $loop) => $loop->index),
```

The $loop variable contains a variety of other useful properties which you can find in the [Laravel documentation](https://laravel.com/docs/9.x/blade#loops).

## Using Components

Complex or dynamic data can be tedious to specify in the render method or seem overwhelming. Therefore, cells support rendering using [Laravel components](https://laravel.com/docs/blade#components). It allows you to take out the display logic, as well as reuse.

For example, there is an `Order` model, and depending on the status, we can show different descriptions in our components.
It is much nicer than specifying things directly in the view or creating particular areas for such processing.

```php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Order;

class OrderShortInformation extends Component
{
    /**
     * @var Order
     */
    public $order;

    /**
     * Create the component instance.
     *
     * @param  Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function status()
    {
        $descriptions = [
            1 => __('In the process'),
            2 => __('Paid'),
            3 => __('Cancellation'),
            4 => __('Refund'),
        ];

        if (array_key_exists($this->order->status, $descriptions)) {
            return $descriptions[$this->order->status];
        }

        return 'Unknown';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order.short-information');
    }
}
```

To use a component in a cell, you must pass it:

```php
use App\View\CompochangingOrderShortInformation;

TD::make('status')->component(OrderShortInformation::class);
```

The component will receive the entire row as its first argument, not just the cell data.

Therefore, if you are using a deep injection in your component, it is essential to specify the variable's name.

```php
public function __construct(Application $application, Order $order, int $limit = 300)
{
    $this->order = $order;
    // ...
}
```

Other additional arguments, for example, limit. You can specify in the following way:

```php
TD::make('status')->component(OrderShortInformation::class, [
    'limit' => 100
]);
```

## Customizing Component Values

This is very similar to using the component above, only the previous example gets an object. But this is not always necessary, sometimes only one value needs to be processed.

To do this, you need to add a new method that would receive only the cell value without additional information by default. For example, I want to display values of a specific format:

```php
namespace App\View\Components;

use Illuminate\View\Component;

class Numeric extends Component
{
    /**
     * @var float
     */
    public float $value;

    /**
     * Create a new component instance.
     *
     * @param  float        $value
     * @param  int          $decimals
     * @param  string|null  $decimal_separator
     * @param  string|null  $thousands_separator
     */
    public function __construct(
        float   $value,
        int     $decimals = 0,
        ?string $decimal_separator = ".",
        ?string $thousands_separator = ","
    ) {
        $this->value = number_format($value, $decimals, $decimal_separator, $thousands_separator);
    }

    /**
     * Get the view/contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
    {{ $value }}
blade;
    }
}
```

Then the table call might look like this:

```php
TD::make('price')->asComponent(Numeric::class);
// 1,235
```

Also with additional parameters:


```php
TD::make('price')->asComponent(Numeric::class, [
    'decimals' => 2,
    'decimal_separator' => ',',
    'thousands_separator' => ' ',
]);
// 1 234,56
```

## Table Options

You can specify the text to be displayed if the table is empty
specifying methods:

```php
/**
 * @return string
 */
protected function iconNotFound(): string
{
    return 'table';
}

/**
 * @return string
 */
protected function textNotFound(): string
{
    return __('There are no records in this view');
}

/**
 * @return string
 */
protected function subNotFound(): string
{
    return '';
}
```

If the table rows do not seem contrasting to you, then you can enable
`striped` mode:

```php
/**
 * @return bool
 */
protected function striped(): bool
{
    return true;
}
```

You can dynamically change the amount of links to display in the table pagination with the following method:

```php
/**
 * The number of links to display on each side of current page link.
 *
 * @return int
 */
protected function onEachSide(): int
{
    return 3;
}
```

## Adding a Total Row

Adds a summary row at the bottom of the table, for this you need to define the `total` method and describe the required cells. For example:

```php
public function total():array
{
    return [
        TD::make('total')
            ->align(TD::ALIGN_RIGHT)
            ->colspan(2)
            ->render(fn () => 'Total:'),

        TD::make('total_count')
            ->align(TD::ALIGN_RIGHT),

        TD::make('total_active_count')
            ->align(TD::ALIGN_RIGHT),
    ];
}
```

This line will ignore the specified `target` based on the result of the `query` screen:

```php
public function query(): array
{
    return [
        'total_active_count' => '$93 960',
        'total_count' => '$103 783',
        // ...
    ];
}
```


## Column Expansion

When working with the same type of data, it is often required to process it in the same way, in order not to duplicate the code in the layers, it is possible to extend the `TD` class using its own methods. To do this, it is necessary to register the closure function in the service provider.

Registration example:

```php
// AppServiceProvider.php
TD::macro('bool', function () {

    $column = $this->column;

    $this->render(function ($datum) use ($column) {
        return view('bool',[
            'bool' => $datum->$column
        ]);
    });

    return $this;
});
```

Template example:

```php
// bool.blade.php

<span class="{{ $bool ? 'text-success' : 'text-danger' }}">●</span>
```

Usage example:
```php
public function grid(): array
{
    return [
        TD::make('status')->bool(),
    ];
}
```
