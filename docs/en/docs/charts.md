---
title: Charts
description: Build line, bar, mixed, pie, and percentage charts with the Orchid PHP layout API, including model metrics, gradients, and SVG export.
---

Charts display data returned by a screen's `query()` method. Configure them through `Layout::chart()` using PHP; the platform handles rendering with [Orchid Charts](https://charts.orchid.software/docs/getting-started.html). You do not need a custom Blade template or JavaScript controller.

## Creating a Chart

Return shared `labels` and one or more `datasets` from the screen:

```php
public function query(): iterable
{
    return [
        'visits' => [
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'datasets' => [
                ['name' => 'This week', 'values' => [32, 48, 43, 61, 54, 76, 68]],
                ['name' => 'Last week', 'values' => [28, 35, 46, 39, 48, 57, 52]],
            ],
        ],
    ];
}
```

Pass the query key to `Layout::chart()` in the screen's `layout()` method:

```php
use Orchid\Support\Facades\Layout;

public function layout(): iterable
{
    return [
        Layout::chart('visits', 'Weekly visits')
            ->description('Daily visits compared with the previous week.')
            ->height(300)
            ->smooth()
            ->gradient(),
    ];
}
```

The chart title is optional and can also be set with `->title('Weekly visits')`. A separate layout class is optional.

Each dataset's `values` must contain one numeric value for every label, in the same order. Use zero when the value is zero; prepare missing observations before passing the data to the chart. Dataset names identify series in the legend and tooltip.

## Chart Types

The default type is `line`. Choose another type with `->type('bar')`:

| Type | Use |
| --- | --- |
| `line` | Trends across an ordered sequence |
| `bar` | Comparing categories or series |
| `mixed` | Combining series with different rendering types |
| `pie` | Showing parts of a whole |
| `percentage` | Showing proportions in a horizontal strip |

The corresponding constants are available on `Orchid\Screen\Layouts\Chart`: `TYPE_LINE`, `TYPE_BAR`, `TYPE_MIXED`, `TYPE_PIE`, and `TYPE_PERCENTAGE`.

### Pie and Percentage Charts

These types require exactly one dataset. Labels name the slices or segments:

```php
public function query(): iterable
{
    return [
        'traffic' => [
            'labels' => ['Search', 'Direct', 'Referral'],
            'datasets' => [
                ['values' => [58, 27, 15]],
            ],
        ],
    ];
}

public function layout(): iterable
{
    return [
        Layout::chart('traffic', 'Traffic sources')->type('pie')->height(280),
        Layout::chart('traffic', 'Traffic share')->type('percentage')->height(88),
    ];
}
```

Use non-negative values for proportions. Aggregate your data explicitly if several series contribute to the same total; the layout does not sum multiple datasets for you.

### Mixed Charts

Set `chartType` on each dataset. For example, compare actual values as bars with a plan as a line:

```php
public function query(): iterable
{
    return [
        'sales' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr'],
            'datasets' => [
                ['name' => 'Actual', 'chartType' => 'bar', 'values' => [42, 48, 57, 63]],
                ['name' => 'Plan', 'chartType' => 'line', 'values' => [45, 50, 55, 65], 'smooth' => true],
            ],
        ],
    ];
}

public function layout(): iterable
{
    return [
        Layout::chart('sales', 'Sales against plan')->type('mixed')->height(300),
    ];
}
```

## Basic Configuration

Configure common presentation settings through fluent methods:

```php
Layout::chart('visits', 'Weekly visits')
    ->height(300)
    ->colors(['#2563eb', '#94a3b8'])
    ->legend(false)
    ->export();
```

`height()` sets the canvas height in pixels; the default is 250. The platform reserves this height before rendering. `colors()` sets the chart palette. `export()` adds a button to download the chart as SVG; it is disabled by default.

### Lines and Gradients

Use `smooth()` for curved lines, `dots()` for visible data points, and `gradient()` for a fading area fill:

```php
Layout::chart('visits')
    ->smooth()
    ->dots(false)
    ->gradient(['fromOpacity' => 0.2, 'toOpacity' => 0]);
```

Call `gradient()` without arguments to use the package defaults, or `gradient(false)` to disable it. Line-specific settings belong on individual line datasets when using a mixed chart, as shown above.

### Bars and Slice Limits

Use `stacked()` for a bar chart and `maxSlices()` to limit the displayed slices in pie or percentage charts:

```php
Layout::chart('visits')->type('bar')->stacked();

Layout::chart('traffic')->type('pie')->maxSlices(5);
```

### Adding Markers

Add a reference value to a line, bar, or mixed chart with `marker()`:

```php
Layout::chart('visits')
    ->marker('Target', 60, ['lineStyle' => 'dashed']);
```

