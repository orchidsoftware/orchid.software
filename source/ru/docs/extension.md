---
title: Расширение панели администратора
description: ORCHID позволяет настраивать определенные аспекты системы
extends: _layouts.documentation.ru
section: main
---

ORCHID позволяет настраивать определенные аспекты системы,
чтобы лучше соответствовать вашим потребностям. 

## Маршрутизация

Приложение ORCHID может менять адрес для обращений, что бы ваши расширения могли следовать за ней, 
требуется указывать домен и префикс. Это может выглядеть так:

```php
$this->domain(config('platform.domain'))->group(function () {
    $this->group([
        'middleware' => config('platform.middleware.private'),
        'prefix'     => \Orchid\Platform\Dashboard::prefix(),
        'namespace'  => 'Orchid\Platform\Http\Controllers',
    ], function (\Illuminate\Routing\Router $router) {
    
        $router->get('/', function () {
            return view('welcome');
        });
        
    });
});
```


## Отображение

В ходе работы вам может понадобится создавать свои собственные варианты отображения `(view)`,
что бы обеспечить единый внешний вид потребуется наследование:

```php
@extends('platform::layouts.dashboard')


@section('title','title')
@section('description', 'description')

@section('content')

    <div>
        Content
    </div>

@stop
```


### Использование JS фреймворков

Основой платформы по части стилей является [Bootstrap](http://getbootstrap.com/), а в браузере выполняется код [Stimulus](https://stimulusjs.org/), вам необязательно использовать именно их.

Построем базовый пример, который отображает текст введённое в поле для этого:

В resouce/js создадим следующую структуру:

```php
- resource
    - controllers
        * hello.js
    * dashboard.js
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

Такая структура не помешает вашему приложению не зависимо от того, какой front-end строиться: Angular/React/Vue и т.п.

Останется только описать сборку в webpack.mix.js :

```php
mix.js('resources/js/dashboard.js', 'public/js')
```

Осталось только подключить полученный сценарий к панели в файле конфигурации или в сервис провайдере используя метод registerResource , точно так же можно поступить и с таблицами стилей, что позволит эффективно строить логику приложений.

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
        $dashboard->registerResource('stylesheets','dashboard.css');
        $dashboard->registerResource('scripts','dashboard.js');
    }
}
```

Для отображения воспользуемся шаблоном:

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
