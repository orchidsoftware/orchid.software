---
title: Upgrade Guide
description: Learn how to upgrade your Laravel Orchid application with the Upgrade Guide. Find tips and best practices for smoothly transitioning to the latest version.
---


## Support Policy

At Laravel Orchid, we aim to provide our users with the best possible support for our package. To ensure that we can provide efficient support, we will only provide support for the latest major release of our package. This includes bug fixes and security updates.

We recommend that you use the latest version of Laravel Orchid in your projects to take advantage of the latest features, bug fixes, and security updates.

If you have any questions or concerns about our support policy, please do not hesitate to contact us.

## Release Strategy

We believe in keeping our package up-to-date and modern, and therefore follow a "release early, release often" approach for major releases. This means that we won't wait an extended period of time to release a new major version. By releasing major versions more frequently, new features will be available sooner, and upgrading between versions will be more manageable.

> We try to document all possible breaking changes. Some of these changes are internal calls, so only some of these changes may actually affect your application.


## Upgrading to 14.0 from 13.x

Upgrading Laravel Orchid from version `13.x` to `14.0` can be a straightforward process if done correctly.

Before starting the upgrade process, it is important to backup your existing application and test the upgrade process in a development environment. This will ensure that any unexpected issues can be identified and addressed before affecting the production environment.

### Updating Dependencies

In your `composer.json` file, update the `orchid/platform` dependency to `^14.0`

### Laravel 10.x

