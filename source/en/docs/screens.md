---
title: Screen concept
description: The main components of the user interface
extends: _layouts.documentation
section: main
---

The main element of the platform is the screens described by the layout hierarchy, according to which
Each element has properties that affect its appearance and behavior.

Simply put, what the user sees on the page and what actions he performs is described in one class called "Screen". He does not know where the data comes from, it can be: a database, API or any other external sources. Building the appearance based on the provided `templates` (Layouts) and all you need to do is just to determine what data will be shown in a particular template.

![Screens](https://orchid.software/assets/img/scheme/screens.jpg)

## Creating Screen

You can create a new screen by running the command:

```php
php artisan orchid:screen Idea
```

An `Idea` file will be created in the `app/Orchid/Screens` directory with the following contents:

```php
namespace App\Http\Controllers\Screens;

use Illuminate\Http\Request;
use Orchid\Platform\Screen\Screen;

class Idea extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Idea Screen';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Idea Screen';

    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
        return [];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar() : array
    {
        return [];
    }

    /**
     * Views
     *
     * @return array
     */
    public function layout() : array
    {
        return [];
    }
}

```

## Registering routes

Before being available at the direct URL, screens, like controllers, must be registered in the routes file `/routes/platform.php`. The routes recorded in it will go through the middleware specified in the private [configuration](/en/docs/configuration). Each screen can be registered using the `screen` method of `Route`:


```php
use App\Orchid\Screens\Idea;

Route::screen('/idea', Idea::class)->name('platform.idea');
```

Adding a screen is slightly different from the usual registration, for example, a `GET` request, in that instead of a single address, a whole group registered. For clarity, you can run the `route:list` command by Artisan:

```php
Method                      | URI                                  | Name
----------------------------+--------------------------------------+--------------
GET|HEAD|POST|PUT|PATCH|... | dashboard/idea/{method?}/{argument?} | platform.idea
```

If you register multiple routes

```php
use App\Orchid\Screens\Idea;
use App\Orchid\Screens\IdeaEdit;
Route::screen('/idea/edit', IdeaEdit::class)->name('platform.idea.edit');
Route::screen('/idea', Idea::class)->name('platform.idea');
```

> **Please note**, Routing Laravel chooses the first suitable route.

By writing the following routes:

```php
Route::screen('/idea', ...
Route::screen('/idea/edit',...
```

We get:

```php
URI                                       | Name
------------------------------------------+----------------------
dashboard/idea/{method?}/{argument?}      | platform.idea
dashboard/idea/edit/{method?}/{argument?} | platform.idea.edit
```

`{method?}` - means an optional argument that may go further.
Correspondingly, the name "edit" in the address falls under it.
The result will be a redirect to "dashboard/idea/".



## Data Acquisition

The data to be displayed on the screen defined in the `query` method, where sampling or generation of information should occur.
The transfer carried out in the form of an array, the keys will be available in layouts, for their control.

```php
public function query() : array
{
    return [
        'name'  => 'Alexandr Chernyaev',
    ];
}
```

The source can be the `Eloquent` model, for this you need to add the trait` AsSource`:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use AsSource
}
```

An example where the `order` and `orders` keys will be available in Layouts:

```php
public function query() : array
{
    return [
        'order'  => Order::find(1),
        'orders' => Order::paginate(),
    ];
}
```

The use of the `Eloquent` models is not necessary, it is possible to use arrays using the` Repository` wrapper:

```php
//...
use Orchid\Screen\Repository;    
//...

public function query() : array
{
    return [
        'order'      => new Repository([
            'product_id' => 'prod-100',
            'name'       => 'Desk',
            'price'      => 10.24,
            'created_at' => '01.01.2020',
      ]),
    ];
}
```



## Actions

The screens include built-in commands that allow users to execute various user scripts.
The `commandBar` method is responsible for this, which describes the required control buttons.

For example:

```php
public function commandBar() : array
{
    return [
        Button::make('Go print')->method('print'),
    ];
}
```

The `Button` class responds to what will happen when a button pressed, in the example above, when you click on the Print button,
The screen method `print` will be called, all the data that the user has seen on the screen will be available in Request.

```php
// By pressing, the 'create' method will be called
use Orchid\Screen\Actions\Button;

Button::make('New function')
    ->method('create');

// By clicking you will be redirected to the specified address
use Orchid\Screen\Actions\Link;

Link::make('External reference')
    ->href('http://orchid.software');

// By pressing, a modal window will be shown (CreateUserModal),
// in which you can execute the "save" method
use Orchid\Screen\Actions\ModalToggle;

ModalToggle::make('Modal window')
    ->modal('CreateUserModal')
    ->method('save');
```


## Layouts

Layouts are responsible for the appearance of the screen, that is, how and in what form the data will be displayed.

Each layout may include a different layout, that is, nesting.
For example, the screen divided into two columns, in the left-field for filling, on the right, there are a reference table and a graph.
You can come up with your examples of attachments.


```php
public function layout() : array
{
    return [
        Layout::columns([
            'Left column' => [
                FirstRows::class,
            ],
            'Right column' => [
                SecondRows::class,
            ],
        ]),
        
        // Modal window
        Layout::modal('Appointments', [
            ThirdRows::class,
        ]),
    ];
}
```
Sometimes you will want to use the same layout for different things, to reduce code duplication you can create a configurable layout.
To pass custom parameters to your layout you can use the class constructor to handle them:
```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;

class ReusableEditLayout extends Rows
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $prefix;

    /**
     * ReusableEditLayout constructor.
     *
     * @param string $prefix
     * @param string $title
     */
    public function __construct(string $prefix, string $title)
    {
        $this->prefix = $prefix;
        $this->title = $title;
    }

    /**
     * Views.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Label::make('label')
                ->title($this->title),

            Input::make($this->prefix . '.address')
                ->required()
                ->title('Address')
                ->placeholder('177A Bleecker Street'),
        ];
    }
}
```
Instances can be used in the same way but they can accept parameters
```php
public function layout(): array
{
    return [
        Layout::columns([
            new ReusableEditLayout('order.shipping_address', 'Shipping Address'),
            new ReusableEditLayout('order.invoice_address', 'Invoice Address'),
        ]),
    ];
}
```


More details can be found in the [Layouts section](/en/docs/layouts/).
