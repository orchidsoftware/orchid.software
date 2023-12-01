---
title: Таблицы
---

## Таблицы

Макет таблицы используется для вывода минимальной информации для просмотра и выборки.

![Table](/img/layouts/table.png)


Для создания выполните команду:
```php
php artisan orchid:table PatientListLayout
```

Пример:
```php
namespace App\Layouts\Clinic\Patient;

use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Platform\Http\Filters\SearchFilter;
use App\Http\Filters\LastNamePatient;

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
            TD::make('last_name','Last name')
                ->align('center')
                ->width('100px')
                ->render(function ($patient) {
                    return Link::make($patient->last_name)
                        ->route('platform.clinic.patient.edit', $patient);
                }),

            TD::make('first_name', 'First Name')
                ->sort()
                ->render(function ($patient) {
                    return Link::make($patient->first_name)
                        ->route('platform.clinic.patient.edit', $patient);
                }),

            TD::make('phone','Phone')
                ->render(function ($patient){
                    return ModalToggle::make($patient->phone)
                        ->modal('oneAsyncModal')
                        ->modalTitle('Phone')
                        ->method('saveUser')
                        ->asyncParameters([
                            'id' => $patient->id,
                        ]);
                }),

            TD::make('email','Email'),
            TD::make('created_at','Date of publication'),
        ];
    }
}
```

Таблицы так же поддерживают запись через короткий синтаксис без создания класса:

```php
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

Layout::table('clients', [
    TD::make('name'),
    TD::make('created_at')->sort(),
]);
```

## Ячейки

Таблица является только общей оболочкой, для которой необходимо указать классы TD, предназначенные для создания одной ячейки.

```php
use Orchid\Screen\TD;

TD::make('last_name');
```

Метод `make` является основным методом, он устанавливает имя ключа из массива и отображаемое название.

```php
TD::make('last_name', 'Last name');
```


## Выравнивание

Выравниванием содержимого можно управлять с помощью метода `align`:

```php
TD::make('last_name')->align(TD::ALIGN_LEFT);
TD::make('last_name')->align(TD::ALIGN_CENTER);
TD::make('last_name')->align(TD::ALIGN_RIGHT);
```

## Сортировка

