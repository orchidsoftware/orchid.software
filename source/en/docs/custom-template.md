---
title: Custom template
extends: _layouts.documentation
section: main
lang: en
---

## Views


It is an expected situation when you need to display your own `blade` template**,
to do this, call `Layout::view` by passing the parameter a name string:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::view('myTemplate'),
    ];
}
```

All data from the `query` method will be passed to your template.

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

You can display the contents of `name` like this:

```php
// ... /views/hello.blade.php

Hello {{ $name }}!
```

## Wrapper

An intermediate link between the "Custom Template" and the standard layers can serve as a "Wrapper", with which
it is available to specify where other layers should be displayed.

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

The variables `foo` and `bar` will be passed to the `myTemplate` template, containing the already collected `View`, which can be displayed:


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

The variables from query are also available in the template.

## Blade Components


One way to reuse templates is to create
`Blade` of components. Such components can also be used in the platform. In order to create a new component, use the `artisan` command:

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


## Browsing

The admin panel is where you can view and perform all the necessary actions in the project. But sometimes, the technology and graphical appearance are not consistent and are located at different addresses (For example, if you use [Telescope](https://laravel.com/docs/telescope) or [Horizon](https://laravel.com/docs/horizon)). This leads to the fact that you need to move between two browser tabs constantly.

To avoid this, you can open an iframe to view a different page:

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

## Extension


The `Layouts` class is grouping several ones; to add a new feature to it, it is enough to specify it in the service provider as:

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
        protected function build(Repository $repository)
        {
            return view('hello')->with('name', $this->name);
        }

    };
});
```

Then on the screen, the call will look like:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::hello('Alexandr Chernyaev')
    ];
}
```
