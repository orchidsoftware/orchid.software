---
title: View Template
description: Learn how to create view/custom templates and themes for your Laravel Orchid application with our comprehensive documentation page on Custom/View Templates.
---

## Views

Sometimes you may want to display your own `blade` template in your application. To do this, you can use the `Layout::view` method and pass it a string containing the name of your template.

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::view('greeting'),
    ];
}
```

Any data returned by the `query` method will be passed to your template and can be accessed using Blade syntax. For example:

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
        Layout::view('greeting'),
    ];
}
```

In the `hello.blade.php` template, you can display the contents of the `name` variable like this:

```blade
{{-- ... /views/greeting.blade.php --}}

Hello, {{ $name }}.
```

Note that the `layout` method should return an array of views to be displayed in the final layout. If you want to include multiple custom templates, you can add them to the array like this:

```php
public function layout(): array
{
    return [
        Layout::view('dashboard'),
        Layout::view('users'),
        Layout::view('settings'),
    ];
}
```

## Blade Components

Blade components are a way to reuse templates in your Laravel application. To create a new blade component, you can use the `artisan` command:

```php
php artisan make:component Hello --inline
```

This will create a new class called `Hello` in the `App\View\Components` namespace. The class should look something like this:

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

To use the component in your screens, you can pass its lowercase representation to the `Layout::component` method:

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

The values returned by the `query` method will be passed to the component and can be accessed using blade syntax. For example, in the `Hello` component class, you can access the name variable like this:

```php
Hello {{ $name }}!
```

If you want to pass additional variables to the component, you can do so by modifying the constructor and adding them as arguments. For example:

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

You can learn more about blade components in the [Laravel documentation](https://laravel.com/docs/blade#components).

## Wrapper

A "Wrapper" is an intermediate link between a custom template and the standard layout layers. It allows you to specify where other layout layers should be displayed within your custom template.

To use a wrapper, you can pass an array of views to the `Layout::wrapper` method, along with the name of your custom template. The array should contain keys representing the variables that will be available in the template, and the values should be the views to be rendered.

```php
public function layout(): array
{
    return [
        Layout::wrapper('settings', [
            'foo' => [
                RowLayout::class,
                RowLayout::class,
            ],
            'bar' => RowLayout::class,
        ]),
    ];
}
```

In the `settings.blade.php` template, you can access the `foo` and `bar` variables and display the views they contain like this:

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

Note that the variables returned by the `query` method will also be available in the template and can be accessed using blade syntax.

```php
public function query(): array
{
    return [
        'name' => 'Alexandr Chernyaev',
    ];
}
```

You can display the contents of the name variable in your template like this:

```php
Hello, {{ $name }}.
```

## Browsing

Sometimes it can be inconvenient to switch between multiple browser tabs when working in the admin panel. To avoid this, you can use the `Layout::browsing` method to display the contents of a different web page within an iframe in your application.

For example:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::browsing('http://127.0.0.1:8000/telescope'),
    ];
}
```

You can also specify various attributes for the iframe element by chaining method calls onto the `Layout::browsing` method. For example:

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

Refer to the [HTML specification](https://html.spec.whatwg.org/multipage/iframe-embed-object.html#the-iframe-element) for a complete list of available attributes.
