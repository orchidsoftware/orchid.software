---
title: Charts
description: Learn how to easily create and customize charts in your Laravel Orchid project with our comprehensive documentation on Charts. Explore options for pie charts, line graphs, bar charts and more, all within the powerful Orchid platform.
---



Chart layout may be generated using the `orchid:chart` Artisan command. 
By default, all new metrics will be placed in the `app/Orchid/Layouts` directory:

```php
php artisan orchid:chart ChartsLayout
```

Once your chart class has been generated, you're ready to customize it. Example:


```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class ChartsLayout extends Chart
{
    /**
     * Available options:
     * 'bar', 'line', 
     * 'pie', 'percentage'
     *
     * @var string
     */
    protected $type = 'bar';
}
```

By creating and setting up a visual representation of the class, we can use it in the future. But before using chart, we need to prepare the data we want to display. To do this, let's set the `query` value of the screen:


```php
public function query() : array
{
    $dataset = [
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
        'dataset' => $dataset,
    ];
}
```

Now we can use the layout class by calling the static method `make` and specifying the target key for the data:

```php
use App\Orchid\Layouts\ChartsLayout;

public function layout(): iterable
{
    return [
        ChartsLayout::make('dataset', 'Header for our dataset'),
    ];
}
```

Often datasets need a little explanation, we can add a description for that:

```php
use App\Orchid\Layouts\ChartsLayout;

public function layout(): iterable
{
    return [
        ChartsLayout::make('dataset', 'Header for our dataset'),
            ->description('Description of the chart')
    ];
}
```



## Basic Configuration

The configuration is used to change how the chart behaves. There are properties to control styling, height, etc.

### Adjusting Height

Set the height of the chart in pixels by specifying the property:

```php
/**
 * Height of the chart.
 *
 * @var int
 */
protected $height = 250;
```


### Customizing Colors

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


### Exporting Images

Charts can be exported in the `SVG` format, in which they are displayed initially. To do this, specify the property:

```php
/**
 * Determines whether to display the export button.
 *
 * @var bool
 */
protected $export = true;
```

### Adding Markers

Some graphs are difficult to interpret without more information. For example, show the average value. For this you can define the `markers` method: 

```php
/**
 * To highlight certain values on the Y axis, markers can be set.
 * They will show as dashed lines on the graph.
 */
protected function markers(): ?array
{
    return [
        [
            'label'   => 'Medium',
            'value'   => 40,
        ],
    ];
}
```



## Eloquent Model

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


## Grouped Data

For example, you might want to build a chart showing the proportion of users who have enabled two-factor authentication.

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class BasicPieChart extends Chart
{
    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'pie';
}
```

Then the model query will serve as a data source `countForGroup()`

```php
public function query(): array
{
    $userUsageTwoFactorAuth = User::countForGroup('uses_two_factor_auth')->toChart();

    return [
        'userUsageTwoFactorAuth' => $userUsageTwoFactorAuth,
    ];
}

public function layout(): array
{
    return [
        BasicPieChart::make('userUsageTwoFactorAuth', 'Usage two-factor authentication'),
    ];
}
```

In order to change the text of headers, you can pass the closure function as the first argument:

```php
User::countForGroup('uses_two_factor_auth')
    ->toChart(fn(bool $value) => $value ? 'Enabled' : 'Disabled'),
```

## Working with Time Periods

Receives data for a certain period of time, filling in the missing values.

For example, let's display a graph of new users and roles:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class BasicLineChart extends Chart
{   
    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'line';
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
        BasicLineChart::make('members', 'New members'),
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


### Value Query Types

Value metrics don't just ship with a `countByDays` method. You may also use a variety of other aggregate functions when building your metric.


The `average` method may be used to calculate the average of a given column

```php
Order::averageByDays('price')->toChart('Order'),
```

The `sum` method may be used to calculate the sum of a given column:

```php
Order::sumByDays('price')->toChart('Order'),
```

The `min` method may be used to calculate the min of a given column:

```php
Order::minByDays('price')->toChart('Order'),
```

The `max` method may be used to calculate the max of a given column:

```php
Order::maxByDays('price')->toChart('Order'),
```