Laravel 10 is now required to install or upgrade. Update descriptions for existing projects can be found in the [documentation](https://laravel.com/docs/10.x/upgrade).

### Preserving State

One of the main new features of the release is the ability to save the states of public properties between actions on the screen.

Let's take an example. While viewing the screen in the `query` method, we can set public properties that will be accessible in the `name/layouts` methods and others.

Now, these public properties will be saved and available for the execution methods.

```php
public $idea;

public function query() : array
{
    return [
        'idea' => Idea::first()
    ];
}

public function yourMethod()
{
    $this->idea; 
    // The property is not empty and contains
    // the value that was set at the beginning.
}
```

### Route Binding

For a long time, Orchid has been using its own solution for defining route arguments.
However, for the vast majority of methods (query/method), the same solution as with Controller is used.
This allows you to define:

```php
Route::screen('/posts/{post:slug}', ExampleScreen::class);

Route::screen('/task', ExampleScreen::class)->withTrashed();
```

It also provides other opportunities that were not explicitly tied to what you're used to.

> Please note that in the past, our tutorials sometimes specified the default model, which sometimes resulted in an empty parameter.
> However, this now triggers a 404 error.

### Listener

Previously, working with Listeners could sometimes confuse users. 
Therefore, Listeners no longer have a property that specifies the screen method.
Instead, there is a mandatory default method called `handler`.
The current state of the screen is passed as the first argument to this method, and the `request` object is passed as the second argument.

```php
namespace App\Orchid\Layouts;

use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class SubtractListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'minuend',
        'subtrahend',
    ];

    /**
     * @return Layout[]
     */
    protected function layouts(): iterable
    {
        return [
            Layout::rows([
                Input::make('minuend')
                    ->title('First argument')
                    ->type('number'),

                Input::make('subtrahend')
                    ->title('Second argument')
                    ->type('number'),

                Input::make('result')
                    ->readonly()
                    ->canSee($this->query->has('result')),
            ]),
        ];
    }

    /**
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        [$minuend, $subtrahend] = $request->all();

        return $repository
            ->set('minuend', $minuend)
            ->set('subtrahend', $subtrahend)
            ->set('result', $minuend - $subtrahend);
    }
}
```


### Automatic HTTP Filtering and Sorting

The automatic filters were previously based on the type of data entered by the user, which often led to errors.
For example, when the user used a comma to search for text, the filter would sometimes recognize it as an array.
Therefore, filters now need to specify their behavior explicitly:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Post extends Model
{
    use Filterable;

    protected $allowedFilters = [
        'id' => Where::class,
        'content' => Like::class,
    ];
}
```

Another important change is that we now obtain the column name as-is. Therefore, you can no longer use dot notation for JSON fields.
We are working on finding a more efficient and safer way to handle JSON fields in the future.

### Navigation

In version 14.0, the profile drop-down menu has been removed. 
Instead, it is suggested to specify the profile information in the main menu or on the screens. 
Please make sure to remove any references to the `Dashboard::MENU_PROFILE` constant and the `registerProfileMenu` method for the service provider from your code.

For example, the following item will no longer work correctly:

```php
public function registerProfileMenu(): array
{
    return [
        Menu::make('Documentation')
            ->title('Docs')
            ->icon('docs')
            ->url('https://orchid.software/en/docs'),
    ];
}
```

Instead, pen your menu items using the `registerMenu` method:

```php
public function registerMenu(): array
{
    return [
        Menu::make('Documentation')
            ->title('Docs')
            ->icon('docs')
            ->url('https://orchid.software/en/docs'),
    ];
}
```

All methods that depend on `location` no longer need this argument. For example, the `addMenuSubElements` method now points directly to the target slug:

```php
use Orchid\Support\Facades\Dashboard;

Dashboard::addMenuSubElements('sub-menu', [
    Menu::make('Sub element item 3')->icon('badge')
]);
```


### Icons

In the new version, the icons have been updated to a set from Bootstrap.
While replacing all the icons in existing applications can be a challenge,
you have the option to continue using the icons from Orchid.

To do this, simply add the following line to your `composer.json` file:

```bash
"orchid/icons": "^2.0",
```

And then specify in your configuration file:

```php
'icons' => [
    'orc' => \Orchid\IconPack\Path::getFolder(),
],
```

By doing this, you will continue to use the set of icons from Orchid, which has not been updated for some time due to a lack of a designer.

For the new icons to be displayed as well, add:

```php
'icons' => [
    // ...
    'bs' => \Orchid\Support\BootstrapIconsPath::getFolder(),
],
```

### Logout and Quit Impersonation

The behavior of the "Logout" and "Quit Impersonation" actions must be explicitly defined by the developer. 
To do this, you can add button definitions to your profile screen.

Here's an example of how you can define these buttons:

```php
use Orchid\Screen\Actions\Button;
use Orchid\Access\Impersonation;

public function commandBar(): iterable
{
    return [
        Button::make('Back to my account')
            ->canSee(Impersonation::isSwitch())
            ->icon('bs.people')
            ->route('platform.switch.logout'),

        Button::make('Sign out')
            ->icon('bs.box-arrow-left')
            ->route('platform.logout'),
    ];
}
```

- The first button, "Back to my account", is used to exit impersonation and return to the original user account. This button will only be visible if the user is currently impersonating another account. 
- The second button, "Sign out", is used to log out of the platform.

By specifying the behavior of these buttons yourself, you have more control over the exit and quit impersonation actions in your Orchid application.

## Upgrading to 13.0 from 12.x

### Updating Dependencies

In your `composer.json` file, update the `orchid/platform` dependency to `^13.0`

### jQuery

There is no longer a default jQuery package in this release. If you need it, then you can install it separately, for example by adding a reference to it in the configuration file:

```php
'resource' => [
    'stylesheets' => [],
    'scripts'     => [
        'https://code.jquery.com/jquery-3.6.0.min.js'
    ],
],
```

### Select2

Since `select2` had a `jQuery` dependency, it was also replaced with the `tom-select` package. We tried to keep the behavior where possible. But `select2` special JS events are no longer available.



## Upgrading to 12.0 from 11.x

### Updating Dependencies

In your `composer.json` file, update the `orchid/platform` dependency to `^12.0`

### Laravel 9.x

Laravel 9 is now required to install or upgrade. Update descriptions for existing projects can be found in the [documentation](https://laravel.com/docs/9.x/upgrade).

## Upgrading to 11.0 from 10.x

### Updating Dependencies

In your `composer.json` file, update the `orchid/platform` dependency to `^11.0`

### Publish Assets Files

Instead of creating a symbolic link to download resources, there is a new command to publish them:

```bash
php artisan orchid:publish
```

Which would place the `JS/CSS` files in the `public/vendor/orchid` directory. It will also be required to automate making changes to composer.json:

```json
{
    "scripts": {
        "post-update-cmd": [
            "@php artisan orchid:publish --ansi"
        ]
    }
}
```

### Icons

Icons can now be completely replaced and are not forced to load. To continue using them, change the configuration file:

```php
'icons' => [
    'orc' => \Orchid\IconPack\Path::getFolder(),
],
```

### Screen

Public screen properties are now auto-filled with values by key from the `query()` method. For instance:

```php
class IdeaScreen extends Screen
{
    public $name = 'Edit User';

    public function query(): array
    {
        return [
            'name' => 'Welcome',
        ];
    }
}
```

The value of the `name` property will be overwritten.
To avoid this, change the visibility of the property to `protected`

```php
class IdeaScreen extends Screen
{
    protected $name = 'Edit User';

    public function query(): array
    {
        return [
            'name' => 'Welcome',
        ];
    }
}
```


### Component

Specifying the expected argument name for components is no longer necessary:

```php
// before
TD::make('index')->component(OrderShortInformation::class, 'order', [
    'limit' => 100
]);

// after
TD::make('index')->component(OrderShortInformation::class, [
    'limit' => 100
]);
```


### Metrics

Instead of a separate class, the short syntax is now applied:

```php
use Orchid\Support\Facades\Layout;

public function query(): array
{
    return [
        'metrics' => [
            'sales'    => ['value' => number_format(6851), 'diff' => 10.08],
            'total'    => number_format(65661),
        ],
    ];
}
    
public function layout(): iterable
{
    return [
        Layout::metrics([
            'Sales Today'    => 'metrics.sales',
            'Total Earnings' => 'metrics.total',
        ]),
    ];
}
```


## Upgrading to 10.0 from 9.x

### Updating Dependencies

In your `composer.json` file, update the `orchid/platform` dependency to `^10.0`

### Menu

Sections of the menu have been reduced, the system menu has been removed. Constants are now in the class `Orchid\Platform\Dashboard`.

```php
use Orchid\Platform\Dashboard;

Dashboard::MENU_MAIN;
Dashboard::MENU_PROFILE;
```

Menus are now `Field` classes and have a unified syntax. Before:

```php
ItemMenu::label('Example screen')
    ->icon('monitor')
    ->route('platform.example')
    ->title('Navigation')
    ->badge(function () {
        return 6;
    });
```

After:
```php
use Orchid\Screen\Actions\Menu;

Menu::make('Example screen')
    ->icon('monitor')
    ->route('platform.example')
    ->title('Navigation')
    ->badge(function () {
        return 6;
    });
```

As you can see, the update should be very soft.
But the differences will also be, for example, the writing of nested elements will be more visual:

Before:

```php
ItemMenu::label('Dropdown menu')
    ->slug('example-menu')
    ->icon('code')
    ->withChildren(),

ItemMenu::label('Sub element item 1')
    ->place('example-menu')
    ->icon('bag'),

ItemMenu::label('Sub element item 2')
    ->place('example-menu')
    ->icon('heart'),
```

After:

```php
Menu::make('Dropdown menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag'),
        Menu::make('Sub element item 2')->icon('heart'),
    ]),
