---
title: Use JavaScript
description: Learn how to use JavaScript with Laravel Orchid to enhance the functionality and interactivity of your administration-style applications. Get tips on incorporating JavaScript libraries and custom scripts, and find out how to debug and optimize your code.
---

The aesthetic and functional foundation of Orchid is built upon [Bootstrap](http://getbootstrap.com/) for CSS and [Hotwired](https://hotwired.dev) for JavaScript functionality. While Orchid allows the integration of additional libraries to meet your project's needs, we recommend utilizing these core technologies to leverage the full potential of Orchid's features.

> **Note**: Orchid includes a raw Bootstrap stylesheet, which means you have the full spectrum of Bootstrap's styles at your disposal.


## Working With Vite

Laravel comes with the powerful front-end build tool called Vite by default. To harness the full potential of this tool, make sure Vite is installed and configured correctly. You can find installation and configuration instructions in the official [documentation page](https://laravel.com/docs/vite).

To successfully incorporate the acquired resources into your project, you'll need to specify them in the `config/platform.php` file. This file allows you to define a list of resources that should be included in your project. Here's an example of such configuration:

```php
'vite' => [
    'resources/js/app.js',
],
```

This entry is equivalent to using the Blade directive `@vite`. By carefully following these steps, you can effectively integrate Vite into your Laravel project and achieve the best results from its usage.


## Loading Your Scripts And Styles

Laravel Orchid facilitates efficient delivery of your stylesheets and scripts by allowing the use of any `<link>` or `<script>` tags. To set up the URLs for your resources, you'll need to modify the platform.php file in your Laravel application.

Open your `config/platform.php` file and look for the `resource` key. Here, you can specify the URLs for your stylesheets and scripts that are hosted on a CDN or public url. The configuration should resemble the following structure:

```php
'resource' => [
    'stylesheets' => [
        // Add your URLs for stylesheets here
        'https://cdn.example.com/styles/main.css',
    ],
    'scripts' => [
        // Add your URLs for scripts here
        'https://cdn.example.com/scripts/app.js',
    ],
],
```

In this array, replace the placeholder URLs with the actual URLs where your stylesheet and script files are located. This way, whenever Laravel Orchid needs to load these resources, it will automatically use the URLs provided in this configuration.

To verify that the URLs is being used correctly, you can inspect the page source of your application in the browser. Look for the `link` tags for stylesheets and `script` tags for JavaScript files and ensure that the URLs match those specified in your configuration file.


## Turbo

Orchid's seamless administrative panel experience is powered by [Turbo](https://turbo.hotwire.dev). With Turbo, we replicate the dynamics of a Single Page Application (SPA), where resources are loaded once during the initial request. This approach minimizes page load time, resulting in content being updated within the browser in real time. The transition between pages is replaced by a swift, in-browser content refresh, which substantially improves interaction, making it smoother and more engaging for users.

Since all resources will be loaded on the first call, classic calls like this will not work:

```js
document.addEventListener("load", () => {
    console.log('Page load');
});
```

It will be executed only once and will not be called again during transitions. To avoid this, you need to use Turbo events:

```js
document.addEventListener("turbo:load", () => {
    console.log('Page load');
})
```

You can find more details on the website [turbo.hotwire.dev](https://turbo.hotwire.dev).


## Stimulus

[Stimulus](https://stimulus.hotwired.dev/) is a JavaScript framework from the Ruby on Rails developers. It equips frontend development using new approaches to JavaScript, while it does not seek to control all your actions and does not impose a separation of frontend from backend.

Let's build a basic example for that displays the text entered the field for this:

In `resources/js`, create the following structure:

```php
resources
├── js
│   ├── controllers
│   │   └── hello.js
│   └── dashboard.js
└── views
```

Controller class with the following content:

```javascript
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

```javascript
// dashboard.js
import HelloController from "./controllers/hello"

application.register("hello", HelloController);
```

> Note: Such a structure will not prevent your application, no matter what kind of front-end to build: Angular/React/Vue, etc.

### Compilation with Mix

It remains only to describe the assembly in `webpack.mix.js`:

```javascript
let mix = require('laravel-mix');

mix.js('resources/js/dashboard.js', 'public/js')
```

It remains only to connect the received script to the panel in the configuration file:

```php
// config/platform.php
'resource' => [
    'stylesheets' => [],
    'scripts'     => [
        '/js/dashboard.js'
    ],
],
```

> **Note**. To apply changes to the configuration file, you may need to clear the cache if it was created earlier. It can be done using the artisan command `artisan config:clear`.

Run to build assets:

```bash
npm run production
```


### Compilation with Vite

For Vite, configure your `vite.config.js` like this:

```javascript
laravel({
    input: ['resources/js/dashboard.js'],
    refresh: true,
}),
```

It remains only to connect the received script to the panel in the configuration file. This handles the necessary module injection.

```php
// config/platform.php
'vite' => [
    'resources/js/app.js',
],
```

Running the `build` command will version and bundle your application's assets and get them ready for you to deploy to production:

```bash
# Build and version the assets for production...
npm run build
```

> **Note**. To apply changes to the configuration file, you may need to clear the cache if it was created earlier. It can be done using the artisan command `artisan config:clear`.


### Run Controller

To display, we will use a template for which you first need to define the `Controller` and `Route` in your application:

```blade
{{-- hello.blade.php --}} 
<div data-controller="hello">
  <input data-hello-target="name" type="text">

  <button data-action="click->hello#greet">
    Greet
  </button>

  <span data-hello-target="output">
  </span>
</div>
```



## Vue.js Wrapped in a Stimulus


Many developers love the simplicity and power of Vue.js for building interactive and responsive user interfaces.  In this tutorial, we'll show you how to wrap Vue components within a Stimulus controller so you can easily integrate them.


Create a Stimulus controller file, for example `hello_controller.js`:

```js
import {createApp} from 'vue';

export default class extends window.Controller {
    connect() {
        this.app = createApp({
            data() {
                return {
                    message: 'Hello, Vue.js!'
                }
            }
        });

        this.app.mount(this.element);
    }

    disconnect() {
        this.app.unmount();
    }
}

```

Register the controller in your blade file:

```blade
<div data-controller="hello">
  @{{ message }}
</div>
```

Now, when the page loads, the Vue.js instance will be created and the message will be displayed in the HTML element. You can then use Vue.js as you normally would within the scope of the Stimulus controller.
