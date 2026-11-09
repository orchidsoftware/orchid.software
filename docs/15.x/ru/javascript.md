---
title: JavaScript и ресурсы
description: Подключение Vite и жизненный цикл контроллеров Stimulus при переходах Turbo.
---

Orchid использует Bootstrap, Turbo и Stimulus. Ресурсы самого пакета публикуются командой
`php artisan orchid:publish`. Дополнения приложения собирайте его собственной конфигурацией Vite.

## Подключите ресурсы приложения

Задайте точки входа Vite:

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

Зарегистрируйте исходные файлы в Orchid:

```php
// config/orchid.php
'vite' => [
    'resources/js/orchid.js',
    'resources/css/orchid.css',
],
```

Для разработки используйте `npm run dev`, для рабочей сборки `npm run build`.
Элементы `vite` являются исходными файлами Laravel Vite, а не путями к готовой сборке.
Ресурсы пакета используют `public/vendor/orchid/manifest.json`.
При обновлении удалите старые инструкции Mix и устаревшую сборку пакета.

## Зарегистрируйте контроллер

Панель предоставляет приложение Stimulus `window.application` и базовый контроллер `window.Controller`.
Регистрируйте контроллеры в точке входа приложения, загруженной после ресурсов Orchid:

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

## Учитывайте переходы Turbo

Используйте `connect()` и `disconnect()` для инициализации и очистки. В `disconnect()` удаляйте обработчики окна,
наблюдатели и экземпляры виджетов. Контроллеры могут подключаться повторно при восстановлении страницы Turbo
или замене разметки Listener. Для действий всей страницы используйте `turbo:load`, а не единственный `load` браузера.

Регистрируйте контроллеры в `window.application`. Не запускайте второе приложение Stimulus для той же панели.
Графиками, календарями, списками и редакторами пакета управляют их собственные контроллеры.

## Подключите готовые файлы

Для собранных файлов или внешних ресурсов укажите URL в `config/orchid.php`:

```php
'resource' => [
    'stylesheets' => ['/css/custom.css'],
    'scripts' => ['/js/custom.js'],
],
```

Не помещайте исходники Vite в `resource`, а URL готовой сборки в `vite`.
После изменения закешированной конфигурации выполните `php artisan config:clear`.

## Настройте собственные поля

Шаблоны Blade и действия контроллеров описаны в разделе [собственных полей](/ru/docs/custom-field).
Code и Markdown используют CodeMirror. Старые объекты плагинов редакторов и API графиков Frappe недоступны.
