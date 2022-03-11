---
title: Универсальные макеты
extends: _layouts.documentation
---

## Пользовательский шаблон

Вполне ожидаемая ситуация, когда необходимо отобразить собственный `blade` шаблон.
Для этого необходимо вызвать `Layout::view`, передав параметром строку имени:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::view('myTemplate'),
    ];
}
```

Все данные из метода `query` будут переданы в Ваш шаблон.

```php
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
        Layout::view('hello'),
    ];
}
```

Вы можете отобразить содержимое `name` вот так:

```php
// ... /views/hello.blade.php

Hello {{ $name }}!
```

## Обертка

Промежуточным звеном между "Пользовательским шаблоном" и стандартными слоями может служить "Обёртка", которая позволяет указывать, где именно должны отображаться другие слои.

```php
public function layout(): array
{
    return [
        Layout::wrapper('myTemplate', [
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
    <div class="col-7 border-right">
        @foreach($foo as $row)
            {!! $row !!}
        @endforeach
    </div>
    <div class="col-5 no-gutter">
        {!! $bar !!}
    </div>
</div>
```

Переменные из `query` так же доступны в шаблоне.

## Компоненты

Одним из способов повторного использования шаблонов является создание
`Blade` компонентов. Такие компоненты могут быть использованы и в платформе.

Для того чтобы создать новый компонент, воспользуемся `artisan` командой:

```php
php artisan make:component Hello --inline
```

> **Примечание.** Более подробно Вы можете узнать о компонентах в [документации фреймворка](https://laravel.com/docs/blade#components)

В результате будет новый класс `Hello`, приведём его в следующий вид:

```php
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
 * @return Layout[]
 */
public function layout(): array
{
    return [
        Layout::component(Hello::class),
    ];
}
```

Значения из `query` будут подставлены в компонент по имени. При этом отсутствующие значения могут быть добавлены из контейнера, например:

```php
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

Панель администратора — это место, где вы можете просматривать и выполнять все необходимые действия в проекте. Но иногда технология и графический вид не соответствуют друг другу и расположены по разным адресам (Например, если вы используете  [Telescope](https://laravel.com/docs/telescope) или [Horizon](https://laravel.com/docs/horizon)). Это приводит к тому, что вам нужно постоянно перемещаться между двумя вкладками браузера.

Чтобы избежать этого, вы можете открыть iframe для просмотра другой страницы:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::browsing('http://127.0.0.1:8000/telescope'),
    ];
}
```

Attributes are also available to the html definition:

```php
Layout::browsing('http://127.0.0.1:8000/telescope')
    ->allow('...')
    ->loading('...')
    ->csp('...')
    ->name('...')
    ->referrerpolicy('...')
    ->sandbox('...')
    ->src('...')
    ->srcdoc('...');
```


## Расширение

Класс `Layouts` является группирующим нескольких различных. Для того чтобы добавить в него новую возможность, достаточно указать её в сервис провайдере как:

```php
use Orchid\Screen\Layout;
use Orchid\Screen\LayoutFactory;
use Orchid\Screen\Repository;


LayoutFactory::macro('hello', function (string $name) {
    return new class($name) extends Layout
    {
        /**
         * @ string
         */
        public $name;

        /**
         * Hello constructor.
         *
         * @param string $name
         */
        public function __construct(string $name)
        {
            $this->name = $name;
        }

        /**
         * @param Repository $repository
         *
         * @return mixed
         */
        public function build(Repository $repository)
        {
            return view('hello')->with('name', $this->name);
        }

    };
});
```

Тогда в экране вызов будет выглядеть как:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::hello('Alexandr Chernyaev')
    ];
}
```
