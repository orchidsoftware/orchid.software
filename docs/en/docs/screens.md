---
title: Screens
description: Laravel Orchid provides screens for building and maintaining complex web applications, allowing for separation of concerns between data and presentation through the use of layouts and data retrieval from various sources.
---

## Introduction


Screens in the Orchid serve as the core structure for defining page layout and behavior. Each screen is represented by a class that defines the UI components, their properties, and how they interact with one another.  

Screens don't handle data fetching directly; instead, they focus on rendering the UI using predefined templates (layouts) and specify where and how data should be displayed. Data can come from any source—be it a database, API, or external service—without affecting the screen logic.  

At the core, each screen is essentially an HTML `<form>`, which streamlines handling user input, submitting data, and managing interactions in a standardized way. This ensures a predictable and consistent user experience.  

By separating the concerns of data management and UI rendering, Orchid screens make it easier to build and maintain complex web applications.


## Creating Screens

You can create a new screen by running the command:

```php
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
    public function query() : array
    {
        return [];
    }

    /**
     * The name of the screen is displayed in the header.
     */
    public function name(): ?string
    {
        return "Idea Screen";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar() : array
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout() : array
    {
        return [];
    }
}
```

The screen class includes several methods that you can use to define the behavior and appearance of the screen. These include:

- **query**: This method loads data from the database or other sources. It should return an array of data that will be available to the screen's layouts and views.

- **commandBar**: This method is used to define buttons and other actions that will be displayed on the screen.

- **layout**: This method is used to define the structure and content of the screen. It should return an array of layout objects, which can be used to display data, forms, and other elements on the screen.

To use the new screen in your application, you will need to register it in the route file.


## Routing Screens


Before a screen can be accessed at a direct URL, it must be registered in the `routes/platform.php` routes file. Routes registered in this file will be passed through the middleware specified in the [configuration](/en/docs/configuration).


To register a screen, you can use the screen method of the `Route` class. For example:


```php
use App\Orchid\Screens\Idea;

Route::screen('/idea', Idea::class)->name('platform.idea');
```

This will register a new route for the Idea screen, accessible at the URL `/idea`.

Adding a screen is slightly different from the usual registration, for example, a `GET` request. Instead of a single address, a whole group registered. For clarity, you can run the `route:list` command by Artisan:

```php
Method   | URI                      | Name
---------+--------------------------+--------------
GET|POST | dashboard/idea/{method?} | platform.idea
```

If you have multiple screens, you can register them in the same way. For example:

```php
use App\Orchid\Screens\Idea;
use App\Orchid\Screens\IdeaEdit;

Route::screen('/idea/edit', IdeaEdit::class)
    ->name('platform.idea.edit');

Route::screen('/idea', Idea::class)
    ->name('platform.idea');
```

> It's important to note that when registering multiple routes, Laravel will choose the first matching route.

By writing the following routes:

```php
Route::screen('/idea', ...
Route::screen('/idea/edit',...
```

We get:

```php
URI                           | Name
------------------------------+---------------------
dashboard/idea/{method?}      | platform.idea
dashboard/idea/edit/{method?} | platform.idea.edit
```

`{method?}` - means an optional argument that may go further.
Correspondingly, the name "edit" in the address falls under it.
The result will be a redirect to "dashboard/idea/". To avoid this, make sure to order your routes correctly.



## Querying Data

The `query` method of a screen is used to load data from the database or other sources. 
This data is then passed to the screen's layouts and views as an array

For example, you might use the `query` method to response simple string:

```php
public function query() : array
{
    return [
        'name'  => 'Alexandr',
    ];
}
```


You can use the `AsSource` trait to make an `Eloquent` model available as a data source for a screen. This allows you to easily access and manipulate the model's data from within the screen's query method.

To use the `AsSource` trait, you need to include it in your model class:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use AsSource;
}
```

Then, in your screen's `query` method, you can access the model's data like this:

```php
public function query() : array
{
    return [
        'order'  => Order::find(1),
        'orders' => Order::paginate(),
    ];
}
```

In this example, the `order` key will contain a single `Order` model instance, while the `orders` key will contain a paginated list of all `Order` models in the database. These keys can then be used in the screen's layouts and views to display the data to the user.


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

In this example, the `order` key will contain an array of ideas with the given data.

The `query` method is an important part of a screen, as it is used to load the data that will be displayed to the user. Be sure to carefully consider the data that you need to load and how it will be used in your layouts and views.


## Autocompleting Public Properties


You can use public properties in your screen class to store and access data within different methods of the class. When a screen is displayed, the data returned from the `query` method will be automatically assigned to public properties of the same name.

For example, consider the following code:

```php
/**
 * @var string
 */
public $message;

public function query() : array
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

In this example, we have declared a public property called $message. When a `GET` request is made to the screen, the `query` method is executed, and the value of the message key in the returned array is assigned to the `message` property.

Then, in the `name` method, we return the value of the $message property. This means that when the screen is displayed, the page title will contain the words "Hello World!"

Using public properties in this way is a useful way to pass data between different methods of a screen class, and can be especially helpful when building complex screens with multiple layouts and views.

## Screen Actions

Screens include built-in commands that allow users to execute various actions. The `commandBar` method is responsible for defining these controls.

There are several types of actions available:


### Button

Button actions allow users to trigger a method on the screen when clicked. For example:

