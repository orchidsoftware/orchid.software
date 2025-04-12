---
title: Listener
description: Learn how to use Laravel Orchid's Listener feature to create dynamic pages with real-time data. Explore the various options available to customize your listener and keep your application up-to-date with the latest information.
extends: _layouts.documentation
---


The `Listener` layout is a special type of layout that is used to update the displayed data on a screen in response to user input. This is useful when you want to create dynamic and interactive screens that can change their appearance and behavior based on user actions.

In this example, we have a screen with two input fields for numbers that must be subtracted from each other. We can do this by using a listener layout.

To create a listener layout, you need to run the following `artisan` command in your terminal:

```php
php artisan orchid:listener SubtractListener
```

Running the command above will create a new class named `SubtractListener` in the `app/Orchid/Layouts` directory. 
Once created, you can now add the required fields in the `layouts` method as shown below:


```php
namespace App\Orchid\Layouts;

use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class SubtractListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [];

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        return [
            Layout::rows([
                Input::make('minuend')
                    ->title('First argument')
                    ->type('number'),

                Input::make('subtrahend')
                    ->title('Second argument')
                    ->type('number'),
            ]),
        ];
    }
    
    /**
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        return $repository;
    }
}
```

Here, the `targets` property takes the names of the fields that require action whenever they are changed.
In our example, the fields with the names `minuend` and `subtrahend` are considered targets:
```php
/**
 * List of field names for which values will be listened.
 *
 * @var string[]
 */
protected $targets = [
    'minuend',
    'subtrahend',
];
```

> **Note**. Multiple choice fields such as `<select name="users[]">` need to indicate that they are an array by ending the target value with a dot, such as `"users."`


Now comes the `handle` method, which is responsible for handling the target fields. The method is automatically called when the values in the target fields change. 
It takes in two arguments - `$repository` represents the current state of all the fields on the screen, while `$request` represents the new state of the screen.

```php
namespace App\Orchid\Layouts;

use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class SubtractListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'minuend',
        'subtrahend',
    ];

    /**
     * @return Layout[]
     */
    protected function layouts(): iterable
    {
        return [
            Layout::rows([
                Input::make('minuend')
                    ->title('First argument')
                    ->type('number'),

                Input::make('subtrahend')
                    ->title('Second argument')
                    ->type('number'),

                Input::make('result')
                    ->readonly()
                    ->canSee($this->query->has('result')),
            ]),
        ];
    }

    /**
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        $minuend = $request->input('minuend');
        $subtrahend = $request->input('subtrahend');

        return $repository
            ->set('minuend', $minuend)
            ->set('subtrahend', $subtrahend)
            ->set('result', $minuend - $subtrahend);
    }
}
```

The codes above show an updated version of the `SubtractListener` class. To handle the values in the target fields, we destructured the `$request` object, assigning the values in the fields `minuend` and `subtrahend` to variables with same names. We then updated the `$repository` object with these values as well as with the result of the subtraction of the two values which is reflected in the `result` field.
