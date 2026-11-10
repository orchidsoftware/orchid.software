---
title: Screens
description:
    Laravel Orchid provides screens for building and maintaining complex web applications, allowing for separation of
    concerns between data and presentation through the use of layouts and data retrieval from various sources.
---

## Introduction

A screen loads data through `query()` and defines its presentation through `layout()`.
Data can come from a database, an API, or another source. Layouts display the values returned by `query()`.
Use `commandBar()` for page actions, and define public handler methods to process form submissions.

## Creating Screens

You can create a new screen by running the command:

```shell
php artisan orchid:screen Idea
```

An `Idea` file will be created in the `app/Orchid/Screens` directory with the following contents:

```php
use Orchid\Screen\Screen;

class Idea extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     */
    public function query(): array
    {
        return [];
    }

    /**
     * The name of the screen is displayed in the header.
     */
    public function name(): ?string
    {
        return 'Idea Screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
```

The screen class includes several methods that you can use to define the behavior and appearance of the screen. These
include:

- **query**: This method loads data from the database or other sources. It should return an array of data that will be
  available to the screen's layouts and views.

- **commandBar**: This method is used to define buttons and other actions that will be displayed on the screen.

- **layout**: This method is used to define the structure and content of the screen. It should return an array of layout
  objects, which can be used to display data, forms, and other elements on the screen.

To use the new screen in your application, you will need to register it in the route file.

## Routing Screens

Before a screen can be accessed at a direct URL, it must be registered in the `routes/orchid.php` routes file. Routes
registered in this file will be passed through the middleware specified in the [configuration](/en/docs/configuration).

To register a screen, you can use the screen method of the `Route` class. For example:

```php
use App\Orchid\Screens\Idea;

Route::screen('/idea', Idea::class)->name('orchid.idea');
```

With the default `/admin` prefix, the Idea screen is available at `/admin/idea`. If you changed `orchid.prefix`, use
that prefix instead.

Adding a screen is slightly different from the usual registration, for example, a `GET` request. Instead of a single
address, a whole group registered. For clarity, you can run the `route:list` command by Artisan:

```text
Method   | URI                      | Name
---------+--------------------------+--------------
GET|POST | admin/idea/{method?} | orchid.idea
```

If you have multiple screens, you can register them in the same way. For example:

```php
use App\Orchid\Screens\Idea;
use App\Orchid\Screens\IdeaEdit;

Route::screen('/idea/edit', IdeaEdit::class)
    ->name('orchid.idea.edit');

Route::screen('/idea', Idea::class)
    ->name('orchid.idea');
```

> It's important to note that when registering multiple routes, Laravel will choose the first matching route.

By writing the following routes:

```php
Route::screen('/idea', Idea::class)->name('orchid.idea');
Route::screen('/idea/edit', IdeaEdit::class)->name('orchid.idea.edit');
```

We get:

```text
URI                           | Name
------------------------------+---------------------
admin/idea/{method?}      | orchid.idea
admin/idea/edit/{method?} | orchid.idea.edit
```

`{method?}` - means an optional argument that may go further. Correspondingly, the name "edit" in the address falls
under it. The result will be a redirect to "admin/idea/". To avoid this, make sure to order your routes correctly.

## Querying Data

The `query` method of a screen is used to load data from the database or other sources. This data is then passed to the
screen's layouts and views as an array

For example, you might use the `query` method to response simple string:

```php
public function query(): array
{
    return [
        'name'  => 'Alexandr',
    ];
}
```

You can use the `AsSource` trait to make an `Eloquent` model available as a data source for a screen. This allows you to
easily access and manipulate the model's data from within the screen's query method.

To use the `AsSource` trait, you need to include it in your model class:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use AsSource;
}
```

Then, in your screen's `query` method, you can access the model's data like this:

```php
public function query(): array
{
    return [
        'order'  => Order::find(1),
        'orders' => Order::paginate(),
    ];
}
```

In this example, the `order` key will contain a single `Order` model instance, while the `orders` key will contain a
paginated list of all `Order` models in the database. These keys can then be used in the screen's layouts and views to
display the data to the user.

You can also use the `Repository` wrapper to pass an array of data to the screen's layouts and views. For example:

```php
use Orchid\Screen\Repository;

public function query(): array
{
    return [
        'order' => new Repository([
            'product_id' => 'prod-100',
            'name'       => 'Desk',
            'price'      => 10.24,
            'created_at' => '01.01.2020',
        ]),
    ];
}
```

The `order` key contains a Repository. Fields and cells can read its values using names such as `order.price`.

## Autocompleting Public Properties

You can use public properties in your screen class to store and access data within different methods of the class. When
a screen is displayed, the data returned from the `query` method will be automatically assigned to public properties of
the same name.

For example, consider the following code:

```php
/**
 * @var string
 */
public $message;

public function query(): array
{
    return [
        'message'  => 'Hello World!',
    ];
}

public function name(): ?string
{
    return $this->message;
}
```

In this example, we have declared a public property called $message. When a `GET` request is made to the screen, the
`query` method is executed, and the value of the message key in the returned array is assigned to the `message`
property.

Then, in the `name` method, we return the value of the $message property. This means that when the screen is displayed,
the page title will contain the words "Hello World!"

Using public properties in this way is a useful way to pass data between different methods of a screen class, and can be
especially helpful when building complex screens with multiple layouts and views.

## Screen Actions

Screens include built-in commands that allow users to execute various actions. The `commandBar` method is responsible
for defining these controls.

Several types of actions are available:

### Button

Button actions allow users to trigger a method on the screen when clicked. For example:

```php
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

