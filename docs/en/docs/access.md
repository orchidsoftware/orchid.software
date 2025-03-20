---
title: Permissions
description: Learn how to manage user permissions in your Laravel Orchid application with our comprehensive documentation on Permission. Easily control access to specific routes and actions with our intuitive interface. Get started now with our open-source package for rapid development of admin panels and dashboards.
---

In most cases, access is managed through **roles**, which are groups of **permissions**. Roles simplify access management by allowing you to assign roles to users instead of assigning permissions individually to each user. However, it is also possible to assign permissions directly.

> **Important:** Permissions do not replace Laravel's `Gate` or `Policies` mechanisms. These mechanisms are still essential for fine-grained access control.

In most applications with a large number of users and permissions, using **roles** is more efficient. It simplifies access management and reduces the risk of errors.

###### How Roles and Permissions Work:

- **A role** is a set of permissions.
- A **user** can be associated with one or more roles.
- A user's permissions are the union of all the permissions from their roles.

**Important:** While roles are useful for grouping permissions, the main focus should be on **permissions**. The application’s logic should check permissions using the `can` methods, not rely solely on roles. This allows Laravel’s `Gate` system to handle access control efficiently.

In summary, **roles** are used to group permissions, and access should always be checked based on **permissions**, not roles.

## Roles vs Permissions

For the best application architecture, design your app around **permissions**, not roles. Roles can still be used to group permissions for convenience, but the primary access control logic should use the `can` methods, which work seamlessly with Laravel's `Gate` system.

Example: users have **roles**, roles contain **permissions**, and your app always checks **permissions**, not **roles**.

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

In rare cases, you may need to take users who have permission directly or through a role. To do this, you can use:

```php
User::byAccess('platform.systems.users')->get();

// Or if the user has at least one of the passed permissions
User::byAnyAccess([
   'platform.systems.users',
   'non existent',
])->get();
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

## Roles

Roles also have procedures for:

```php
// Returns all users with this role.
$role->getUsers();
```


## Creating an Admin User via Console

To create a user with the maximum (at the time of creation) permissions, run the following command:

```php
php artisan orchid:admin
```

To give the existing user the maximum permissions, run with the `--id` option:

```php
php artisan orchid:admin --id=1
```

If you have added new mandatory columns for the user and need to modify the command to add corresponding values, first specify Orchid to use your model by adding the following code to the service provider:

```php
use Orchid\Support\Facades\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Dashboard::useModel(
            \Orchid\Platform\Models\User::class,
            \App\Models\User::class
        );
    }
}
```

Then override the `createAdmin` method in your `User` model:

```php
public static function createAdmin(string $name, string $email, string $password): void
{
    throw_if(static::where('email', $email)->exists(), 'User already exists');

    static::create([
        'name'        => $name,
        'email'       => $email,
        'password'    => Hash::make($password),
        'permissions' => Dashboard::getAllowAllPermission(),
    ]);
}
```

Now you can modify this method as per your requirements, and when executing the creation command, this method will be executed.

## Add Your Own Permissions


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

## Check-in Screens

Each created screen already has a built-in permission check set using method
`permission`, which accepts both an array and a string value for verification:

```php
namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class History extends Screen
{
    /**
     * The permissions required to access this screen.
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
    Route::get('/stories/best', function () {
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
    <!-- User has permission for the 'platform.index' action -->
@elsehasAccess('platform.other')
    <!-- User doesn't have permission for 'platform.index',
         but has permission for 'platform.other' -->
@else
    <!-- User doesn't have permission for both 'platform.index'
         and 'platform.other' -->
@endhasAccess

@unlesshasAccess('platform.index')
    <!-- User doesn't have permission for 'platform.index' -->
@endhasAccess
```

## User Impersonation

The `Orchid\Access\Impersonation` class provides developers with convenient functionality for logging in as another user. 
It allows administrators to impersonate other users in order to view and perform actions on their behalf.
This is useful for troubleshooting and resolving issues reported by users.

To switch to another user, use the `loginAs()` method:

```php
use Orchid\Access\Impersonation;

// Login as another user
Impersonation::loginAs($otherUser);
```

To revert back to the original user, call the `logout()` method:

```php
// Revert back to the original user
Impersonation::logout();
```

The `isImpersonating()` method checks if the impersonation has been performed:

```php
if (Impersonation::isImpersonating()) {
    // The user is impersonating another user
}
```

The `impersonator()` method returns information about the original user. If no impersonation has been performed, the method will return `null`:

```php
// Get information about the original user
$impersonator = Impersonation::impersonator();
```
