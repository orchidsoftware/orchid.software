---
title: Form builder
description: Laravel form builder
---


Describing form fields can be a naughty and challenging exercise to easily modify and reuse, using a unique `Orchid\Screen\Builder` builder whose task is to generate an `HTML` code.

## Main use

The form feature set and data source must be passed to build:

```php
use Orchid\Screen\Builder;
use Orchid\Screen\Fields\Input;

$builder = new Builder([
    Input::make('name'),
]);

$html = $builder->generateForm();
```


## Data binding

To specify the value of an element, you must specify the data in the source.
The specified key will automatically replace the data.

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

It is also possible to enter deep into the object using `dot`-notation.

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

You can also specify the desired language and prefix, for example:

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


## Representation of elements of a form

Any input field is only a setting above the view that passes data to the template.

Create a new class to see what it consists of:

```php
namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class CustomField extends Field
{
    /**
     * Blade template
     * 
     * @var string
     */
    protected $view = '';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [];
}
```

The `view` property is determined by the blade.
`attributes` lists default values, and `inlineAttributes`
define keys in html format, for example:


```html
First name: <input type="text" name="name"><br>
```

In this example, the inline attribute is type and name specified directly in the tag.
And the `make()` method is only for quick and convenient initialization,
since any form that should add or modify data must possess it.

We only update that the created class and add the blade template, using the example above:

```php
{{ $title }}: <input {{ $attributes }}><br>
```

In order to try a new field, you must use the built-in `render()` method:

```php
$input = CustomField::make('name');
    
$html = $input->render(); // html string
```

The `html` variable will contain the template just specified, try adding some elements:

```php
$input = CustomField::make('name')
    ->title('How your name?')
    ->placeholder('Sheldon Cooper')
    ->value('Alexandr Chernyaev');

$html = $input->render();
```

After we refresh the page, a new title is displayed on it,
instead of the default, but neither placeholder nor value was applied.
It is because they were not specified in the `inlineAttributes`, fix this:

```php
/**
 * Attributes available for a particular tag.
 *
 * @var array
 */
protected $inlineAttributes = [
    'name',
    'type',
    'placeholder',
    'value'
];
```

After that, each attribute will be drawn in our template.
