---
title: Listener
extends: _layouts.documentation
---

The listener layout is used when it is necessary to change the displayed data, in accordance with the selected user settings.

For example, we have a screen on which there are two fields for entering numbers. We need to display the third field, the value of which will be the sum of the other two:


```php
namespace App\Orchid\Screens;

use Orchid\Screen\Action;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string
     */
    public function name(): ?string
    {
        return 'Dashboard';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('a')
                    ->title('First argument')
                    ->type('number'),

                Input::make('b')
                    ->title('Second argument')
                    ->type('number'),
            ]),
        ];
    }
}
```

To create a listener layout, run the `artisan` command:

```php
php artisan orchid:listener AmountListener
```

In the directory `app/Orchid/Layouts` a new class will be created with the name` AmountListener`:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Listener;

class AmountListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [];

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = '';

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        return [
            Layout::rows([
                Input::make('a')
                    ->title('First argument')
                    ->type('number'),

                Input::make('b')
                    ->title('Second argument')
                    ->type('number'),
            ]),
        ];
    }
}
```

The `targets` property specifies the names of the fields, when changed, the required action will be performed. For our example, these are the fields with the names `a` and `b`:

```php
/**
 * List of field names for which values will be listened.
 *
 * @var string[]
 */
protected $targets = [
    'a',
    'b',
];
```

> **Note**. Multiple choice fields such as `<select name="users[]">` need to indicate that they are an array by ending the target value with a dot, such as `"users."`


The `asyncMethod` property must specify the method that will be called when the fields are changed. This method must be implemented on the screen.
Add it with the name `asyncSum`:

```php
namespace App\Orchid\Screens;

use App\Orchid\Layouts\AmountListener;
use Orchid\Screen\Action;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string
     */
    public function name(): ?string
    {
        return 'Dashboard';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * @param int|null $a
     * @param int|null $b
     *
     * @return string[]
     */
    public function asyncSum(int $a = null, int $b = null)
    {
        return [
            'a' => $a,
            'b' => $b,
            'sum' => $a + $b,
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            AmountListener::class,
        ];
    }
}
```

> **Please note**. Such a function is a substitute for the `query` for the required layouts, and the `async` prefix is required.

And indicate its name:

```php
/**
 * What screen method should be called
 * as a source for an asynchronous request.
 *
 * The name of the method must
 * begin with the prefix "async"
 *
 * @var string
 */
protected $asyncMethod = 'asyncSum';
```

It remains only to determine what will be shown in this layer.
The full class will look like this:


```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Listener;

class AmountListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'a',
        'b',
    ];

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = 'asyncSum';

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        return [
            Layout::rows([
                Input::make('a')
                    ->title('First argument')
                    ->type('number'),

                Input::make('b')
                    ->title('Second argument')
                    ->type('number'),

                Input::make('sum')
                    ->readonly()
                    ->canSee($this->query->has('sum')),
            ]),
        ];
    }
}
```

Now, when changing the values of the input fields, the sum field will change automatically.
