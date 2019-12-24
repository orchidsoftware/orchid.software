---
title: Строитель форм
description: Laravel form builder
extends: _layouts.documentation.ru
section: main
---

Описывать поля формы может быть нудным и затруднительным занятием, что бы их можно было легко модифицировать и использовать повторно, используется специальный строитель `Orchid\Screen\Builder`, задача которого в генерации `html`-кода.


## Основное использование

Для построения необходимо передать набор элементов формы и источник данных:

```php
use Orchid\Screen\Builder;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;

$fields = [
    Input::make('name'),
];

$repository = new Repository();

$builder = new Builder($fields, $repository);

$html = $builder->generateForm();
```


## Привязка данных

Для указания значения элемента формы, необходимо указать данные в источнике:

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


По сути строитель соотносит имена из хранилища к необходимой формы в качестве значения. 
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


## Представление элементов формы

Любое поле для ввода является только настройкой над представлением которые передает данные в шаблон. 

Создадим новый класс, что бы посмотреть из чего он состоит:

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

    /**
     * @param string|null $name
     *
     * @return self
     */
    public static function make(string $name = null): self
    {
        return (new static())->name($name);
    }
}
```

Свойство `view` определяет blade шаблон которому будут переданы данные,
в `attributes` перечисляются значения по умолчанию, а `inlineAttributes`
определяет ключи необходимые для указания в формате html, например:

```html
First name: <input type="text" name="name"><br>
```


В этом примере inline-атрибут является type и name указанный непосредственно в теге.
А метод `make()` только для быстрой и удобной инициализации, 
так как любая форма которая должна добавлять или изменять данные должна ею обладать.

Обновим только, что созданный класс и добавим blade шаблон, на примере указанном выше:

```php
{{ $title }}: <input @attributes($attributes)><br>
```

Для того, что бы попробовать новое поле, необходимо использовать встроенный метод `render()`:

```php
$input = CustomField::make('name');
    
$html = $input->render(); // html string
```

В переменной `html` будет только что указанный шаблон, попробуем добавить некоторые элементы:

```php
$input = CustomField::make('name')
    ->title('How your name?')
    ->placeholder('Sheldon Cooper')
    ->value('Alexandr Chernyaev');

$html = $input->render();
```

После обновим страницу, на ней отображается новый заголовок, 
вместо указанного по умолчанию, но ни placeholder, ни значение не было применено. 
Это потому, что они не были указана в `inlineAttributes`, исправим это:

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

После этого каждый атрибут будет отрисован в нашем шаблоне.