Сортировка выборки должна осуществляться в `query` экрана,
для моделей можно использовать автоматическую `http` [сортировку и 
фильтрацию](/ru/docs/filters/#avtomaticheskaya-http-filtratsiya-i-sortirovka)

Для включения активной возможности сортировки по данному столбцу
необходимо указать метод `sort`:

```php
TD::make('last_name')->sort();
```

## Фильтрация

При построении простых таблиц использование отдельных фильтров может показаться излишним. Поэтому Вы можете отобразить поле для фильтрации прямо над заголовком столбца.

Он будет определять только видимую часть. Вы можете указать логику фильтрации самостоятельно или положиться на «Автоматическую HTTP фильтрацию». Подробнее вы можете узнать на [странице "Фильтры"](/en/docs/filters/#automatic-http-filtering-and-sorting).

Чтобы добавить поле, вызовите метод фильтра и передайте экземпляр класса, который Вы хотите отобразить:

```php
TD::make('SKU')->filter(Input::make()->mask('A-999999'));
```

> **Примечание**: Нет необходимости указывать имя поля. Оно будет доставлено и автоматически перезаписано именем столбца..

Фильтрацию нескольких значений можно выполнить с помощью Select и необязательного второго аргумента filter. По умолчанию он позволяет фильтровать любые/все заданные значения.

```php
TD::make('color')->filter(TD::FILTER_SELECT, ['red'=>'Red', 'green'=>'Green']);
```

## Ширина

Управлять шириной ячейки можно используя метод `width`:

```php
TD::make('last_name')->width('100px');
```

## Отображение и скрытие столбцов

По умолчанию пользователь может скрыть для себя любой столбец, но вы можете
запретить делать это указав:

```php
TD::make('last_name')->cantHide();
```

А также скрыть по умолчанию, но можно показать по желанию пользователя.

```php
TD::make('last_name')->defaultHidden();
```


## Вывод данных

В некоторый случаях, может потребоваться отобразить комбинированные
 данные, для этого предназначен метод `render`. Он реализует возможность генерации ячейки согласно функции:
 
```php
TD::make('full_name')
    ->render(function ($user) {
        return $user->firt_name . ' ' . $user->last_name;
    });
```
> **Примечание.** Возвращаемая строка не будет экранирована! Вам нужно позаботиться об этом самостоятельно с помощью помощника `e()` помощника или использовать `Blade` представление.
>
Функция замыкания должна возвращать любое строчное значение:
```php
TD::make('full_name')
    ->render(function ($user) {
        return view('blade_template', [
            'user' => $user
        ]);
    });
```

Обратите внимание, что вы можете использовать поля и действия:

```php
use Orchid\Screen\Actions\Link;

TD::make('full_name')
    ->render(function ($user) {
        return Link::make($user->last_name)
               ->route('platform.user.edit', $user);
    });
```


Иногда требуется отобразить больше элементов в одном столбце, например, больше кнопок. Для этого вы можете использовать  `Group`:

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

Например, для каждой строки отобразить checkbox для  для массового действия:

```php
TD::make()
    ->render(function (User $user){
        return CheckBox::make('users[]')
            ->value($user->id)
            ->placeholder($user->name)
            ->checked(false);
});
```

Иногда может потребоваться получить значение из `query` экрана, а не полагаться только на `target`. Вы можете получить значение следующим образом:

```php
use Orchid\Screen\Actions\Link;

TD::make('price')
    ->render(function ($product) {
        return $product->price + $this->query->get('tax');
    });
```

## Объект итератора (Loop variable)


Переменная `$loop` доступна вторым аргументом замыкания `render`. Эта переменная дает доступ к некоторой полезной информации о текущем состоянии итератора, например, индекс текущего элемента или является ли это первой или последней итерацией цикла:

```php
TD::make()->render(function (Model $model, object $loop) {
    return $loop->index;
})
```

Переменная `$loop` содержит множество полезных параметров, подробнее можно ознакомиться в [Документации Laravel](https://laravel.com/docs/9.x/blade#loops).


## Компоненты

Сложные или динамические данные могут быть утомительными для указания в методе рендеринга или казаться чрезмерными. Поэтому ячейки поддерживают рендеринг с использованием [компонентов laravel](https://laravel.com/docs/blade#components). Это позволяет вынести логику отображения и использовать повторно.

Например, есть модель `Order`  и в зависимости от статуса мы можем показывать разное описание в наших компонентах.
Это намного удобнее, чем указывать вещи прямо в представлении или создавать определенные области для такой обработки.

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

Чтобы использовать компонент в ячейке, вы должны передать его:

```php
use App\View\CompochangingOrderShortInformation;

TD::make('status')->component(OrderShortInformation::class);
```

В качестве первого аргумента компонент получит всю строку, а не только данные ячейки.

Поэтому, если вы используете deep injection в своем компоненте, важно указать имя переменной.

```php
public function __construct(Application $application, Order $order, int $limit = 300)
{
    $this->order = $order;
    // ...
}
```

Другие дополнительные аргументы, например, limit. Вы можете указать следующим образом:

```php
TD::make('status')->component(OrderShortInformation::class, [
    'limit' => 100
]);
```

## Компонент - Значение

Это очень похоже на использование компонента выше, только предыдущий пример получает объект. Но это не всегда нужно, иногда нужно обработать только значение.

Для этого нужно добавить новый метод, который бы по умолчанию получал только значение ячейки без дополнительной информации. Например, я хочу отображать значения определенного формата:

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

Тогда вызов таблицы может выглядеть так:

```php
TD::make('price')->asComponent(Numeric::class);
// 1,235
```

Также с дополнительными параметрами:


```php
TD::make('price')->asComponent(Numeric::class, [
    'decimals' => 2,
    'decimal_separator' => ',',
    'thousands_separator' => ' ',
]);
// 1 234,56
```

## Параметры таблицы

Вы можете указать текст, который будет отображён если таблица пуста,
дополнительно указав методы:

```php
/**
 * @return string
 */
protected function iconNotFound(): string
{
    return 'icon-table';
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

Если строки таблицы кажутся вам не контрастными, то Вы можете включить 
`striped` режим:

```php
/**
 * @return bool
 */
protected function striped(): bool
{
    return true;
}
```

Вы можете динамически изменять количество навигационных ссылок, отображаемых в  постраничной навигации таблицы, следующим способом:

```php
/**
 * Количество ссылок, отображаемых с каждой стороны от ссылки на текущую страницу.
 *
 * @return int
 */
protected function onEachSide(): int
{
    return 3;
}
```

## Строка итога

Добавляет итоговую строку внизу таблицы, для этого необходимо определить метод `total` и описать требуемые ячейки. Например:

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

Данная строка будет игнорировать указанный `target` смотря на результат `query` экрана:

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


## Расширение колонок

Работая с однотипными данными, часто требуется и обрабатывать их одинаковым образом. Для того чтобы не дублировать код, в слоях имеется возможность расширять класс `TD` собственными методами. Для этого необходимо в сервис-провайдере зарегистрировать функцию замыкания.

Пример регистрации:

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
Пример шаблона:
```php
// bool.blade.php

<span class="{{ $bool ? 'text-success' : 'text-danger' }}">●</span>
```

Пример использования:
```php
public function grid(): array
{
    return [
        TD::make('status')->bool(),
    ];
}
```
