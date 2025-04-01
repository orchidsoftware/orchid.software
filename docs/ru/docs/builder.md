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

## Создание нового поля

Можно сгенерировать каркас для нового поле. Он представляет собой класс, наследуемый от `Orchid\Screen\Field`, а также blade шаблон,
содержащий в себе пустой input, к которому подключен Stimulus-контроллер. Вы можете полностью менять 
разметку и контроллер под свои задачи, подключать сторонние библиотеки и 
[использовать возможности Stimulus](https://stimulus.hotwired.dev/handbook/introduction) при создании и настройке своего поля.

Для создания поля используется команда: 
```
php artisan make:field ExampleField
```
Давайте рассмотрим класс, который сгенерирует команда: 
```php
namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class ExampleField extends Field
{
    /**
     * The Blade view used to render the field.
     *
     * @var string
     */
    protected $view = 'orchid.fields.example-field';

    /**
     * Default attributes for the field.
     *
     * @var array
     */
    protected $attributes = [
        'placeholder' => 'Enter text...',
        'class'       => 'form-control',
        'type'        => 'text',
    ];

    /**
     * List of attributes available for the HTML tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'placeholder',
        'value',
        'type',
    ];
}

```
Свойство `view` определяет blade шаблон, которому будут переданы данные,
в `attributes` перечисляются значения по умолчанию, а `inlineAttributes`
определяет ключи, необходимые для указания в формате html, например:

```html
<input type="text" name="name">
```
Вот может выглядеть вызов inline-аттрибутов при использовании поля: 
```php
ExampleField::make('test')
    ->placeholder('Hello, world!')
    ->value('Hello, world!');
```

Рассмотрим ближе сгенерированный `view`:
```html
@component($typeForm, get_defined_vars())
    <div data-controller="example-field">
        <input
            {{
                $attributes->merge([
                    'data-example-field-target' => 'name',
                    'data-action' => 'input->example-field#greet',
                ])
            }}>

        <span data-example-field-target="output"></span>
    </div>
@endcomponent

<script>
    Orchid.register('example-field', class extends Controller {
        static targets = ['name', 'output'];

        connect() {
            console.log("MyInput controller has been connected!");
        }

        greet() {
            this.outputTarget.textContent =
                `Hello, ${this.nameTarget.value}!`;
        }
    });
</script>
```

Внутри блока `script` создается и сразу же регистрируется в приложении, без необходимости создания
отдельного файла, [Stimulus](https://stimulus.hotwired.dev/handbook/introduction)-контроллер, он подключается к `html`
с помощью аттрибута `data-controller`. Вы можете использовать все возможности Stimulus для создания своего поля.
