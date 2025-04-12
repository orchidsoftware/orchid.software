---
title: Графики
extends: _layouts.documentation
---

Макет графиков - удобный способ графически отображать динамику значений.

![Charts](/img/layouts/charts.png)

Пример данных из `query`:

```php
public function query() : array
{
    $charts = [
        [
            'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
            'name'  => 'Some Data',
            'values' => [25, 40, 30, 35, 8, 52, 17, -4],
        ],
        [
            'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
            'name'  => 'Another Set',
            'values' => [25, 50, -10, 15, 18, 32, 27, 14],
        ],
        [
            'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
            'name'  => 'Yet Another',
            'values' => [15, 20, -3, -15, 58, 12, -17, 37],
        ],
    ];
    
    return [
        'charts' => $charts,
    ];
}
```

Для создания выполните команду:

```php
php artisan orchid:chart ChartsLayout
```

Пример макета:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class ChartsLayout extends Chart
{
    /**
     * Add a title to the Chart.
     * 
     * @var string
     */
    protected $title = 'DemoCharts';

    /**
     * Available options:
     * 'bar', 'line', 
     * 'pie', 'percentage'
     *
     * @var string
     */
    protected $type = 'bar';

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the charts.
     *
     * @var string
     */
    protected $target = 'charts';
}
```

## Высота

Установите высоту диаграммы в пикселях с помощью указания свойства:

```php
/**
 * @var int
 */
protected $height = 250;
```

## Цвета

Установите цвета, которые будут использоваться для каждого отдельного типа единиц измерения, в зависимости от типа диаграммы с помощью указания свойства:

```php
/**
 * Colors used.
 *
 * @var array
 */
protected $colors = [
    '#2274A5',
    '#F75C03',
    '#F1C40F',
    '#D90368',
    '#00CC66',
];
```

## Экспорт изображения

Диаграммы  можно экспортировать в формате `SVG`, в котором они отображаются изначально. Для этого необходимо указать свойство:

```php
/**
 * Определяет, следует ли отображать кнопку экспорта.
 *
 * @var bool
 */
protected $export = true;
```

## Графики для моделей

Для того чтобы использовать методы получения данных для графиков у модели, необходимо добавить трейт `Chartable`:

```php
namespace App;

use Orchid\Metrics\Chartable;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    use Chartable;

    // ...
}
```

Это добавит несколько новых методов именно для построения графиков:

- Сгруппированные данные
- Временной период

### Сгруппированные данные

Например, нужно построить диаграмму, показывающую долю пользователей, которые включили двухфакторную аутентификацию.

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class UsageTwoFactorAuth extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Usage two-factor authentication';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'pie';

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'userUsageTwoFactorAuth';
}
```

Тогда в качестве источника данных, будет служить запрос модели `countForGroup()`

```php
public function query(): array
{
    return [
        'userUsageTwoFactorAuth' => User::countForGroup('uses_two_factor_auth')->toChart(),
    ];
}

public function layout(): array
{
    return [
        UsageTwoFactorAuth::class,
    ];
}
```

Для того чтобы изменить текст заголовков, можно передать первым аргументом функцию замыкания:

```php
User::countForGroup('uses_two_factor_auth')->toChart(static function (bool $title) {
    return $title ? 'Enabled' : 'Disabled';
});
```

### Временной период

Получает данные за какой-либо временной период, проставляя отсутствующие значения.

Например, выведем график новых пользователей и ролей:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class Members extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'New members';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'line';

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'members';
}
```

Тогда источник данных будет:

```php
public function query(): array
{
    return [
        'members' => [
            User::countByDays()->toChart('Users'),
            Role::countByDays()->toChart('Roles'),
        ]
    ];
}

public function layout(): array
{
    return [
        Members::class,
    ];
}
```

По умолчанию данные будут взяты за один месяц, для задания собственного периода необходимо передать аргументы:

```php
$start = Carbon::now()->subDay(7);
$end = Carbon::now()->subDay(1);

User::countByDays($start, $end)->toChart('Users');
```

По умолчанию данные группируются по колонке `created_at`. Для изменения группировки:

```php
$start = Carbon::now()->subDay(7);
$end = Carbon::now()->subDay(1);

User::countByDays($start, $end, 'updated_at')->toChart('Users');
```

## Типы запросов

Метрики значений поставляются не только с методом  `countByDays`.Вы также можете использовать множество других агрегатных функций при построении метрики.

### Среднее

Метод  `average` может использоваться для вычисления среднего значения данного столбца.

```php
Order::averageByDays('price')->toChart('Order'),
```

### Сумма

Метод `sum` может использоваться для вычисления суммы данного столбца:

```php
Order::sumByDays('price')->toChart('Order'),
```

### Минимум

Метод `min` method may be used to calculate the min of a given column:

```php
Order::minByDays('price')->toChart('Order'),
```

### Максимум

Метод `max` метод можно использовать для вычисления максимума заданного столбца:

```php
Order::maxByDays('price')->toChart('Order'),
```
