---
title: Графики
description: Графики Orchid Charts с общими подписями, наборами данных и fluent API.
---

Макеты графиков используют Orchid Charts. Передайте общий список подписей и наборы данных,
затем настройте отображение через методы макета.

## Подготовьте данные

```php
public function query(): array
{
    return [
        'visits' => [
            'labels'   => ['Mon', 'Tue', 'Wed'],
            'datasets' => [
                [
                    'name'   => 'Actual',
                    'values' => [12, 18, 15],
                ],
                [
                    'name'   => 'Plan',
                    'values' => [15, 16, 20],
                ],
            ],
        ],
    ];
}
```

Число элементов `values` в каждом наборе должно совпадать с числом `labels`.
Числовые строки преобразуются в числа.

## Покажите график

Первый аргумент `Chart::make()` задаёт источник данных (target): ключ массива, возвращённого из `query()`.
Передайте `visits`, чтобы использовать подготовленные выше данные. Метод `title()` задаёт заголовок над графиком:

```php
use Orchid\Screen\Layouts\Chart;

public function layout(): iterable
{
    return [
        Chart::make('visits')
            ->title('Daily visits'),
    ];
}
```

Над графиком появится заголовок **Daily visits**. График покажет две линии: **Actual** и **Plan**.
Значения `name` задают имена этих линий в легенде. Массив `labels` задаёт общие подписи горизонтальной оси.
По умолчанию используется линейный график высотой 250.

## Настройте отображение

```php
Chart::make('visits')
    ->title('Daily visits')
    ->description('Daily traffic')
    ->height(300)
    ->colors(['#2274a5', '#f75c03'])
    ->smooth()
    ->dots(false)
    ->gradient(['fromOpacity' => 0.25, 'toOpacity' => 0])
    ->marker('Target', 20)
    ->export();
```

Объединяйте допустимые параметры через `options()`:

```php
Chart::make('visits')
    ->type(Chart::TYPE_BAR)
    ->stacked()
    ->legend(false)
    ->options(['horizontal' => true, 'radius' => 3]);
```

Доступные типы графиков: `Chart::TYPE_LINE`, `TYPE_BAR`, `TYPE_MIXED`, `TYPE_PIE` и `TYPE_PERCENTAGE`.
Круговая и процентная диаграммы принимают ровно один набор данных.

## Объедините типы графиков

Для смешанного графика укажите `chartType` в каждом наборе:

```php
public function query(): array
{
    return [
        'sales' => [
            'labels'   => ['Jan', 'Feb'],
            'datasets' => [
                [
                    'name'      => 'Actual',
                    'values'    => [12, 18],
                    'chartType' => 'bar',
                    'radius'    => 3,
                ],
                [
                    'name'      => 'Plan',
                    'values'    => [15, 16],
                    'chartType' => 'line',
                    'smooth'    => true,
                ],
            ],
        ],
    ];
}

public function layout(): iterable
{
    return [
        Chart::make('sales')
            ->title('Monthly sales')
            ->type(Chart::TYPE_MIXED),
    ];
}
```

## Используйте метрики модели

Трейт `Orchid\Metrics\Chartable` добавляет scopes `countByDays()`, `sumByDays()`, `averageByDays()`,
`minByDays()`, `maxByDays()`, `valuesByDays()` и `countForGroup()`.
В модели `Orchid\Platform\Models\User` трейт подключён.

```php
use Orchid\Platform\Models\User;

public function query(): array
{
    return [
        'users' => User::countByDays()->toChart('New users'),
        'names' => User::countForGroup('name')->toChart(),
    ];
}

public function layout(): iterable
{
    return [
        Chart::make('users')
            ->title('New users by day')
            ->type(Chart::TYPE_LINE),
        Chart::make('names')
            ->title('Users by name')
            ->type(Chart::TYPE_PIE),
    ];
}
```

`toChart()` возвращает всю структуру `labels` и `datasets`.

Scopes по датам принимают начало периода, конец и колонку даты. Агрегаты первым аргументом принимают колонку значения:

```php
User::countByDays(now()->subDays(6)->startOfDay(), now(), 'created_at')->toChart('Users');
Order::sumByDays('total', now()->subDays(6)->startOfDay(), now(), 'paid_at')->toChart('Revenue');
```

Модель Order из примера должна использовать `Orchid\Metrics\Chartable` и иметь колонки `total` и `paid_at`.
`valuesByDays()` читает сохранённые значения, остальные scopes агрегируют записи по дням.

## Допустимые параметры

| Тип | Допустимые параметры |
| --- | --- |
| Все | `height`, `width`, `colors`, `legend`, `tooltip` |
| Line, bar, mixed | `axes`, `grid`, `valueLabels`, `frameless` |
| Line | `smooth`, `dots`, `dotSize`, `line`, `area`, `gradient`, `strokeWidth` |
| Bar | `stacked`, `horizontal`, `radius` |
| Mixed | `gradient` |
| Pie | `maxSlices`, `startAngle`, `padAngle` |
| Percentage | `maxSlices` |

Размеры, радиус, углы и количество сегментов принимают конечные числа. `colors` принимает список.
Остальные параметры являются логическими, кроме `gradient`: он принимает логическое значение или карту прозрачности.
Допустимые ключи карты: `fromOpacity` и `toOpacity`, числовые значения от 0 до 1.
Неизвестные параметры и неправильные типы вызывают `InvalidArgumentException`.

`marker($label, $value, $options)` добавляет отметку. `export()` показывает кнопку скачивания графика.
При повторной настройке параметра действует последнее значение.