public function commandBar(): array
{
    return [
        Button::make('Go print')
            ->method('print'),
    ];
}

public function print(): void
{
    Toast::warning('Hello, world! This is a toast message.');
}
```

Clicking the button calls the screen's `print()` method. Submitted form fields are available through
`Illuminate\Http\Request`.

### Link

Link actions allow users to navigate to a different URL when clicked. For example:

```php
use Orchid\Screen\Actions\Link;

public function commandBar(): array
{
    return [
        Link::make('External reference')
            ->href('https://orchid.software'),
    ];
}
```

### Toggle

Toggle actions allow users to switch a boolean state interactively. They are designed specifically for tables and other
UI elements where users need to quickly change a value. When clicked, the toggle calls a method on the screen and can
update the value without leaving the context.

```php
use Orchid\Screen\Actions\Toggle;
use Orchid\Screen\TD;

// Example: displaying toggle in a table column
TD::make('Enabled')->render(function (User $user) {
    return Toggle::make('Enabled')
        ->method('switch', ['user' => $user])
        ->status($user->active);
});
```

**Recommendation:** for the smoothest experience, use the following configuration:

```php
[
    // ...
    'refresh-method' => 'morph',
    'refresh-scroll' => 'preserve',
];
```

### ModalToggle

Modal toggle actions allow users to open a modal window when clicked. For example:

```php
use Orchid\Screen\Actions\ModalToggle;

public function commandBar(): array
{
    return [
        ModalToggle::make('Modal window')
            ->modal('CreateUserModal')
            ->method('save'),
    ];
}
```

## Duplicate Actions

In software development, it is common for similar actions to be performed across multiple screens or classes. For
example, an action such as deleting an object may be needed on both a pagination screen and a details screen. Instead of
duplicating the method in both classes, it is more efficient to utilize the concept of inheritance.

PHP offers the powerful feature of inheritance, where a base class can be created for an entity, with defined access
rights and methods. These can then be inherited by specific screens, allowing for reusability and reducing the need for
redundant code. This not only improves the efficiency of the development process but also makes the code more
maintainable and easier to understand.

## Calling a Screen Method

When working within a screen in Laravel Orchid, all UI actions have a corresponding method that is executed when called.
To explicitly call a desired method from JavaScript or a Blade template, a `POST` request must be made to a specific
route. The `method` property must be specified in the attributes using the
`route('orchid.screen.name', ['method' => 'hello'])` helper.

For example, to call the `hello` method on the `orchid.screens.users` screen, the following code can be used:

```blade
<form action="{{ route('orchid.screens.users', ['method' => 'hello']) }}"
      method="POST"
>
    @csrf
    <button type="submit">Say "Hello, World!"</button>
</form>
```

This will send a `POST` request to the 'orchid.screens.users' screen with a method attribute of `hello`, which will
trigger the corresponding method on the server-side.

You can also use this with the UI buttons:

```php
use Orchid\Screen\Actions\Button;

Button::make('Say "Hello, World!"')
    ->action(route('orchid.screens.users', [
        'method' => 'hello',
    ]));
```

## Screen Layouts

Return layouts from the screen's `layout()` method. A layout can contain other layouts.
For example, Columns places a form beside a table:

```php
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

public function layout(): iterable
{
    return [
        Columns::make([
            Rows::make([
                Input::make('order.name')->title('Name'),
                Input::make('order.price')->type('number')->title('Price'),
            ]),
            Table::make('orders', [
                TD::make('name'),
                TD::make('price'),
            ]),
        ]),
    ];
}
```

The form reads values from `order`, and the table displays records from `orders`, as returned by `query()`.
See [Layouts](/en/docs/layouts) to choose a layout and [Rows](/en/docs/rows#reuse-a-form) to share forms between
screens.

## Additional Methods

### Validation Message

```php
/**
 * Message if the form is not valid.
 */
public function formValidateMessage(): string
{
    return 'Please check the entered data';
}
```

This method returns a message if the HTML form validation fails, for example, if a required field is missing.

#### Prevent Data Loss on Navigation

Orchid warns users before they leave a form with unsaved changes. The `orchid.prevents_abandonment`
configuration option enables this behavior by default. To disable the warning for a screen, return `false`:

```php
public function needPreventsAbandonment(): bool
{
    return false;
}
```

#### Stimulus Controller

```php
/**
 * Returns the name of the base Stimulus controller for the frontend.
 *
 * This method is used to determine the base Stimulus controller that will be
 * utilized on the frontend of the application. The controller manages the
 * behavior of UI elements, interacting with other components via Hotwire.
 *
 * @return string The name of the base controller.
 */
public function frontendController(): string
{
    return 'base';
}
```

This method returns the name of the base Stimulus controller for the frontend. It is crucial for managing the behavior
of UI elements and interacting with other components via Hotwire.

## Signed screen state

Orchid restores screen state between requests. Ordinary values and closures are signed; persisted Eloquent models
are serialized as identifiers and reloaded from the database. Use `#[WithoutRelations]` from
`Illuminate\Queue\Attributes\WithoutRelations` on a public model property to avoid restoring its loaded relations.
Keep the same `APP_KEY` across requests and application instances.

Signed state does not authorize an action or make request input trustworthy. Check record policies and validate input
inside each action handler. Query current database state when a decision depends on changes made since rendering.
