---
title: Upgrade Guide
extends: _layouts.documentation
section: main
lang: en
---


We like to keep things as modern as possible and have a "release early, release often" approach to major releases. Meaning, we won't wait an arbitrary number of months to accumulate big changes and release the next major version. By releasing major versions often, new features will be out earlier, and upgrading between versions will be much easier.

> We try to document all possible breaking changes. Some of these changes are internal calls, so only some of these changes may actually affect your application.

## Upgrading to 10.0 from 9.x

### Updating dependencies

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

### Updating dependencies

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

### Updating dependencies

In your `composer.json` file, update the `orchid/platform` dependency to `^8.0`

### TinyMCE editor

The `HTML` editor has been removed from the standard distribution. The code has been moved to a separate [repository](https://github.com/orchidcommunity/TinyMCE).

### Settings model

The settings model has also been removed. Data stored in the database will not be deleted automatically.
To remove them, you need to execute the following `SQL` code:

If you copied migration `2015_12_02_181214_create_table_settings` in project - don't forget delete it.

```php
DROP TABLE settings;

DELETE FROM migrations
WHERE migration = '2015_12_02_181214_create_table_settings';
```

The source code is available for installation as a separate [package](https://github.com/tabuna/settings).

### Bread crumbs

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

### Screen changes

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

#### Data spoofing (Async)

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

### Release message

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

