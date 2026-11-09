---
title: JavaScript and assets
description: Load Vite resources and manage Stimulus controllers under Turbo.
---

Orchid uses Bootstrap, Turbo, and Stimulus. The package publishes its own Vite assets through
`php artisan orchid:publish`. Build your application's additions with its own Vite configuration.

## Load application assets

Configure application entry points:

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [laravel({
        input: ['resources/js/orchid.js', 'resources/css/orchid.css'],
        refresh: true,
    })],
});
```

Register those entry points in Orchid:

```php
// config/orchid.php
'vite' => [
    'resources/js/orchid.js',
    'resources/css/orchid.css',
],
```

Run `npm run dev` during development and `npm run build` for production.
The `vite` entries refer to source files handled by Laravel Vite, not published output paths.
Orchid's own assets use `public/vendor/orchid/manifest.json`.
Remove old Mix-based build instructions and stale package assets when upgrading.

## Register a controller

The panel exposes `window.application`, its Stimulus application, and `window.Controller`, its base controller.
Register custom controllers in an application entry point loaded after Orchid's core resources:

```js
// resources/js/controllers/hello.js
export default class extends window.Controller {
    static targets = ['name', 'output'];

    greet() {
        this.outputTarget.textContent = this.nameTarget.value;
    }
}
```

```js
// resources/js/orchid.js
import HelloController from './controllers/hello.js';

window.application.register('hello', HelloController);
```

```blade
<div data-controller="hello">
    <input data-hello-target="name" data-action="input->hello#greet">
    <output data-hello-target="output"></output>
</div>
```

## Handle Turbo navigation

Use Stimulus `connect()` and `disconnect()` for setup and cleanup. Remove window listeners, observers, and widget
instances in `disconnect()`. Controllers can reconnect when Turbo restores cached pages or a Listener replaces markup.
For page-wide work, listen to `turbo:load` instead of relying on a single browser `load` event.

Do not start a second Stimulus application for the same panel. Register your controllers on `window.application`.
The package handles its own charts, date pickers, selects, and editors through their controllers.

## Load published resources

For resources already built or hosted elsewhere, use URLs in `config/orchid.php`:

```php
'resource' => [
    'stylesheets' => ['/css/custom.css'],
    'scripts' => ['/js/custom.js'],
],
```

Do not put Vite source paths in `resource`, or built URLs in `vite`.
After changing cached configuration, run `php artisan config:clear`.

## Customize fields

Read [custom fields](/en/docs/custom-field) for Blade templates and controller actions.
The Code and Markdown fields use CodeMirror. The old editor plugin objects and Frappe chart API are not available.
