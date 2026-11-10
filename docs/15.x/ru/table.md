---
title: Таблицы
---

Table выводит записи из репозитория экрана. Передайте в `make()` сначала ключ данных, затем массив колонок.
`Layout::table()` создаёт такой же объект. Подкласс и генератор для этого не нужны.

```php
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

Table::make('patients', [
    TD::make('name'),
    TD::make('created_at')->sort(),
])->title('Patients');

Layout::table('patients', [
    TD::make('name'),
    TD::make('created_at')->sort(),
]);
```

Верните коллекцию, массив, paginator или cursor paginator под ключом `patients` из `query()` экрана.
Для стандартного вывода ячеек каждая запись должна быть моделью с трейтом `Orchid\Screen\AsSource` или объектом
`Repository`.
Обычные массивы преобразуйте через `Repository::elements()`:

```php
use Orchid\Screen\Repository;

public function query(): array
{
    return [
        'patients' => Repository::elements([
            ['name' => 'Alex', 'created_at' => '2026-01-01'],
        ]),
    ];
}
```

Для Table и Sortable непустой ключ данных обязателен при создании объекта.

## Ячейки

Таблица является только общей оболочкой, для которой необходимо указать классы TD, предназначенные для создания одной
ячейки.

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

Сортировка выборки должна осуществляться в `query` экрана, для моделей можно использовать автоматическую `http`
[сортировку и фильтрацию](/ru/docs/filters/#avtomaticheskaya-http-filtratsiya-i-sortirovka)

Для включения активной возможности сортировки по данному столбцу необходимо указать метод `sort`:

```php
TD::make('last_name')->sort();
```

## Фильтрация

При построении простых таблиц использование отдельных фильтров может показаться излишним. Поэтому Вы можете отобразить
поле для фильтрации прямо над заголовком столбца.

Он будет определять только видимую часть. Вы можете указать логику фильтрации самостоятельно или положиться на
«Автоматическую HTTP фильтрацию». Подробнее вы можете узнать на
[странице «Фильтры»](/ru/docs/filters/#avtomaticheskaya-http-filtratsiya-i-sortirovka).

Чтобы добавить поле, вызовите метод фильтра и передайте экземпляр класса, который Вы хотите отобразить:

```php
TD::make('SKU')->filter(Input::make()->mask('A-999999'));

TD::make('color')->filter(
    Select::make()
        ->options(['red' => 'Red', 'green' => 'Green'])
        ->empty()
);
```

> **Примечание**: Нет необходимости указывать имя поля. Оно будет доставлено и автоматически перезаписано именем
> столбца.

## Ширина

Управлять шириной ячейки можно используя метод `width`:

```php
TD::make('last_name')->width('100px');
```

## Отображение и скрытие столбцов

По умолчанию пользователь может скрыть для себя любой столбец, но вы можете запретить делать это указав:

```php
TD::make('last_name')->cantHide();
```

А также скрыть по умолчанию, но можно показать по желанию пользователя.

```php
TD::make('last_name')->defaultHidden();
```

> Чтобы убрать выбор колонок из подвала таблицы, вызовите `cantHide()` для каждой колонки.

## Вывод данных

В некоторый случаях, может потребоваться отобразить комбинированные данные, для этого предназначен метод `render`. Он
реализует возможность генерации ячейки согласно функции:

```php
TD::make('full_name')
    ->render(function ($user) {
        return $user->first_name . ' ' . $user->last_name;
    });
```

> **Примечание.** Возвращаемая строка не будет экранирована! Вам нужно позаботиться об этом самостоятельно с помощью
> помощника `e()` помощника или использовать `Blade` представление.
>
> Функция замыкания должна возвращать любое строчное значение:

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
               ->route('orchid.user.edit', $user);
    });
```

Иногда требуется отобразить больше элементов в одном столбце, например, больше кнопок. Для этого вы можете использовать
`Group`:

```php
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;

TD::make()
    ->render(function ($user) {
        return Group::make([
            Link::make('Show')->route('orchid.user.show', $user),
            Link::make('Edit')->route('orchid.user.edit', $user),
        ]);
    });
```

Например, для каждой строки отобразить checkbox для для массового действия:

```php
TD::make()
    ->render(function (User $user){
        return CheckBox::make('users[]')
            ->value($user->id)
            ->placeholder($user->name)
            ->checked(false);
});
```

Если ячейке нужны данные вне набора таблицы, объявите публичное свойство Screen и верните его значение из `query()`.
Orchid заполнит свойство перед вызовом `layout()`. В callback переменная `$this` по-прежнему указывает на Screen:

```php
namespace App\Orchid\Screens;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;

