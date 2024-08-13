---
title: Legend
description: Learn how to use the Legend and Summary features in Laravel Orchid to organize and display important information in your administration-style applications. Improve the clarity and usability of your project with these easy to use tools.
extends: _layouts.documentation
---

The Legend layout is used to display a single model or array of data in a clear and concise way. The layout supports short, concise syntax for defining the data to be displayed, as well as the ability to customize the rendering of individual data points using closures or Blade components.

Here is an example of how to use the Legend layout:

```php
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Sight;

public function layout(): array
{
    return [
        Layout::legend('user', [
            Sight::make('id'),
            Sight::make('name'),
            Sight::make('email'),
        ]),
    ];
}
```

In the example above, the first argument passed to the `Layout::legend()` method is the key for the data to be displayed. This key should correspond to an array or model that has been passed to the screen's `query` method. The second argument is an array of `Sight` objects, each representing a data point to be displayed.

![This image shows an illustrative legend for a User model.](/img/layouts/legend.png)

Many methods of the `Sight` class are similar to those of the `TD` class used in the [Table](/en/docs/table) layout. For example, you can add a popover to provide additional information about a data point:


```php
Layout::legend('user', [
    Sight::make('id')->popover('Unique number in the system'),
]),
```

If you need to perform additional processing or rendering for a particular data point, you can use the `render` method and pass in a closure function:


```php
Layout::legend('user', [
    Sight::make('id')->render(fn() => 'Any html'),
]),
```

If you need to perform similar processing for multiple data points, a more appropriate solution would be to create a Blade component and specify it using the `component` method:


```php
Layout::legend('user', [
    Sight::make('id')->component(IdInformation::class),
]),
```

Blade components work in a similar way to those used in the [Table](/en/docs/table) layout. You can find more examples and information about using Blade components [here](https://laravel.com/docs/blade#components).
