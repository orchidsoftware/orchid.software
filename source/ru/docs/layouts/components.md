---
title: Компоненты
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---


Одним из способов повторного использования шаблонов являеться создание 
`Blade` компонентов. Такие компоненты могут быть использованы и в платформе.

Для того, чтобы создать новый компонент воспользуемся `artisan` командой:

```php
php artisan make:component Hello --inline
```

> **Примечание.** Более подробно вы можете узнать о компонентах в [документации фреймворка](https://laravel.com/docs/blade#components)

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


Для использование его в экранах необходимо передать его строчное представление:

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
