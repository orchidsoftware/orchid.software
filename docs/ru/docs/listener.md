---
title: Listener
extends: _layouts.documentation
---

`Listener` макет - особый тип макета, который используется для обновления отображаемых данных на экране в ответ на ввод пользователя. Это полезно, когда вы хотите создать динамические и интерактивные экраны, способные изменять свой вид и поведение в зависимости от действий пользователя.

В этом примере у нас есть экран с двумя полями ввода для чисел, которые должны быть вычтены друг из друга. Мы можем сделать это с помощью макета слушателя (listener layout).

Для создания макета слушателя вам необходимо выполнить следующую команду `artisan` в вашем терминале:

```php
php artisan orchid:listener SubtractListener
```

Эта команда создаст новый класс с именем `SubtractListener` в директории `app/Orchid/Layouts`.

Выполнение вышеприведенной команды создаст новый класс с именем `SubtractListener` в директории `app/Orchid/Layouts`. После создания вы можете добавить необходимые поля в методе `layouts`, как показано ниже:

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
     * Список имен полей, значения которых будут отслеживаться.
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
                    ->title('Первый аргумент')
                    ->type('number'),

                Input::make('subtrahend')
                    ->title('Второй аргумент')
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

Здесь свойство `targets` содержит имена полей, для которых требуется действие при изменении. В нашем примере поля с именами `minuend` и `subtrahend` считаются целевыми:

```php
/**
 * Список имен полей, значения которых будут отслеживаться.
 *
 * @var string[]
 */
protected $targets = [
    'minuend',
    'subtrahend',
];
```

> **Примечание**. Множественные поля выбора, такие как `<select name="users[]">`, должны указывать, что они являются массивом, окончив значение цели точкой, например `"users."`.

Теперь мы перейдем к методу `handle`, который отвечает за обработку целевых полей. Этот метод автоматически вызывается при изменении значений в целевых полях. Он принимает два аргумента: `$repository`, который представляет текущее состояние всех полей на экране, и `$request`, который представляет новое состояние экрана.

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
     * Список имен полей, значения которых будут отслеживаться.
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
                    ->title('Первый аргумент')
                    ->type('number'),

                Input::make('subtrahend')
                    ->title('Второй аргумент')
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

Вышеприведенный код показывает обновленную версию класса `SubtractListener`. Для обработки значений в целевых полях мы использовали деконструкцию объекта `$request`, присваивая значения полей `minuend` и `subtrahend` переменным с теми же именами. Затем мы обновили объект `$repository` этими значениями, а также результатом вычитания двух чисел, отраженным в поле `result`.
