---
title: Графики
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Макет графиков удобный способ графически отображать динамику значений.

![Charts](/assets/img/layouts/charts.png)

Пример данных из `query`:

```php
public function query() : array
{
    $charts = [
        [
            'title'  => 'Some Data',
            'values' => [25, 40, 30, 35, 8, 52, 17, -4],
        ],
        [
            'title'  => 'Another Set',
            'values' => [25, 50, -10, 15, 18, 32, 27, 14],
        ],
        [
            'title'  => 'Yet Another',
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
namespace App\Layouts\Clinic\Patient;

use Orchid\Platform\Layouts\Chart;

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
     * @var array
     */
    protected $labels = [
        '12am-3am',
        '3am-6am',
        '6am-9am',
        '9am-12pm',
        '12pm-3pm',
        '3pm-6pm',
        '6pm-9pm',
        '9pm-12am',
    ];

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
Установите цвета, которые будут использоваться для каждого отдельного типа единиц, в зависимости от типа диаграммы с помощью указания свойства:

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
 * Determines whether to display the export button.
 *
 * @var bool
 */
protected $export = true;
```


