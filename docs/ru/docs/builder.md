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

Orchid предоставляет широкий набор готовых полей, но иногда стандартных решений может быть недостаточно. 
В таких случаях вы можете создать собственное поле, адаптированное под ваши задачи.

Поле в Orchid состоит из PHP-класса, который определяет его логику, и Blade-шаблона, отвечающего за отображение.
При необходимости можно использовать [Stimulus]((https://stimulus.hotwired.dev/handbook/introduction)), чтобы добавить интерактивное поведение.


Для создания нового поля выполните команду:

```shell
php artisan make:field EmojiPicker
```

В результате будут созданы:  

- **PHP-класс**: `app/Orchid/Fields/EmojiPicker.php`  
- **Blade-шаблон**: `resources/views/orchid/fields/emoji-picker.blade.php`  

Сгенерированные файлы можно изменить под свои нужды: обновить разметку, добавить стили, подключить сторонние библиотеки и настроить взаимодействие с пользователем. Рассмотрим созданный класс:

```php
namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class EmojiPicker extends Field
{
    /**
     * Blade-шаблон, используемый для рендеринга поля.
     */
    protected $view = 'orchid.fields.emoji-picker';

    /**
     * Значения атрибутов по умолчанию.
     */
    protected $attributes = [
        'placeholder' => 'Введите текст...',
        'class'       => 'form-control',
        'type'        => 'text',
    ];

    /**
     * Список атрибутов, которые будут передаваться в HTML-разметку.
     */
    protected $inlineAttributes = [
        'placeholder',
        'value',
        'type',
    ];
}
```

- **`$view`**  - указывает на Blade-шаблон, который будет использоваться для отображения поля. В данном случае, это шаблон `orchid.fields.emoji-picker`. 
- **`$attributes`**  - задает значения атрибутов по умолчанию для поля, такие как `placeholder`, `class` и `type`.
- **`$inlineAttributes`**  - перечислены атрибуты, которые могут быть переданы непосредственно в HTML-элемент.


Поля не нужно регистрировать, вы можете начать использовать их сразу, например:

```php
EmojiPicker::make('reaction')
    ->placeholder('Выберите эмодзи');
```


Рассмотрим ближе сгенерированный `view`:

```html
@component($typeForm, get_defined_vars())
    <div data-controller="emoji-picker">
        <input
            {{
                $attributes->merge([
                    'data-emoji-picker-target' => 'name',
                    'data-action' => 'input->emoji-picker#greet',
                ])
            }}>

        <span data-emoji-picker-target="output"></span>
    </div>
@endcomponent

<script>
    Orchid.register('emoji-picker', class extends Controller {
        static targets = ['name', 'output'];

        connect() {
            console.log("Emoji Picker controller has been connected!");
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
