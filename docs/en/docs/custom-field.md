---
title: Custom Fields
description: Creating your own custom input field in the Orchid admin panel
---

## Creating a New Field

Orchid provides a rich set of built-in form fields, but sometimes those aren't enough for specific use cases.
In such cases, you can create a custom field tailored to your needs.

A field in Orchid consists of two main parts:

- A **PHP class** that handles its logic
- A **Blade view** that renders its appearance

To generate a new field, use the Artisan command:

```shell
php artisan make:field EmojiPicker
```

This will create the following files:

- **PHP Class**: `app/Orchid/Fields/EmojiPicker.php`
- **Blade Template**: `resources/views/orchid/fields/emoji-picker.blade.php`

You can modify these files as needed—update the HTML markup, apply styles, include external libraries, and define user
interactions. Here’s a look at the generated class:

```php
namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class EmojiPicker extends Field
{
    /**
     * The Blade template used for rendering the field.
     */
    protected $view = 'orchid.fields.emoji-picker';

    /**
     * Default attribute values.
     */
    protected $attributes = [
        'placeholder' => 'Enter text...',
        'class'       => 'form-control',
        'type'        => 'text',
    ];

    /**
     * List of attributes that will be passed into the HTML markup.
     */
    protected $inlineAttributes = [
        'placeholder',
        'value',
        'type',
    ];
}
```

- **`$view`**: Points to the Blade template that will be used for rendering the field. In this case, it's
  `orchid.fields.emoji-picker`.
- **`$attributes`**: Defines default values like `placeholder`, `class`, and `type`.
- **`$inlineAttributes`**: Lists the attributes that should be rendered as inline HTML attributes.

You don't need to manually register your custom field—it’s immediately usable. For example:

```php
EmojiPicker::make('reaction')
    ->placeholder('Pick an emoji');
```

### Blade Template (`view`)

Let's examine the generated Blade template:

```html
@component($typeForm, get_defined_vars())
<div data-controller="emoji-picker">
    <input {{
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
            this.outputTarget.textContent = `Hello, ${this.nameTarget.value}!`;
        }
    });
</script>
```

Inside the `<script>` block, a [Stimulus](https://stimulus.hotwired.dev/handbook/introduction) controller is created and
registered on the fly using `Orchid.register()`.
This controller is attached to the HTML via the `data-controller` attribute. You can leverage the full power of Stimulus
to make your field interactive.

---

## Stimulus Basics

Orchid uses Stimulus to add interactivity to UI components.
This lightweight JavaScript framework connects logic to HTML via data attributes, making it especially suitable for
dynamic form fields.

### Controller Structure

Here’s a simplified view of the `EmojiPicker` controller:

```html
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

- **Controller Name:** Defined in `data-controller`, e.g., `emoji-picker`
- **Targets:** HTML elements accessible via `data-<controller>-target`
- **Lifecycle Methods:**

    - `connect()` is called when the controller is attached to the DOM
    - `disconnect()` is triggered when it’s removed

- **Methods:** Custom functions for handling events (like `greet()`)

### Connecting to HTML

```html
<div data-controller="emoji-picker">
    <input
        data-emoji-picker-target="name"
        data-action="input->emoji-picker#greet"
    >
    <span data-emoji-picker-target="output"></span>
</div>
```

- **`data-controller="emoji-picker"`** initializes the controller.
- **Targets:**
    - `data-emoji-picker-target="name"` → accessed via `this.nameTarget`
    - `data-emoji-picker-target="output"` → accessed via `this.outputTarget`
- **Actions:**
    - `data-action="input->emoji-picker#greet"` triggers `greet()` on `input` events.

### Registering a Controller

Use `Orchid.register()` to define and register a controller:

```js
Orchid.register('controller-name', class extends Controller {
    // Controller logic here
});
```

### Working with Elements

- **Single element**: `this.<target>Target` (e.g., `this.nameTarget`)
- **Multiple elements**: `this.<target>Targets` (array)
- **DOM Queries:**

    - `this.element` — the main controller element
    - `this.findElement(selector)` — find elements within the controller's scope

---

## Integrating Third-Party Libraries

> Note: You may need to compile assets using Vite. For more, refer to
> the [JavaScript documentation](/ru/docs/javascript/).

Example: integrating a DatePicker

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

[Stimulus](https://stimulus.hotwired.dev/handbook/introduction) makes it easy to integrate JavaScript libraries into
your custom fields, keeping your code modular and maintainable.
