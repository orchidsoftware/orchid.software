---
title: Charts
description: Creating various graphs in Laravel Orchid, using an eloquent model
---

Graph layout is a convenient way to graphically display the dynamics of values.

![Charts](/img/layouts/charts.png)

Example data from `query`:

```php
public function query() : array
{
    $charts = [
        [
            'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
            'title'  => 'Some Data',
            'values' => [25, 40, 30, 35, 8, 52, 17, -4],
        ],
        [
            'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
            'title'  => 'Another Set',
            'values' => [25, 50, -10, 15, 18, 32, 27, 14],
        ],
        [
            'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
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


## Model charts

In order to use the methods of obtaining data for charts from the model, you need to add the trait `Chartable`:

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

This will add several new methods specifically for charting:

- Grouped data
- A period of time


### Grouped data

For example, you might want to build a chart showing the proportion of users who have enabled two-factor authentication.

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

Then the model query will serve as a data source `countForGroup()`

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

In order to change the text of headers, you can pass the closure function as the first argument:

```php
User::countForGroup('uses_two_factor_auth')->toChart(static function (bool $title) {
    return $title ? 'Enabled' : 'Disabled';
});
```

### A period of time

Receives data for a certain period of time, filling in the missing values.

For example, let's display a graph of new users and roles:

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

Then the data source will be:

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

By default, the data will be taken for one month; to set your own period, you need to pass the arguments:

```php
$start = Carbon::now()->subDay(7);
$end = Carbon::now()->subDay(1);

User::countByDays($start, $end)->toChart('Users')
```

By default, data is grouped by the `created_at` column, to change it:

```php
$start = Carbon::now()->subDay(7);
$end = Carbon::now()->subDay(1);

User::countByDays($start, $end, 'updated_at')->toChart('Users')
```


> Note. This function is currently available when using SQLite and MySQL with strict mode turned off.
