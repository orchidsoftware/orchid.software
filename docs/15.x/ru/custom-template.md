---
title: Универсальные макеты
extends: _layouts.documentation
---

## Пользовательский шаблон

Вполне ожидаемая ситуация, когда необходимо отобразить собственный `blade` шаблон. Для этого необходимо вызвать
`View::make`, передав параметром строку имени:

```php
use Orchid\Screen\Layouts\View;

public function layout(): array
{
    return [
        View::make('myTemplate'),
    ];
}
```

Все данные из метода `query` будут переданы в Ваш шаблон.

```php
use Orchid\Screen\Layouts\View;

// ... Screen

public function query(): array
{
    return [
        'name' => 'Alexandr Chernyaev',
    ];
}

public function layout(): array
{
    return [
        View::make('hello'),
    ];
}
```

Вы можете отобразить содержимое `name` вот так:

```blade
// ... /views/hello.blade.php

Hello {{ $name }}!
```

## Обертка

Промежуточным звеном между "Пользовательским шаблоном" и стандартными слоями может служить "Обёртка", которая позволяет
указывать, где именно должны отображаться другие слои.

```php
use Orchid\Screen\Layouts\Wrapper;

public function layout(): array
{
    return [
        Wrapper::make('myTemplate', [
            'foo' => [
                RowLayout::class,
                RowLayout::class,
            ],
            'bar' => RowLayout::class,
        ]),
    ];
}
```

В шаблон `myTemplate` будут переданы переменные `foo` и `bar`, содержащие уже собранные `View`, которые можно выводить:

```html
<div class="row">
    <div class="col-7 border-right">@foreach($foo as $row) {!! $row !!} @endforeach</div>
    <div class="col-5 no-gutter">{!! $bar !!}</div>
</div>
```

Переменные из `query` так же доступны в шаблоне.

## Компоненты

Одним из способов повторного использования шаблонов является создание `Blade` компонентов. Такие компоненты могут быть
использованы и в платформе.

Для того чтобы создать новый компонент, воспользуемся `artisan` командой:

```shell
php artisan make:component Hello --inline
```

> **Примечание.** Более подробно Вы можете узнать о компонентах в
> [документации фреймворка](https://laravel.com/docs/blade#components)

В результате будет новый класс `Hello`, приведём его в следующий вид:

```blade
namespace App\View\Components;

use Illuminate\View\Component;

class Hello extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * Create a new component instance.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
<div>
    Hello {{ $name }}!
</div>
blade;
    }
}
```

Для использования этого класса в экранах необходимо передать его строчное представление:

```php
use Orchid\Screen\Layouts\Component;

/**
 * Query data.
 *
 * @return array
 */
public function query(): array
{
    return [
        'name' => 'Sheldon Cooper',
    ];
}

/**
 * Views.
 *
 * @return \Orchid\Screen\Layout[]
 */
public function layout(): array
{
    return [
        Component::make(Hello::class),
    ];
}
```

Значения из `query` будут подставлены в компонент по имени. При этом отсутствующие значения могут быть добавлены из
контейнера, например:

```blade
namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\View\Component;

class Hello extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var Application
     */
    public $application;

    /**
     * Create a new component instance.
     *
     * @param Application $application
     * @param string      $name
     */
    public function __construct(Application $application, string $name)
    {
        $this->application = $application;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
<div>
    Hello {{ $name }}!<br>
    Version {{ $application->version() }}
</div>
blade;
    }
}
```

## Browsing

Панель администратора — это место, где вы можете просматривать и выполнять все необходимые действия в проекте. Но иногда
технология и графический вид не соответствуют друг другу и расположены по разным адресам (Например, если вы используете
[Telescope](https://laravel.com/docs/telescope) или [Horizon](https://laravel.com/docs/horizon)). Это приводит к тому,
что вам нужно постоянно перемещаться между двумя вкладками браузера.

Чтобы избежать этого, вы можете открыть iframe для просмотра другой страницы:

```php
use Orchid\Screen\Layouts\Browsing;

public function layout(): array
{
    return [
        Browsing::make('http://127.0.0.1:8000/telescope'),
    ];
}
```

Attributes are also available to the html definition:

```php
use Orchid\Screen\Layouts\Browsing;

Browsing::make('http://127.0.0.1:8000/telescope')
    ->allow('...')
    ->loading('...')
    ->csp('...')
    ->name('...')
    ->referrerpolicy('...')
    ->sandbox('...')
    ->src('...')
    ->srcdoc('...');
```

## Повторное использование макетов

Чтобы использовать настроенный макет на нескольких экранах, создайте класс, возвращающий этот макет:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\View;

class GreetingLayout
{
    public static function make(string $name): View
    {
        return View::make('hello', ['name' => $name]);
    }
}
```

Создайте `resources/views/hello.blade.php`:

```blade
<p>Hello, {{ $name }}.</p>
```

Верните настроенный макет из экрана:

```php
use App\Orchid\Layouts\GreetingLayout;

public function layout(): iterable
{
    return [
        GreetingLayout::make('Alex'),
    ];
}
```
