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
            'labels' => ['Mon', 'Tue', 'Wed'],
            'datasets' => [
                ['name' => 'Actual', 'values' => [12, 18, 15]],
                ['name' => 'Plan', 'values' => [15, 16, 20]],
            ],
        ],
    ];
}
```

Число элементов `values` в каждом наборе должно совпадать с числом `labels`.
Числовые строки преобразуются в числа. Перед отправкой в браузер массивы получают последовательные индексы.

## Покажите график

```php
use Orchid\Screen\Layouts\Chart;
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::chart('visits', 'Visits')
            ->description('Daily traffic')
            ->type(Chart::TYPE_LINE)
            ->height(300)
            ->colors(['#2274a5', '#f75c03'])
            ->smooth()
            ->dots(false)
            ->gradient(['fromOpacity' => 0.25, 'toOpacity' => 0])
            ->marker('Target', 20)
            ->export(),
    ];
}
```

`Layout::chart()` создаёт график без отдельного класса. Также доступен `Chart::make('visits', 'Visits')`.
По умолчанию используется тип `line` и высота 250.

Поддерживаются `Chart::TYPE_LINE`, `TYPE_BAR`, `TYPE_MIXED`, `TYPE_PIE` и `TYPE_PERCENTAGE`.
Для кругового и процентного графиков требуется ровно один набор данных.

## Настройте отображение

Объединяйте допустимые параметры через `options()`:

```php
Layout::chart('visits')->type(Chart::TYPE_BAR)
    ->stacked()
    ->legend(false)
    ->options(['horizontal' => true, 'radius' => 3]);
```

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

## Объедините типы графиков

Для смешанного графика укажите `chartType` в каждом наборе:

```php
return [
    'sales' => [
        'labels' => ['Jan', 'Feb'],
        'datasets' => [
            ['name' => 'Actual', 'values' => [12, 18], 'chartType' => 'bar', 'radius' => 3],
            ['name' => 'Plan', 'values' => [15, 16], 'chartType' => 'line', 'smooth' => true],
        ],
    ],
];

// In layout():
Layout::chart('sales')->type(Chart::TYPE_MIXED);
```

## Используйте метрики модели

Трейт `Orchid\Metrics\Chartable` добавляет scopes `countByDays()`, `sumByDays()`, `averageByDays()`,
`minByDays()`, `maxByDays()`, `valuesByDays()` и `countForGroup()`.
В модели User трейт уже подключён.

```php
return [
    'users' => User::countByDays()->toChart('Users'),
    'names' => User::countForGroup('name')->toChart(),
];

// In layout():
Layout::chart('users')->type(Chart::TYPE_LINE);
Layout::chart('names')->type(Chart::TYPE_PIE);
```

`toChart()` возвращает всю структуру `labels` и `datasets`. Не помещайте её в старый внешний массив наборов.

Scopes по датам принимают начало периода, конец и колонку даты. Агрегаты первым аргументом принимают колонку значения:

```php
User::countByDays(now()->subDays(6)->startOfDay(), now(), 'created_at')->toChart('Users');
Order::sumByDays('total', now()->subDays(6)->startOfDay(), now(), 'paid_at')->toChart('Revenue');
```

Модель Order из примера должна использовать `Orchid\Metrics\Chartable` и иметь колонки `total` и `paid_at`.
`valuesByDays()` читает сохранённые значения, остальные scopes агрегируют записи по дням.

## Создавайте графики напрямую

Генератор `orchid:chart` удалён. Верните настроенный график из метода `layout()` экрана:

```php
use Orchid\Screen\Layouts\Chart;

Chart::make('visits', 'Visits')
    ->type(Chart::TYPE_BAR)
    ->export();
```

Общее определение можно вынести в обычную фабрику, возвращающую настроенный объект.
Существующие подклассы Chart поддерживаются; настраивайте их через методы, не переопределяйте типизированные свойства.

## Переход с Frappe Charts

Перенесите подписи из каждого набора в общий массив `labels`, а серии поместите в `datasets`.
Замените старые свойства отображения методами или допустимыми ключами `options()`.
Параметры и клиентский API Frappe не поддерживаются. После обновления опубликуйте новые ресурсы.
