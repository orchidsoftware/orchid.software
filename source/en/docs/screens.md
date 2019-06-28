---
title: Screen concept
description: The main components of the user interface
extends: _layouts.documentation.en
section: main
---

The main element of the platform are the screens described by the layout hierarchy, according to which
Each element has properties that affect its appearance and behavior.

Simply put, what the user sees on the page and what actions he performs is described in one class called "Screen". He does not know where the data comes from, it can be: a database, API or any other external sources. Building the appearance is based on the provided `templates` (Layouts) and all you need to do is just to determine what data will be shown in a particular template.

![Screens](https://orchid.software/assets/img/scheme/screens.jpg)

## Creation

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

## Check in routes

You can register each screen using the `screen` method of Route

```php
use App/Orchid/Screens/Idea;

Route::screen('/idea', Idea::class)->name('platform.idea');
```


## Data Acquisition

The data to be displayed on the screen is defined in the `query` method, where sampling or generation of information should occur.
The transfer is carried out in the form of an array, the keys will be available in layouts, for their control.

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
use Orchid\Screen\Traits\AsSource;

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



## Treatment

The screens include built-in commands that allow users to execute various user scripts.
The `commandBar` method is responsible for this, which describes the required control buttons.

For example:

```php
public function commandBar() : array
{
    return [
        Link::name('Go print')->method('print'),
    ];
}
```

The `Link` class responds to what will happen when a button is pressed, in the example above, when you click on the Print button,
The screen method `print` will be called, all the data that the user has seen on the screen will be available in Request.

```php
// By pressing, the 'create' method will be called
Link::name('New function')->method('create');

// By clicking you will be redirected to the specified address
Link::name('External reference')->link('http://google.com/');

// By pressing, a modal window will be shown (CreateUserModal),
// in which you can execute the "save" method
Link::name('Modal window')
    ->modal('CreateUserModal')
    ->title('Add user')
    ->method('save'),
```


## Layouts

Layouts are responsible for the appearance of the screen, that is, how and in what form the data will be displayed.

Each layout may include a different layout, that is, nesting.
For example, the screen is divided into two columns, in the left field for filling, on the right there is a reference table and a graph.
You can come up with your own examples of attachments.


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

More details can be found in the [Layouts section](/en/docs/layouts/).