```php
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

public function commandBar() : array
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

In this example, when the Print button is clicked, the `print` method of the screen will be called. 
All of the data that the user has seen on the screen will be available in the request.

### Link

Link actions allow users to navigate to a different URL when clicked. For example:

```php
use Orchid\Screen\Actions\Link;

public function commandBar() : array
{
    return [
        Link::make('External reference')
            ->href('http://orchid.software'),
    ];
}
```

### Toggle

Toggle actions allow users to switch a boolean state interactively. They are designed specifically for tables and other UI elements where users need to quickly change a value. When clicked, the toggle calls a method on the screen and can update the value without leaving the context.

```php
use Orchid\Screen\Actions\Toggle;
use Orchid\Screen\TD;

// Example: displaying toggle in a table column
TD::make('Enabled')->render(function(User $user) {
    return Toggle::make('Enabled')
        ->method('switch', ['user' => $user])
        ->status($user->active);
});
```

**Recommendation:** For the smoothest experience, use the following configuration:

```
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

public function commandBar() : array
{
    return [
        ModalToggle::make('Modal window')
            ->modal('CreateUserModal')
            ->method('save'),
    ];
}
```

## Duplicate Actions

In software development, it is common for similar actions to be performed across multiple screens or classes. For example, an action such as deleting an object may be needed on both a pagination screen and a details screen. Instead of duplicating the method in both classes, it is more efficient to utilize the concept of inheritance.

PHP offers the powerful feature of inheritance, where a base class can be created for an entity, with defined access rights and methods. These can then be inherited by specific screens, allowing for reusability and reducing the need for redundant code. This not only improves the efficiency of the development process but also makes the code more maintainable and easier to understand.


## Calling a Screen Method

When working within a screen in Laravel Orchid, all UI actions have a corresponding method that is executed when called. To explicitly call a desired method from JavaScript or a Blade template, a `POST` request must be made to a specific route. The `method` property must be specified in the attributes using the `route('platform.screen.name', ['method' => 'hello'])` helper.


For example, to call the `hello` method on the `platform.screens.users` screen, the following code can be used:

```blade
<form action="{{ route('platform.screens.users', ['method' => 'hello']) }}"
      method="POST"
>
    @csrf
    <button type="submit">Say "Hello, World!"</button>
</form>
```

This will send a `POST` request to the 'platform.screens.users' screen with a method attribute of `hello`, which will trigger the corresponding method on the server-side.


You can also use this with the UI buttons:


```php
use Orchid\Screen\Actions\Button;

Button::make('Say "Hello, World!"')
    ->action(route('platform.screens.users', [
        'method' => 'hello',
    ]));
```

## Screen Layouts


Layouts are responsible for the screen's appearance, that is, how and in what form the data will be displayed.

Separation of logic and presentation is one of the design principles with Laravel Orchid.
One of the elements of the presentation are "Layouts" (layouts), which can be displayed in various variations.
If you try to explain briefly, it turns out that this is a `view` on steroids.

In most cases, we use the same type of elements to form a page, for example, imagine a block that displays the name, signature and profile avatar:


```html
<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
	<span class="thumb-sm avatar m-r-xs">
        <img src="/avatar/maria.jpg" class="bg-light" alt="Maria">
    </span>
    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
        <h6 class="mb-0">Maria</h6>
        <p class="text-muted mb-1">maria@exaple.com</p>
    </div>
</div>
```

A simple display of a block with a profile can appear on dozens of pages, and if they are copied, then maintaining their appearance can take a lot of time. Therefore, various reuse options are being worked out. This is called a component approach, regardless of the delivery method and level of responsibility, it is practiced both in Blade and in `React/Vue/Angular`.

It is precisely such components that the platform layers consist of, the only difference is that it is necessary to operate with the classes, creating which you explicitly determine that the accepted parameter `avatar` will be inserted in the `<img>` tag, without having to edit the source code every time.

Each layout may include a different layout, that is, nesting.
For example, the screen is divided into two columns. In the left-field for filling, on the right, there are a reference table and a graph.
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

Sometimes you will want to use the same layout for different things. To reduce code duplication, you can create a configurable design.
To pass custom parameters to your layout you can use the class constructor to handle them:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;

class ReusableLayout extends Rows
{
    public function __construct(
        private readonly string $prefix,
        private readonly string $title
    ) {}

    /**
     * Define the fields for the layout.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            new Label('label')
                ->title($this->title),

            new Input($this->prefix . '.address')
                ->required()
                ->title('Address')
                ->placeholder('177A Bleecker Street'),
        ];
    }
}
```

Instances can be used in the same way, but they can accept parameters

```php
public function layout(): array
{
    return [
        new ReusableLayout('order.shipping_address', 'Shipping Address'),
        new ReusableLayout('order.invoice_address', 'Invoice Address'),
    ];
}
```


More details can be found in the `Layouts` section.


## Additional Methods

#### Validation Message

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

```php
/**
 * Determines whether to prevent data loss on navigation attempt.
 */
public function needPreventsAbandonment(): bool
{
    return false;
}
```

No one wants to lose the data they just entered. To prevent this, this method triggers a mechanism that blocks refreshing or navigating away from the current page if changes have been made to the data on it.

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

This method returns the name of the base Stimulus controller for the frontend. It is crucial for managing the behavior of UI elements and interacting with other components via Hotwire.
