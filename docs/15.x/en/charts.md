---
title: Charts
description: Display Orchid Charts with shared labels, datasets, and fluent layout options.
---

Chart layouts use Orchid Charts. Provide a shared label list and one or more datasets, then configure the layout
through its fluent methods.

## Prepare the data

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

Every dataset's `values` must have exactly as many items as `labels`. Numeric strings are converted to numbers.
Orchid reindexes the arrays before sending them to the browser.

## Display a chart

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

`Layout::chart()` creates a chart without a custom class. `Chart::make('visits', 'Visits')` is also available.
The default type is `line`, and the default height is 250.

Supported types are `Chart::TYPE_LINE`, `TYPE_BAR`, `TYPE_MIXED`, `TYPE_PIE`, and `TYPE_PERCENTAGE`.
Pie and percentage charts require exactly one dataset.

## Configure presentation

Merge supported options with `options()`:

```php
Layout::chart('visits')->type(Chart::TYPE_BAR)
    ->stacked()
    ->legend(false)
    ->options(['horizontal' => true, 'radius' => 3]);
```

| Type | Supported options |
| --- | --- |
| All | `height`, `width`, `colors`, `legend`, `tooltip` |
| Line, bar, mixed | `axes`, `grid`, `valueLabels`, `frameless` |
| Line | `smooth`, `dots`, `dotSize`, `line`, `area`, `gradient`, `strokeWidth` |
| Bar | `stacked`, `horizontal`, `radius` |
| Mixed | `gradient` |
| Pie | `maxSlices`, `startAngle`, `padAngle` |
| Percentage | `maxSlices` |

Dimension, radius, angle, and slice-count values must be finite numbers. `colors` must be a list.
Other options are booleans, except `gradient`, which accepts a boolean or an opacity map.
Gradient keys are `fromOpacity` and `toOpacity`, with numeric values between 0 and 1.
Unsupported options and invalid types throw `InvalidArgumentException`.

`marker($label, $value, $options)` adds a marker. `export()` displays the chart download control.
Options merge with earlier settings, and the last value for a key wins.

## Combine chart types

Use `chartType` on each dataset in a mixed chart:

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

## Use model metrics

Models with `Orchid\Metrics\Chartable` provide `countByDays()`, `sumByDays()`, `averageByDays()`,
`minByDays()`, `maxByDays()`, `valuesByDays()`, and `countForGroup()` scopes.
The User model already includes this trait.

```php
return [
    'users' => User::countByDays()->toChart('Users'),
    'names' => User::countForGroup('name')->toChart(),
];

// In layout():
Layout::chart('users')->type(Chart::TYPE_LINE);
Layout::chart('names')->type(Chart::TYPE_PIE);
```

`toChart()` returns the complete `labels` and `datasets` structure. Do not wrap it in the old outer dataset array.

The date scopes accept a start date, end date, and date column. Aggregate scopes take the value column first:

```php
User::countByDays(now()->subDays(6)->startOfDay(), now(), 'created_at')->toChart('Users');
Order::sumByDays('total', now()->subDays(6)->startOfDay(), now(), 'paid_at')->toChart('Revenue');
```

The example's Order model must use `Orchid\Metrics\Chartable` and have `total` and `paid_at` columns.
`valuesByDays()` reads stored values; the other scopes aggregate records by day.

## Define charts directly

The `orchid:chart` generator is removed. Return a configured chart from the screen's `layout()` method:

```php
use Orchid\Screen\Layouts\Chart;

Chart::make('visits', 'Visits')
    ->type(Chart::TYPE_BAR)
    ->export();
```

For shared definitions, an ordinary factory may return this configured object.
Existing Chart subclasses remain supported; configure them through methods rather than redefining typed properties.

## Upgrade from Frappe Charts

Replace per-dataset `labels` with a shared top-level `labels` array and put series in `datasets`.
Move old presentation properties to fluent methods or supported `options()` keys.
Frappe-specific options and client-side APIs are not supported. Publish the new assets after upgrading.
