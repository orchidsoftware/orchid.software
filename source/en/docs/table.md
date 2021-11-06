---
title: Table
extends: _layouts.documentation
section: main
lang: en
---

The table layout is used to display minimal information for viewing and selection.

![Table](/assets/img/layouts/table.png)


To create, run the command:
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

## Cells

A table is only a general wrapper for which you need to specify TD classes. Designed to create a single cell.

```php
use Orchid\Screen\TD;

TD::make('last_name');
```

The `set` method is the main method, sets the key name from the array and the display name.

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

> **Note**: There is no need to specify the field name. It will be delivered automatically by the column name.


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


## Data output

In some cases, you may need to display combined data, the `render` method is for this purpose intended. It implements the ability to generate cells according to the function:
 
```php
TD::make('full_name')
    ->render(function ($user) {
        return $user->first_name . ' ' . $user->last_name;
    });
```

> **Note.** The returned string will not be escaped! You need to take care of this yourself with the `e()` helper or use `Blade` view.


The loopback function must return any string value:

```php
TD::make('full_name')
    ->render(function ($user) {
        return view('blade_template', [
            'user' => $user
        ]);
    });
```

Please note that you can use fields and actions:

```php
use Orchid\Screen\Actions\Link;

TD::make()
    ->render(function ($user) {
        return Link::make($user->last_name)
               ->route('platform.user.edit', $user);
    });
```

Sometimes you want to show more elements in a single column, for example more buttons. For this you can use a `Group`:

```php
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;

TD::make()
    ->render(function ($user) {
        return Group::make([
            Link::make('Show')->route('platform.user.show', $user);
            Link::make('Edit')->route('platform.user.edit', $user);
        ]);
    });
```

For example, display a checkbox for each line for a bulk action:

```php
TD::make()
    ->render(function (User $user){
        return CheckBox::make('users[]')
            ->value($user->id)
            ->placeholder($user->name)
            ->checked(false);
});
```

Sometimes it may be necessary to get the value from the `query` screen, rather than relying only on the `target`. You can get the value as follows:

```php
use Orchid\Screen\Actions\Link;

TD::make('price')
    ->render(function ($product) {
        return $product->price + $this->query->get('tax');
    });
```

## Components

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

The name is specified in the second argument:

```php
use App\View\CompochangingOrderShortInformation;

TD::make('status')->component(OrderShortInformation::class, 'order');
```

Other additional arguments, for example, limit. You can specify in the following way:

```php
TD::make('status')->component(OrderShortInformation::class, 'order', [
    'limit' => 100
]);
```

## Table options

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

## Total row

Adds a summary row at the bottom of the table, for this you need to define the `total` method and describe the required cells. For example:

```php
public function total():array
{
    return [
        TD::make('total')
            ->align(TD::ALIGN_RIGHT)
            ->colspan(2)
            ->render(function () {
                return 'Total:';
            }),

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

@if($bool)
    <i class="icon-check text-success"></i>
@else
    <i class="icon-close text-danger"></i>
@endif
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
