---
title: Use JavaScript
description: Stimulus JS usage example with Laravel Orchid package
extends: _layouts.documentation.en
section: main
---

The basis of the platform in terms of styles is [Bootstrap](http://getbootstrap.com/), and the browser executes the code [Stimulus](https://stimulusjs.org/), you do not need to use them.

Let's build a basic example that displays the text entered in the field for this:

In `resources/js`, create the following structure:

```php
resources
├── js
│   ├── controllers
│   │   └── hello.js
│   └── dashboard.js
├── lang
├── sass
└── views
```

Controller class with the following content:

```php
// hello.js
export default class extends window.Controller {

    static get targets() {
        return [ "name", "output" ]
    }

    greet() {
        this.outputTarget.textContent =
            `Hello, ${this.nameTarget.value}!`
    }
}
```

And the assembly point:

```php
// dashboard.js
import HelloController from "./controllers/hello"

application.register("hello", HelloController);
```

Such a structure will not prevent your application, no matter what kind of front-end to build: Angular/React/Vue, etc.

It remains only to describe the assembly in webpack.mix.js:

```php
mix.js('resources/js/dashboard.js', 'public/js')
```

It remains only to connect the received script to the panel in the configuration file or in the service provider using the `registerResource` method. You can do the same with style sheets, which will allow you to effectively build application logic.

```php
class ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        $dashboard->registerResource('scripts','dashboard.js');
        //$dashboard->registerResource('stylesheets','dashboard.css');
    }
}
```

To display, use the template:

```php
// hello.blade.php
<div data-controller="hello">
  <input data-target="hello.name" type="text">

  <button data-action="click->hello#greet">
    Greet
  </button>

  <span data-target="hello.output">
  </span>
</div>
```