class ProductListScreen extends Screen
{
    public int $tax = 0;

    public function query(): array
    {
        return [
            'products' => [(object) ['price' => 100]],
            'tax' => 20,
        ];
    }

    public function layout(): iterable
    {
        return [
            Table::make('products', [
                TD::make('price')->render(fn (object $product) => $product->price + $this->tax),
            ]),
        ];
    }
}
```

## Объект итератора (Loop variable)

Переменная `$loop` доступна вторым аргументом замыкания `render`. Эта переменная дает доступ к некоторой полезной
информации о текущем состоянии итератора, например, индекс текущего элемента или является ли это первой или последней
итерацией цикла:

```php
TD::make()->render(function (Model $model, object $loop) {
    return $loop->index;
})
```

Переменная `$loop` содержит множество полезных параметров, подробнее можно ознакомиться в
[Документации Laravel](https://laravel.com/docs/12.x/blade#loops).

## Компоненты

Используйте [Blade-компонент](https://laravel.com/docs/blade#components), если несколько колонок или экранов
используют одну логику отображения. Например, этот компонент выводит статус заказа:

```php
namespace App\View\Components;

use App\Models\Order;
use Illuminate\View\Component;

class OrderShortInformation extends Component
{
    public function __construct(public readonly Order $order) {}

    public function render(): string
    {
        return '<span>{{ $order->status }}</span>';
    }
}
```

В примере используется модель Order с атрибутом `status`. Передайте класс компонента в колонку:

```php
use App\View\Components\OrderShortInformation;

TD::make('status')->component(OrderShortInformation::class);
```

Метод `component()` передаёт всю запись параметру `$order` компонента. Blade экранирует значение статуса.

## Компонент - Значение

Это очень похоже на использование компонента выше, только предыдущий пример получает объект. Но это не всегда нужно,
иногда нужно обработать только значение.

Метод `asComponent()` передаёт компоненту только значение ячейки. Например, создайте компонент форматирования числа:

```php
namespace App\View\Components;

use Illuminate\View\Component;

class Numeric extends Component
{
    public string $value;

    public function __construct(
        float $value,
        int $decimals = 0,
        string $decimal_separator = '.',
        string $thousands_separator = ',',
    ) {
        $this->value = number_format($value, $decimals, $decimal_separator, $thousands_separator);
    }

    public function render(): string
    {
        return '{{ $value }}';
    }
}
```

Для цены `1234.56` следующая колонка выведет `1,235`:

```php
TD::make('price')->asComponent(Numeric::class);
// 1,235
```

Передайте параметры форматирования массивом:

```php
TD::make('price')->asComponent(Numeric::class, [
    'decimals' => 2,
    'decimal_separator' => ',',
    'thousands_separator' => ' ',
]);
// 1 234,56
```

## Настройка таблицы

Оформление задаётся цепочкой методов:

```php
Table::make('users', [
    TD::make('name'),
    TD::make('email'),
])
    ->striped()
    ->compact()
    ->bordered()
    ->hoverable()
    ->onEachSide(2);
```

Эти методы включают оформление без boolean-флагов. `onEachSide()` задаёт число ссылок рядом с текущей страницей
пагинации.

## Итоговая строка

Передайте ячейки подвала в `totals()`. Значения берутся из корня репозитория, а не из источника данных таблицы:

```php
Table::make('orders', [
    TD::make('name'),
    TD::make('price'),
])->totals([
    TD::make('label')->render(fn () => 'Total:'),
    TD::make('total_price'),
]);

// In query():
return [
    'orders' => $orders,
    'total_price' => $orders->sum('price'),
];
```

## Пустые состояния

По умолчанию таблица различает отсутствие записей и отсутствие совпадений после фильтрации.
При активных фильтрах доступно действие сброса параметров `filter`, `page` и `cursor`.
Настраивайте только необходимые части:

```php
use Orchid\Screen\Actions\Link;

Table::make('orders', [TD::make('name')])
    ->emptyIcon('bs.inbox')
    ->emptyTitle('No orders')
    ->emptyDescription('New orders will appear here.')
    ->emptyAction(Link::make('Create order')->route('orchid.orders.create'));
```

Определите маршрут создания из примера в приложении. Без `emptyAction()` сохраняется стандартный сброс фильтров;
`emptyAction(null)` явно убирает действие. Переопределять protected-методы не нужно.
Именованные классы таблиц остаются доступны для повторного использования. Генератор `orchid:table` удалён.
