---
title: Listener
extends: _layouts.documentation
---

Слой слушателя используется, когда необходимо менять отображаемые данные,
 в соответствии с выбранными параметрами пользователя.

Например, у нас есть экран, на котором расположены два поля для ввода чисел.
Нам требуется вывести третье поле, значение которого будет суммой двух других:

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

Для создания слоя слушателя необходимо выполнить `artisan` команду:

```php
php artisan orchid:listener AmountListener
```

В директории `app/Orchid/Layouts` будет создан новый класс с именем `AmountListener`:

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

В свойстве `targets` указываются имена полей, при изменениях которых будет выполнено требуемое действие. Для нашего примера это поля с именами `a` и `b` :

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

> **Примечание**. Для полей  с множественным выбором, таких как `<select name="users[]">` необходимость указать, что они являются массивом, заканчивая значение точкой, например `"users."`

В свойстве `asyncMethod` должен быть указан метод, который будет вызван при изменении полей. Этот метод необходимо реализовать в экране.
Добавим его с именем `asyncSum`:

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

> **Обратите внимание**. Такая функция является заменой `query` для требуемых слоёв, при этом префикс `async` обязателен.

И укажем его имя:

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

Осталось только определить, что будет показано в этом слоё.
Полный класс будет выглядеть следующим образом:


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


Теперь при изменении значений полей ввода, поле суммы будет меняться автоматически.
