---
title: Legend
extends: _layouts.documentation
---

Legend layout is used to view one model:

![Legend](/img/layouts/legend.png)

Legend supports short writing without creating a separate class, for example:

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

The first argument is expected to receive a key specified in the query method of the screen, which should be arrays or models. And the second is which columns you want to display.


Many methods for the `Sight` class are in common with `TD` (used in the [table](/en/docs/table/)). For example, you can also add an explanation:

```php
Layout::legend('user', [
    Sight::make('id')->popover('Unique number in the system'),
]),
```

In order to render your own template or additional processing, you can use the closure function passed to the `render` method:

```php
Layout::legend('user', [
    Sight::make('id')->render(function (){
        return 'Any html';
    }),
]),
```

If such processing is needed often, then a more appropriate solution would be to create a `Blade component` ([More details](https://laravel.com/docs/blade#components)) and specify it:

```php
Layout::legend('user', [
    Sight::make('id')->component(IdInformation::class),
]),
```

Components work just like a table. You can [see more examples here](/en/docs/table#components).