```

The default for sorting has been changed from 1000 to 0:

```php
Menu::make('Example screen')
    ->icon('monitor')
    ->route('platform.example')
    ->title('Navigation')
    ->sort(2),
```

This is also true for nested elements:

```php
Menu::make('Dropdown menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag')->sort(2),
        Menu::make('Sub element item 2')->icon('heart')->sort(0),
    ]),
```

For dynamic definition, you need to add a slug method in which to pass a unique string:

```php
Menu::make('Dropdown menu')
    ->slug('sub-menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag'),
        Menu::make('Sub element item 2')->icon('heart'),
    ]),
```

And then add new items in our own packages like:

```php
Dashboard::addMenuSubElements(Dashboard::MENU_MAIN, 'sub-menu', [
   Menu::make('Sub element item 3')->icon('badge')
]);
```

> **Warning.** If the menu is used deferred, then you need to follow the loading order

### CanSee


Now `Fields/Layouts/TD` and have a common trait. Without any restrictions. Now you can do this:

```php
Input::make()->canSee(false);
TD::make()->canSee(false);
Layout::rows([])->canSee(false);
```


But now the definition inside the layer is different

```php
// before
public function canSee(Repository $query): bool
{
    return ...;
}

// after
public function isSee(): bool
{
    return ...;
}
```

### Stimulus

The Stimulus framework has been updated to version 2.0. Backward compatibility was retained, but the controller names got rid of the prefixes:

```js
<!--  before: -->
<div data-controller="fields--checkbox">

<!--  after: -->
<div data-controller="checkbox">
```

### Turbo

The Turbolinks library has been updated to Turbo for more details here: https://turbo.hotwire.dev/

If you used your own js scripts, then it is recommended to read their changes. For example:

```js
// before
document.addEventListener("turbolinks:load", function() {
    // ...
})

