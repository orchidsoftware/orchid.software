---
title: Charts
extends: _layouts.documentation
section: main
lang: en
menu: layouts
---

Graph layout is a convenient way to graphically display the dynamics of values.

![Charts](/assets/img/layouts/charts.png)

Example data from `query`:

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

To create, run the command:
```php
php artisan orchid:chart ChartsLayout
```

Layout example:
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

## Height

Set the height of the chart in pixels by specifying the property:

```php
/**
 * @var int
 */
protected $height = 250;
```


## Colors

Set the colors that will be used for each individual unit type, depending on the type of chart by specifying a property:

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


## Export Image

Charts can be exported in the `SVG` format, in which they are displayed initially. To do this, specify the property:

```php
/**
 * Determines whether to display the export button.
 *
 * @var bool
 */
protected $export = true;
```


