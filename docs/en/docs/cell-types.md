---
title: Cell Types
description: Discover Orchid's built-in components for effortless data representation. Learn how to format dates with DateTimeSplit, display numbers with Number, represent boolean values with Boolean, and showcase percentage values with Percentage components. Enhance your project's visual appeal and user experience with these powerful tools.
---

## Introduction

When working on your project, you'll often encounter the need to present various data types such as currency, numbers, or dates. Orchid makes this task easier by providing built-in components that handle these common data types, similar to popular spreadsheet software like Microsoft Excel or Apple Numbers.

Orchid's components help you avoid code duplication and allow you to effortlessly format and display your data. **These components can be used for both [table cells](/en/docs/table) (using the `TD` class) and [legends](/en/docs/legend) (using the `Sight` class)**. In this documentation, we will primarily cover the usage of `TD` components.

## DateTimeSplit

The `DateTimeSplit` component is specifically designed to display dates in a two-line format. The top line shows the formatted date, while the bottom line provides additional details such as the day of the week and the time.

To use the `DateTimeSplit` component, you can specify the attribute that contains the date information and include it in your table cell definition:

```php
TD::make('created_at')
    ->usingComponent(DateTimeSplit::class),
```

By default, Orchid provides sensible formatting options for the upper and lower parts of the cell. However, you can also customize these options to match your specific requirements. For example, you can change the format of the date or adjust the timezone:

```php
use Orchid\Screen\Components\Cells\DateTimeSplit;

TD::make('created_at')
    ->usingComponent(DateTimeSplit::class, upperFormat: 'Y-m-d', lowerFormat: 'H:i:s.uP', timeZone: 'Europe/Madrid'),
```

In the above example, we set the `upperFormat` option to `'Y-m-d'` to display the date in the format 'YYYY-MM-DD'. The `lowerFormat` option is set to `'H:i:s.uP'`, which shows the time in the format 'HH:MM:SS.microseconds+timezone'. Feel free to adjust these formats and the `timeZone` option to suit your project's needs.

> **Note:** This documentation assumes familiarity with the PHP [Named Arguments](https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments) feature.

## Number

The `Number` component simplifies the formatting and display of numerical data. It allows you to present numbers in a desired format, such as with thousands separators for improved readability.

To use the `Number` component, specify the attribute containing the numerical value within your table cell definition:

```php
use Orchid\Screen\Components\Cells\Number;

TD::make('value')
    ->usingComponent(Number::class),
```

When the component encounters a large number, it automatically adds thousands separators to enhance readability. For example, the value `100400500.75` will be rendered as `100 400 500,8`.

In addition to the default behavior, you can customize the `Number` component by specifying options such as the number of decimal places, decimal separators, and thousands separators:

```php
TD::make('value')
    ->usingComponent(Number::class, decimals: 1, decimal_separator: ',', thousands_separator: ' '),
```

## Boolean

The `Boolean` component is designed to represent boolean values in a concise and visually clear manner. It allows you to display boolean data with appropriate labels.

Here's an example of using the `Boolean` component:

```php
use Orchid\Screen\Components\Cells\Boolean;

TD::make('value')
    ->usingComponent(Boolean::class),
```

By default, the `Boolean` component will display boolean values as "true" or "false". However, you can easily customize the labels to match the semantics of your data:

```php
TD::make('value')
    ->usingComponent(Boolean::class, true: 'Enabled', false: 'Disabled'),
```

## Percentage

The `Percentage` component simplifies the presentation of values as percentages. It automatically formats the values and adds the percentage symbol for clear visual representation.

To use the `Percentage` component, specify the attribute that contains the numerical value within your table cell definition:

```php
use Orchid\Screen\Components\Cells\Percentage;

TD::make('value')
    ->usingComponent(Percentage::class),
```

The `Percentage` component provides a clear and concise representation of the numeric value as a percentage. You can also customize the component by specifying the number of decimal places to display:

```php
TD::make('value')
    ->usingComponent(Percentage::class, decimals: 2),
```

## Currency

The `Currency` component simplifies the formatting and display of currency values. It ensures consistent formatting and provides options for customization.

To use the `Currency` component, specify the field and use the `usingComponent` method:

```php
use Orchid\Screen\Components\Cells\Currency;

TD::make('value')
    ->usingComponent(Currency::class),
```

The `Currency` component automatically formats the currency value using the appropriate currency symbol and decimal separators. However, you can also customize the formatting by specifying additional options. For example:

```php
TD::make('value')
    ->usingComponent(Currency::class, decimals: 1, decimal_separator: ',', thousands_separator: ' '),
```

If you need to use custom currency symbols, you can specify them using the `before` and `after` options. For example:

```php
TD::make('value')
    ->usingComponent(Currency::class, before: '$', after: '₽'),
```

In this case, the currency value is displayed with a dollar sign before the value and a ruble symbol after the value. Adjust these options to match the currency symbols used in your project.