// after
document.addEventListener("turbo:load", function() {
  // ...
})
```

### Compendium

The `Compendium` class has been removed. Recommend using a newer `Legend`.

### Collapse

The `Collapse` class has been removed.

## Upgrading to 9.0 from 8.x

### Updating Dependencies

In your `composer.json` file, update the `orchid/platform` dependency to `^9.0`

### Auth

The Laravel team has introduced new products [Jetstream](https://github.com/laravel/jetstream) and [Fortify](https://github.com/laravel/fortify), which replace the earlier [laravel/ui](https://github.com/laravel/ui). To ensure compatibility with various options, the dependency on `laravel/ui ha`s been removed. And with it, the ability to recover your password.

New products provide two-factor user authentication, as well as a view of the last active sessions. In order not to compete with them, the same features were removed from the package.

Although migrations have been removed, the data stored in the database will not be removed automatically. To dismiss them, you need to execute the following `SQL` code:

```php
ALTER TABLE "users"
    DROP COLUMN "last_login"
    DROP COLUMN "uses_two_factor_auth"
    DROP COLUMN "two_factor_secret_code"
    DROP COLUMN "two_factor_recovery_code";

DELETE FROM migrations
WHERE migration = '2020_06_07_184338_added_columns_for_2fa';
```

After that, you need to remove the column data from your user model.
If you copied migration `2020_06_07_184338_added_columns_for_2fa` in project - don't forget delete it.

------

## Upgrading to 8.0 from 7.x

### Updating Dependencies

In your `composer.json` file, update the `orchid/platform` dependency to `^8.0`

### TinyMCE Editor

The `HTML` editor has been removed from the standard distribution. The code has been moved to a separate [repository](https://github.com/orchidcommunity/TinyMCE).

### Settings Model

The settings model has also been removed. Data stored in the database will not be deleted automatically.
To remove them, you need to execute the following `SQL` code:

If you copied migration `2015_12_02_181214_create_table_settings` in project - don't forget delete it.

```php
DROP TABLE settings;

DELETE FROM migrations
WHERE migration = '2015_12_02_181214_create_table_settings';
```

The source code is available for installation as a separate [package](https://github.com/tabuna/settings).

### Bread Crumbs

Package `davejamesmiller/laravel-breadcrumbs` is replaced with `tabuna/breadcrumbs`
and should be installed automatically when the dependencies are updated.


> **Note:** It may be necessary to remove the boot cache files in the `bootstrap/cache` directory.

The syntax of the new package allows you to display breadcrumbs right in the route definition:

```php
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')->push(__('Example screen'));
    });
```

Alternatively, you can continue to use a separate file for them.
To do this, you need to download it to the service provider:

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        require base_path('routes/breadcrumbs.php');
    }
}
```

If you used full class names, then you need to replace them with similar ones:

```php
use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;
```

### Screen Changes

#### Constructor

Passing a `Request` object and calling the parent class is no longer necessary. Before:
```php
class PublicationScreen extends Screen
{
    public function __construct(Request $request, Locator $locator)
    {
        $this->request = $request;
        $this->locator = $locator;
    }
}
```

The definition now looks like this:

```php
class PublicationScreen extends Screen
{
    public function __construct(Locator $locator)
    {
        $this->locator = $locator;
    }
}
```

#### Route methods

Methods not used have been removed. It is no longer possible to access screens via the `PUT|PATCH|DELETE` methods, the call must use `GET|POSTS` to receive/send data.


```php
Method           | URI                                  | Name
-----------------+--------------------------------------+--------------
GET|HEAD|POST    | dashboard/idea/{method?}             | platform.idea
```

Now, screen methods awaiting a model, if not present, will implement an empty model as well as controllers. [More](https://github.com/orchidsoftware/platform/issues/1150).

#### Data Spoofing (Async)

The `{argument?}` Expectation has been removed from the address bar.
Now a separate route is used for the call:

```php
$this->router
    ->post('async/{screen}/{method?}/{template?}', [AsyncController::class, 'load'])
    ->name('async');
```

### Layouts

Each layer now inherits from the class `Orchid\Screen\Layout`, rather than from `Orchid\Screen\Layouts\Base`.

To declare layers via short syntax, the `Orchid\Support\Facades\Layout` facade should now be used instead of the `Orchid\Screen\Layout` class.

It was:
```php
use Orchid\Screen\Layout;

Layout::row([
     // ...
]);
```

Became:
```php
use Orchid\Support\Facades\Layout;

Layout::row([
     // ...
]);
```

### Release Message

A system message informed users that a new version of the package was released. But they have no way to update without the help of a developer.
This was more annoying than keeping the software up to date. Therefore, it was removed, if you used it (By default only on the first screen), then you should remove its call as well as the `blade` template. Screen call example:
```php
return [
    'status' => Dashboard::checkUpdate(),
];
```
Using a template in the screen:

```php
Layout::view('platform::partials.update');
```

### Icons

The icon display has been changed from `font` to `SVG` format.
Now the `->icon` methods do not accept the `css` value to be set, but the file name.
In most cases, you only need to remove the `icon-` prefix.

