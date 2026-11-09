---
title: Permissions
description: Register permissions and assign them to users and roles.
---

Permissions describe what a user can do. Roles group permissions for assignment. Check permissions in application
logic, and use Laravel policies for access to individual records. A hidden button or menu is not an authorization check.

## Register permissions

Add groups to the `permissions()` method of your application's Orchid service provider:

```php
use Orchid\Access\PermissionGroup;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    public function permissions(): array
    {
        return [
            PermissionGroup::make('Orders')
                ->add('orders.view', 'View orders')
                ->add('orders.update', 'Update orders'),
        ];
    }
}
```

For a regular Laravel service provider, inject `Orchid\Platform\Orchid` into `boot()` and call
`$orchid->registerPermissionGroup($group)` for each group. Static calls use `Orchid\Support\Facades\Orchid`.
Registering a permission makes it available for assignment; it does not grant it to existing users.

The built-in permission slugs include `orchid.users`, `orchid.roles`, and `orchid.attachment`.
The [upgrade guide](/en/docs/upgrade) explains how to migrate existing assignments from 14.x.

## Check access

```php
$user->hasAccess('orders.view');
$user->hasAnyAccess(['orders.view', 'orders.update']);
$user->hasAccess('orders.*');
```

`hasAccess()` checks direct and role permissions. A matching allowed permission in either set grants access.
A false direct permission does not override a grant from a role. `hasAnyAccess()` succeeds when any entry is allowed;
an empty list imposes no restriction. The wildcard in the check matches assigned permission names.

```php
use App\Models\User;

User::byAccess('orders.view')->get();
User::byAnyAccess(['orders.view', 'orders.update'])->get();
```

These query scopes check exact keys and do not support wildcards.
After changing assignments on an existing user instance, call `$user->clearCachePermission()` before checking again.
The `addRole()`, `removeRole()`, and `replaceRoles()` helpers invalidate this cache themselves.

## Permission values

User and Role cast `permissions` to `Orchid\Access\Permissions`. Assign a map or a Permissions object and save it:

```php
use Orchid\Access\Permissions;

$user->permissions = Permissions::make(['orders.view' => true]);
$user->save();

$user->permissions->isActive('orders.view');
$user->permissions->allows('orders.*');
$user->permissions->count();
$user->permissions->toArray();
```

`count()` counts allowed entries. `isEmpty()` checks whether any states are assigned, including denied states.
This object is not an array or a mutable Laravel collection. To edit a grant, update the map returned by `toArray()`,
then assign it back and save. Keep the inherited Permissions cast when extending the package models with `casts()`.

`Orchid::allowedPermissions()` returns a Permissions object containing all currently registered permissions.
For an authorized handler processing Orchid's permission checkbox payload, use
`Permissions::fromEncodedForm($request->input('permissions', []))` to decode its keys.
Only an appropriately authorized administrator should be allowed to change assignments.

## Roles

New installations use UUID role IDs and unique role names. There is no `slug` column.
Use Eloquent relationships instead of the removed `getRoles()`, `getUsers()`, `getRoleId()`, and `getRoleSlug()` helpers:

```php
use Orchid\Platform\Models\Role;

$role = Role::create([
    'name' => 'Editor',
    'permissions' => ['orders.view' => true, 'orders.update' => true],
]);

$user->addRole($role);
$user->roles()->get();
$user->inRole($role);
$role->users()->get();
$user->removeRole($role);
```

Read the key with `$role->getKey()` and its name with `$role->name`.
`inRole()` accepts a role model, ID, or name. Prefer a model when assigning and removing roles.
Existing databases need the [schema migration](/en/docs/upgrade#database-schema-and-identifiers) before using UUID models.

## Protect screens and routes

Define the screen's required permissions:

```php
public function permission(): ?iterable
{
    return ['orders.view'];
}
```

With several entries, any allowed permission grants access. The default denial response is HTTP 403.
Override the screen's static `unaccessed()` method to return a custom response.
Continue to authorize the specific record in action handlers and validate their submitted data.

For routes outside the configured Orchid middleware group, register the access alias in `bootstrap/app.php`:

```php
use Illuminate\Foundation\Configuration\Middleware;
use Orchid\Platform\Http\Middleware\Access;

// In bootstrap/app.php:
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias(['access' => Access::class]);
})
```

```php
Route::screen('/orders', OrderListScreen::class)->middleware('access:orders.view');
```

In Blade, check the authenticated user with `@if (auth()->user()?->hasAccess('orders.view'))`.

## Create an administrator

```shell
php artisan orchid:admin
php artisan orchid:admin --id=1
```

The command grants the permissions registered at that moment. Newly registered permissions must be assigned separately.
To customize user creation, register your User model with `Orchid::useModel()` and override its `createAdmin()` method.

## User impersonation

Authorize the impersonation action before switching users. The configured Orchid guard must be a session guard:

```php
use Orchid\Access\Impersonation;

Impersonation::loginAs($otherUser);
Impersonation::isImpersonating();
$originalUser = Impersonation::impersonator();
Impersonation::logout();
```
