---
title: Строитель форм
description: Laravel form builder
---

Описывать поля формы может быть нудным и затруднительным занятием, чтобы их легко модифицировать и использовать повторно, используется специальный строитель `Orchid\Screen\Builder`, задача которого состоит в генерации `html`-кода.

## Основное использование

Для построения необходимо передать набор элементов формы и источник данных:

```php
use Orchid\Screen\Builder;
use Orchid\Screen\Fields\Input;

$builder = new Builder([
    Input::make('name'),
]);

$html = $builder->generateForm();
```

## Привязка данных

Для указания значения элемента, необходимо указать данные в источнике.
Данные будут автоматически подставлены, по указанному ключу.

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

При этом имеет возможность входить вглубь объекта используя `dot`-нотацию.

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

Так же можно указывать требуемый язык и префикс, например:

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
