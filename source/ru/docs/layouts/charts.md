---
title: Графики
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Макет графиков удобный способ графически отображать динамику значений, но он требует некоторой обработки данных.

![Charts](https://orchid.software/assets/img/layouts/charts.png)

Пример данных из `query`:

```php
public function query($patient = null) : array
{
    $charts = [
        [
            'title'  => "Some Data",
            'values' => [25, 40, 30, 35, 8, 52, 17, -4],
        ],
        [
            'title'  => "Another Set",
            'values' => [25, 50, -10, 15, 18, 32, 27, 14],
        ],
        [
            'title'  => "Yet Another",
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
     * @var string
     */
    protected $title = 'DemoCharts';

    /**
     * @var int
     */
    protected $height = 150;

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
     * @var string
     */
    protected $target = 'charts';
}
```
