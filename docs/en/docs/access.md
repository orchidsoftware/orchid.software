---
title: Permissions
description: Typically, you manage several dozen permits in a typical business process.
---

Usually, users are not assigned permissions in the application (although this is available), but rather roles. The role is associated with the permission set, not with the individual user.

> **Note.** Permissions are not a substitute for `Gate` or `Policies` included in the framework frame.

Typically, you manage several dozen permits in a typical business process.
You can also have, say, 10 to 100 users.
Although these users are not entirely different from each other,
You can divide them into logical groups according to what they do with the program.
These groups are called roles.

If you needed to manage users directly by assigning them permissions,
it would be tedious and erroneous
due to a large number of users and permissions.


- You can group one, two, or more permissions in a role.
- The user is assigned one or more roles.
- A set of permissions owned by the user,
 calculated as a combination of permissions from each user role.


## Usage

Method `hasAccess` will strictly require passed permission to be valid to grant access.

```php
// Check is carried out both for the user and for his role
Auth::user()->hasAccess($string);
```

Method `hasAnyAccess` will grant access if any permission passes the check.

```php
$user = User::find(1);

if ($user->hasAnyAccess(['user.admin', 'user.update'])) {
    // Execute this code if the user has permission
}
```

> **Note.** Permissions can be checked based on wildcards using the `*` character to match any set of permissions.

```php
$user = User::find(1);

if ($user->hasAccess('user.*')) {
    // Execute this code if the user has permission
}
```

The user has several options for managing roles:

```php
// Get all user roles
Auth::user()->getRoles();

// Check whether the user has a role
Auth::user()->inRole($role);

// Add role to user
Auth::user()->addRole($role);
```

In rare cases, you may need to take users who have permission directly or through a role. To do this, you can use:

```php
User::byAccess('platform.systems.users')->get();

// Or if the user has at least one of the passed permissions
User::byAnyAccess([
   'platform.systems.users',
   'non existent',
])->get();
```

## Roles

Roles also have procedures for:

```php
// Returns all users with this role.
$role->getUsers();
```


## Admin Creation

To create a user with the maximum (at the time of creation) rights, run the following command:

```php
php artisan orchid:admin nickname email@email.com secretpassword
```

To give the existing user the maximum permissions, run with the `--id` option:

```php
php artisan orchid:admin --id=1
```


## Add your own permissions


You can define your own permissions in applications.
 Using them, you explicitly implement access to certain functions.

An example of adding your own permissions using a provider:

```php
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('modules')
            ->addPermission('analytics', 'Access to data analytics')
            ->addPermission('monitor', 'Access to the system monitor');

        $dashboard->registerPermissions($permissions);
    }
}
```

## Roles vs Permissions

It is generally best to code your app around permissions only.

Roles can still be used to group permissions for easy assignment, and you can still use the role-based helper methods if truly necessary. But most app-related logic can usually be best controlled using the can methods, which allows Laravel's Gate layer to do all the heavy lifting.

eg: `users` have `roles`, and `roles` have `permissions`, and your app always checks for `permissions`, not `roles`.


## Check-in Screens

Each created screen already has a built-in permission check set using the property
`$permission`, which accepts both an array and a string value for verification:

```php
namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class History extends Screen
{
    /**
     * Display header name.
     *
     * @return string
     */
    public function name(): ?string
    {
        return 'History';
    }

    /**
     * Display header description.
     *
     * @return string
     */
    public function description(): ?string
    {
        return 'History of changes to system objects';
    }

    /**
     * Permission
     *
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'systems.history'
        ];
    }
        
    // ...
}
```

If several keys are listed, access will be granted if the user has at least one permission.

If there is no access, the static method `unaccessed` will be called, which by default will show a `403` error. You can override this response, e.g. to redirect a payment page or return a different response:

```php
use Illuminate\Http\RedirectResponse;

/**
 * @return \Illuminate\Http\RedirectResponse
 */
public static function unaccessed(): RedirectResponse
{
    return redirect('/other-screen');
}
```


## Check-in Middleware

Small applications may not need to define permissions for each screen or class,
instead, it makes sense to check their availability for routes.
To do this, register a new `middleware` in `app/Http/Kernel`:

```php
/**
 * The application's route middleware.
 *
 * These middleware may be assigned to groups or used individually.
 *
 * @var array
 */
protected $routeMiddleware = [
    //...
    'access' => \Orchid\Platform\Http\Middleware\Access::class,
];
```

After that, it can be used for any route definitions, by passing the parameter `access:my-permission`, just like in `Auth::user()->hasAccess($string);`


```php
Route::screen('/stories', StoriesScreen::class)
    ->middleware('access:systems.history');
```

You can also group them into groups:

```php
Route::middleware(['access:systems.history'])->group(function () {
    Route::screen('/stories', StoriesScreen::class);
    Route::get('stories/best', function () {
        // ...
    });
});
```

## Check-in Blade

For applications that rely on Blade templating to render, it will be convenient to add ["Custom If Statements"](https://laravel.com/docs/8.x/blade#custom-if-statements) as follows:

```php
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

/**
 * Bootstrap any application services.
 *
 * @return void
 */
public function boot()
{
    Blade::if('hasAccess', function (string $value) {
        $user = Auth::user();

        if ($user === null) {
            return false;
        }

        return $user->hasAccess($value);
    });
}
```

Once the custom conditional has been defined, you can use it within your templates:

```html
@hasAccess('platform.index')
    <!-- User has permission 'platform.index' -->
@elsehasAccess('platform.other')
    <!-- User does not have permission 'platform.index', but has 'platform.other' -->
@else
    <!-- User does not have permission 'platform.index' and 'platform.other'  -->
@endhasAccess

@unlesshasAccess('platform.index')
    <!-- User does not have permission 'platform.index' -->
@endhasAccess
```

## User Impersonation

A great feature is the ability to impersonate other users. As an administrator, you can view all screens as if you were logged in as a different user. It allows you to spot an issue that your user might report easily.

By default, the inherited user model already has the required one. But if you want to add to another model, then for this, you need to add the trait `Orchid\Access\UserSwitch`.

Impersonate another user:

```php
Auth::user()->loginAs($otherUser);
```

Stop impersonating another user:

```php
Auth::user()->logout();
```

In order to check whether the user is posing as someone else, use:

```php
if (Auth::user()->isSwitch()) {
    // User impersonates someone else
}
```
