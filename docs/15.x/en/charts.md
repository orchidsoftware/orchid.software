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

## Display a chart

```php
use Orchid\Screen\Layouts\Chart;

public function layout(): iterable
{
    return [Chart::make('visits', 'Visits')];
}
```

The chart displays both datasets using the shared labels. Charts use the line type and a height of 250 by default.
You can also create a chart through the [Layout facade](/en/docs/layouts#using-the-layout-facade):
`Layout::chart('visits', 'Visits')`.

## Configure presentation

```php
Chart::make('visits', 'Visits')
    ->description('Daily traffic')
    ->height(300)
    ->colors(['#2274a5', '#f75c03'])
    ->smooth()
    ->dots(false)
    ->gradient(['fromOpacity' => 0.25, 'toOpacity' => 0])
    ->marker('Target', 20)
    ->export();
```

Merge supported options with `options()`:

```php
Chart::make('visits')->type(Chart::TYPE_BAR)
    ->stacked()
    ->legend(false)
    ->options(['horizontal' => true, 'radius' => 3]);
```

Supported chart types are `Chart::TYPE_LINE`, `TYPE_BAR`, `TYPE_MIXED`, `TYPE_PIE`, and `TYPE_PERCENTAGE`.
Pie and percentage charts require exactly one dataset.

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
Chart::make('sales')->type(Chart::TYPE_MIXED);
```

## Use model metrics

Models with `Orchid\Metrics\Chartable` provide `countByDays()`, `sumByDays()`, `averageByDays()`,
`minByDays()`, `maxByDays()`, `valuesByDays()`, and `countForGroup()` scopes.
The `Orchid\Platform\Models\User` model includes this trait.

```php
use Orchid\Platform\Models\User;

return [
    'users' => User::countByDays()->toChart('Users'),
    'names' => User::countForGroup('name')->toChart(),
];

// In layout():
Chart::make('users')->type(Chart::TYPE_LINE);
Chart::make('names')->type(Chart::TYPE_PIE);
```

`toChart()` returns the complete `labels` and `datasets` structure.

The date scopes accept a start date, end date, and date column. Aggregate scopes take the value column first:

```php
User::countByDays(now()->subDays(6)->startOfDay(), now(), 'created_at')->toChart('Users');
Order::sumByDays('total', now()->subDays(6)->startOfDay(), now(), 'paid_at')->toChart('Revenue');
```

The example's Order model must use `Orchid\Metrics\Chartable` and have `total` and `paid_at` columns.
`valuesByDays()` reads stored values; the other scopes aggregate records by day.

## Supported options

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
