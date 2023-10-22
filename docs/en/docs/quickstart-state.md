---
title: Screen State
description: Learn how to store intermediate results and track screen state in Laravel using public properties. Optimize your information management with the user-friendly Orchid interface and code examples.
---

In PHP, when we want to store intermediate results between requests, we usually use storage solutions like databases (MySQL) or fast storage systems such as Redis. For simpler cases, we can pass the state directly in the URL. You have probably seen this before, for example, `operation?result=success`. Each of these methods is suitable and widely applicable.

However, in Laravel Orchid, there is a convenient solution for storing small amounts of information, such as an Eloquent model. This is made possible because each request carries the state of all public properties of the screen.

Let's try it out and create a new screen called `StateScreen` using the Artisan command:

```bash
php artisan orchid:screen StateScreen
```

Next, we need to register it in the route file:

```php
use App\Orchid\Screens\StateScreen;

Route::screen('state', StateScreen::class)->name('state');
```

A classic example is counting the number of clicks. Let's add the following code to the newly created screen:

```php
<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;

class StateScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'clicks' => 0,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'State';
    }

    /**
     * The screen's layout elements.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Label::make('clicks')->title('Click Count:'),
            ]),
        ];
    }
}
```

Let's open the page in a browser and see how the screen looks. It should display the label "Click Count: 0". Now, let's add a simple method to the screen to see the request content:

```php
/**
 * The screen's layout elements.
 *
 * @return array
 */
public function layout(): array
{
    return [
        Layout::rows([
            Label::make('clicks')
                ->title('Click Count:'),

            Button::make('Increment Click')
                ->type(Color::DARK)
                ->method('increment'),
        ]),
    ];
}

/**
 * Increment the click count.
 *
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function increment(Request $request)
{
    dd($request->all());
}
```

Upon clicking the "Submit" button, you will see the request content. However, please note that the click count value is missing. In a conventional server application, we could have achieved this by adding a hidden form field `<input type="hidden">` and redirecting with a GET parameter `?count=1`.

Fortunately, Orchid provides a convenient solution that automatically saves the state of public properties of the screen.

```php
class StateScreen extends Screen
{
    /**
     * The number of clicks.
     *
     * @var int
     */
    public $clicks;

    //...

    /**
     * Increment the click count.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function increment(Request $request)
    {
        dd($this->clicks);
    }
}
```

Now, when we submit the form, the property value will be preserved as we set it. In this example, we used a simple `int` type, but it can also be used for more complex objects like Eloquent models.

> Storing large amounts of data in public screen properties may cause performance issues. Therefore, it is recommended to exercise caution and avoid storing excessive information in public properties.

To update the screen state, we simply need to modify the public property. But before that, let's update our `query` method to return an array with the key `clicks` containing the current value of the property. If it's absent, we'll set it to `0`:

```php
class StateScreen extends Screen
{
    /**
     * The number of clicks.
     *
     * @var int
     */
    public $clicks;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'clicks'  => $this->clicks ?? 0,
        ];
    }
}
```

Let's update the `increment()` method to increment the value of the `clicks` property by one each time it's called.

```php
/**
 * Increment the click count.
 */
public function increment()
{
    $this->clicks++;
}
```

Now, when the user clicks the "Increment Click" button, the click counter will be updated. If you refresh the page, the counter will be reset.
