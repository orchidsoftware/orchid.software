---
title: Пользовательское поле
description: Custom field
---

## Создание нового поля

Orchid предоставляет широкий набор готовых полей, но иногда стандартных решений может быть недостаточно. 
В таких случаях вы можете создать собственное поле, адаптированное под ваши задачи.

Поле в Orchid состоит из PHP-класса, который определяет его логику, и Blade-шаблона, отвечающего за отображение.

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

## Основы использования Stimulus

Orchid использует Stimulus для добавления интерактивности элементам интерфейса.
Этот легковесный фреймворк позволяет связывать JavaScript-логику с HTML через data-атрибуты, что особенно удобно при создании динамических полей.

### Структура контролеера
```html

Рассмотрим пример контроллера из шаблона EmojiPicker:

<script>
    Orchid.register('emoji-picker', class extends Controller {
        static targets = ['name', 'output'];

        connect() {
            console.log("Controller connected to DOM element");
        }

        greet() {
            this.outputTarget.textContent = `Hello, ${this.nameTarget.value}!`;
        }
    });
</script>
```
- Имя контроллера: `emoji-picker` (указывается в `data-controller`).
- **Targets**: Элементы DOM, к которым нужен доступ (ищутся по `data-<controller>-target`).
- Жизненный цикл:
  - `connect()` - вызывается при подключении контроллера к элементу.
  - `disconnect()` - вызывается при удалении элемента из DOM.
- **Методы**: Произвольные функции для обработки событий (например, `greet()`).

### Связь c HMTL
```html
<div data-controller="emoji-picker">
    <input 
        data-emoji-picker-target="name"
        data-action="input->emoji-picker#greet"
    >
    <span data-emoji-picker-target="output"></span>
</div>
```
- **Контроллер:** `data-controller="emoji-picker"` инициализирует контроллер на элементе.
- **Targets:**
  - `data-emoji-picker-target="name"` → доступ через `this.nameTarget`
  - `data-emoji-picker-target="output"` → `this.outputTarget`
- **Действия:**
  - `data-action="input->emoji-picker#greet"` - при событии input вызывать метод greet контроллера.

### Регистрация контроллера

Метод Orchid.register() регистрирует контроллер в приложении:
```js
Orchid.register('controller-name', class extends Controller {
    // Логика контроллера
});
```
### Работа с элементами
- **Одиночный элемент**: `this.<target>Target` (например, this.nameTarget)
- **Все элементы:** `this.<target>Targets` (массив элементов)
- **Query-селекторы:**
  - `this.element` - главный элемент контроллера
  - `this.findElement(selector)` - поиск внутри элемента

### Интеграция сторонних библиотек
Рассмотрим на примере DatePicker:

```js
Orchid.register('date-picker', class extends Controller {
    connect() {
        new DatePicker(this.element, {
            format: 'YYYY-MM-DD'
        });
    }
});
```
```html
<div data-controller="date-picker">
    <input type="text">
</div>
```

[Stimulus](https://stimulus.hotwired.dev/handbook/introduction) позволяет органично интегрировать любые JavaScript-библиотеки, сохраняя код модульным и легко поддерживаемым.


