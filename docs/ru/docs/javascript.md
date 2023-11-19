---
title: Использование JavaScript 
description: Пример использования Stimulus JS с пакетом Laravel Orchid
---

Основой платформы по части стилей является [Bootstrap](http://getbootstrap.com/), а в браузере выполняется код [Hotwired](https://hotwired.dev). Вы можете подключить другие библиотеки по своему вкусу, но мы рекомендуем оставаться в этой экосистеме.

## Turbo

Благодаря [Turbo](https://turbo.hotwire.dev)админ-панель эмулирует Single Page Application, загружая ресурсы только при первом вызове и создавая впечатление повторной отрисовки контента в браузере вместо стандартных переходов между страницами.

Поскольку все ресурсы будут загружены при первом вызове, классические вызовы, подобные этому, работать не будут:
```js
document.addEventListener("load", () => {
    console.log('Page load');
});
```

Он будет выполнен только один раз и больше не будет вызываться при переходах. Чтобы этого избежать, нужно использовать события turbo:

```js
document.addEventListener("turbo:load", () => {
    console.log('Page load');
})
```

Более подробную информацию вы можете найти на сайте [turbo.hotwire.dev](https://turbo.hotwire.dev).


## Stimulus
[Stimulus](https://stimulus.hotwired.dev/) это фреймворк JavaScript от разработчиков Ruby on Rails. Он оснащает фронтенд-разработку новыми подходами к JavaScript, при этом не стремится контролировать все ваши действия и не навязывает отделение фронтенда от бэкенда.



Построим базовый пример, который отображает текст, введённый в поле. Для этого выполним описанные ниже действия.

В `resources/js` создадим следующую структуру:

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

Класс контроллера со следующим содержанием:

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

И точку сборки:

```php
// dashboard.js
import HelloController from "./controllers/hello"

application.register("hello", HelloController);
```

Такая структура не помешает вашему приложению не зависимо от того, какой front-end строится: Angular/React/Vue и т.п.

Останется только описать сборку в webpack.mix.js :

```php
let mix = require('laravel-mix');

mix.js('resources/js/dashboard.js', 'public/js')
```

Осталось только подключить полученный сценарий к панели в файле конфигурации или в сервис провайдере, используя метод `registerResource`. Точно так же можно поступить и с таблицами стилей, что позволит эффективно строить логику приложений.

```php
// config/platform.php
'resource' => [
    'stylesheets' => [],
    'scripts'     => [
        '/js/dashboard.js'
    ],
],
```

> **Примечание**. Для применения изменений в конфигурационном файле может потребоваться очистить кеш, если он был создан ранее. Это можно сделать с помощью artisan команды `artisan config:clear`.

Пример записи для поставщика услуг

```php
// app/Providers/AppServiceProvider.php

use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    public function boot(Dashboard $dashboard)
    {
        $dashboard->registerResource('scripts','/js/dashboard.js');
        //$dashboard->registerResource('stylesheets','/css/dashboard.css');
    }
}
```


Для отображения воспользуемся шаблоном, для которого предварительно нужно определить `Controller` и `Route` в вашем приложение:

```php
// hello.blade.php
<div data-controller="hello">
  <input data-hello-target="name" type="text">

  <button data-action="click->hello#greet">
    Greet
  </button>

  <span data-hello-target="output">
  </span>
</div>
```


## Обертка Vue.js внутри Stimulus

Многие разработчики любят простоту и мощность Vue.js для построения интерактивных и отзывчивых frontend приложений. В этой секции, мы рассмотрим как легки обернуть и интегрировать Vue компонент внутри Stimulus контроллера.

Создайте файл Stimulus контроллера, для примера `hello_controller.js`:

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
Укажите ваш контроллер во view, а конкретно в blade шаблоне:

```html
<div data-controller="hello">
  @{{ message }}
</div>
```
Теперь, когда вы перезагрузите страницу, экземпляр Vue.js будет создан и мы увидим наше сообщение `Hello, Vue.js!' на экране и внутри HTML элемента. Далее вы можете использывать Vue.js как обычно в рамках контроллера Stimulus.
