---
title: Form Builder
description: Learn how to use the Laravel Orchid form builder to easily create and customize forms for your administration-style application. Improve the user experience and streamline data entry with this powerful tool.
---

## Introduction

Describing form fields can be a challenging task, but with `Orchid\Screen\Builder`, you can easily modify and reuse form fields using a single builder that generates `HTML` code.

To build a form, you need to provide the field definitions and possibly a data source:

```php
use Orchid\Screen\Builder;
use Orchid\Screen\Fields\Input;

// Initialize the form builder with the field definitions
$builder = new Builder([
    Input::make('name'),
]);

// Generate HTML code for the form
$html = $builder->generateForm();
```


## Data Binding

To specify the value of an element, you must specify the data source. 
By providing the specified key, the data will automatically replace the corresponding field.

For example:

```php
use Orchid\Screen\Builder;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;

$fields = [
    Input::make('name'),
];

$repository = new Repository([
    'name' => 'Alexandr Chernyaev',
]);

$builder = new Builder($fields, $repository);

$html = $builder->generateForm();
```

It is also possible to access nested objects using `dot`-notation.

```php
$fields = [
    Input::make('name.ru'),
];

$repository = new Repository([
    'name' => [
        'en' => 'Alexandr Chernyaev',
        'ru' => 'Александр Черняев',
    ],
]);

$builder = new Builder($fields, $repository);

$html = $builder->generateForm();
```

You can also set the desired language and prefix using the `setLanguage` method:

```php
$fields = [
    Input::make('name'),
];

$repository = new Repository([
    'en' => [
        'name' => 'Alexandr Chernyaev',
    ],
    'ru' => [
        'name' => 'Александр Черняев',
    ]
]);

$builder = new Builder($fields, $repository);
$builder->setLanguage('en');

$html = $builder->generateForm();
```