Call the method more than once to add several markers.

### Additional Options

Use `options()` for native Orchid Charts options without a dedicated PHP method:

```php
Layout::chart('visits')
    ->type('bar')
    ->options(['horizontal' => true, 'radius' => 4]);
```

Options are merged with earlier settings; the last value for the same option wins. Options must be supported by the selected chart type. For example, `smooth` belongs to line charts and `stacked` belongs to bar charts. Unsupported option names raise an `InvalidArgumentException` when the layout is built.

The PHP layout supports the five chart types listed above. Consult the [Orchid Charts API reference](https://charts.orchid.software/docs/api-reference.html) for option values, using only options supported by the platform layout. PHP configuration is serialized as JSON, so JavaScript callbacks cannot be passed through `options()`.

## Eloquent Model

Add the `Chartable` trait to models whose data you want to aggregate:

```php
namespace App\Models;

use Orchid\Metrics\Chartable;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    use Chartable;
}
```

Import your application's models in the screen. Both grouped and time-based collections return a complete `labels` / `datasets` structure from `toChart()`; assign it directly to a query key.

### Grouped Data

For a model with a `uses_two_factor_auth` column, group users by that value and format the labels:

```php
public function query(): iterable
{
    return [
        'authentication' => User::countForGroup('uses_two_factor_auth')
            ->toChart(fn (string $value) => $value === '1' ? 'Enabled' : 'Disabled'),
    ];
}

public function layout(): iterable
{
    return [
        Layout::chart('authentication', 'Two-factor authentication')->type('pie'),
    ];
}
```

The optional closure formats each group label, not the chart title.

### Working with Time Periods

`countByDays()` groups records by day and fills days without records with zero:

```php
public function query(): iterable
{
    return [
        'members' => User::countByDays()->toChart('New users'),
    ];
}

public function layout(): iterable
{
    return [
        Layout::chart('members', 'New members')->height(300)->gradient(),
    ];
}
```

The default period runs from one month ago to today. Pass a start date, end date, and optional date column to customize it:

```php
$start = now()->subDays(6)->startOfDay();
$end = now()->endOfDay();

User::countByDays($start, $end, 'updated_at')->toChart('Updated users');
```

The default date column is the model's creation timestamp, normally `created_at`.

### Combining Time Series

For multiple series, query the same period and share its labels. Both models in this example must use `Chartable`:

```php
public function query(): iterable
{
    $start = now()->subDays(6)->startOfDay();
    $end = now()->endOfDay();
    $users = User::countByDays($start, $end);
    $roles = Role::countByDays($start, $end);

    return [
        'members' => [
            'labels' => $users->pluck('label')->all(),
            'datasets' => [
                ['name' => 'Users', 'values' => $users->pluck('value')->all()],
                ['name' => 'Roles', 'values' => $roles->pluck('value')->all()],
            ],
        ],
    ];
}
```

Keep labels and their order identical across series. Do not remove zero-value days from just one series, as that would misalign the values.

### Value Query Types

Other aggregate methods accept the value column followed by the optional start date, end date, and date column:

```php
Order::averageByDays('price')->toChart('Average order value');
Order::sumByDays('price')->toChart('Revenue');
Order::minByDays('price')->toChart('Smallest order');
Order::maxByDays('price')->toChart('Largest order');
```

The `Order` model must also use `Chartable`.

## Reusable Chart Classes

If several screens share a configuration, generate a layout in `app/Orchid/Layouts`:

```shell
php artisan orchid:chart VisitsChart
```

Configure the generated class through fluent methods in its constructor:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class VisitsChart extends Chart
{
    public function __construct()
    {
        $this->type(self::TYPE_LINE)->height(300)->smooth()->gradient()->export();
    }
}
```

Pass the query key and optional title when using it in a screen:

```php
use App\Orchid\Layouts\VisitsChart;

public function layout(): iterable
{
    return [
        VisitsChart::make('visits', 'Weekly visits'),
    ];
}
```

## Updating Existing Charts

When moving from the Frappe-based layout:

- Move labels from individual datasets to a shared `labels` array beside `datasets`.
- Assign `toChart()` results directly to a query key. Do not wrap them in another dataset array. For multiple time series, use the shared-label structure above.
- Replace properties such as `$height` and `$colors`, and the old `markers()` override, with fluent method calls. The updated base class has typed properties; old untyped property overrides are incompatible.
- Replace Frappe-specific settings such as `lineOptions`, `barOptions`, and `valuesOverPoints` with the supported native options. There is no compatibility adapter for old option names.
- Replace `axis-mixed` / `TYPE_AXIS_MIXED` with `mixed` / `TYPE_MIXED`, retaining `chartType` on each mixed dataset.
- Provide exactly one dataset for pie and percentage charts.
