---
title: Components
extends: _layouts.documentation
section: main
lang: en
menu: layouts
---


One way to reuse templates is to create
`Blade` of components. Such components can also be used in the platform.

In order to create a new component, use the `artisan` command:

```php
php artisan make:component Hello --inline
```

> **Note.** You can learn more about the components in [framework documentation](https://laravel.com/docs/blade#components)

As a result, there will be a new class `Hello`, we bring it into the following form:

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


To use it in screens, you must pass its lowercase representation:

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

The values from `query` will be substituted into the component by name. In this case, missing values can be added from the container, for example:

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
