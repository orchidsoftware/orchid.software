---
title: Upgrade to 15.x
description: Migrate a 14.x application to the current 15.x API.
---

## Upgrade from 14.x to 15.x

15.x is in development. Keep production applications on a released version until you have verified the changes below.
Back up your database and test the upgrade in a separate environment.

## Requirements and dependencies

Use PHP 8.3 or later and Laravel `^12.4 || ^13.0`. Laravel 10 and 11 are no longer supported.
When 15.0 is released, require `orchid/platform:^15.0` and update related dependencies together.
For a development installation, use the current development source rather than an unavailable stable tag.

## Database schema and identifiers

Existing 14.x databases require an application-specific data migration before they can use the new default models.
Changed package create-table migrations do not run again after Laravel has recorded them as applied.
`orchid:install` is not a converter for existing production data.

The new schema uses UUID primary keys for `roles` and `attachments`. `role_users.role_id` is a string,
`attachmentable.attachment_id` is a UUID foreign key, and `attachmentable.attachmentable_id` is a string.
The attachment pivot no longer needs its own `id`. Role `name` is unique and replaces the old `slug` field.

Plan and test forward migrations in your application:

1. Back up the database and inventory every reference to role and attachment IDs, including custom tables.
2. Create mappings from existing numeric IDs to UUIDs. Update the records, pivots, and application foreign keys together.
3. Resolve duplicate role names before adding their unique constraint. Replace code that depends on role slugs.
4. Check attachment names and paths before changing old text columns to strings. Preserve application metadata that
   previously used `description` or `alt`; those columns are absent from the new default create-table migration.
5. Verify role assignments, attachment ownership, uploads, downloads, and removals on a copy of production data.

Do not discard existing migrations, run `migrate:fresh`, or truncate identifiers to make the schema match.
If you retain custom key types, configure compatible custom models and relations before creating new records.

## Configuration, facade, and routes

| 14.x | 15.x |
| --- | --- |
| `config/platform.php` | `config/orchid.php` |
| `routes/platform.php` | `routes/orchid.php` |
| `platform` middleware group | `orchid` middleware group |
| `Orchid\Support\Facades\Dashboard` | `Orchid\Support\Facades\Orchid` |
| `Orchid\Platform\Dashboard` | `Orchid\Platform\Orchid` for container injection |
| `platform.main` | `orchid.main` |
| `platform.profile` | `orchid.profile` |
| `platform.systems.users` | `orchid.users` |
| `platform.systems.roles` | `orchid.roles` |
| `platform::` views | `orchid::` views |

Use `Orchid::` through the facade for static calls. Inject `Orchid\Platform\Orchid` when you need the kernel instance.
Update route declarations, menu links, authorization middleware, policies, stored permission keys, and custom templates.
Built-in user and role permissions use `orchid.users` and `orchid.roles`. File management uses `orchid.attachment`.
Custom permission slugs remain application-defined. Rename existing assignments together with their registrations.
The `PLATFORM_DOMAIN`, `PLATFORM_PREFIX`, and `PLATFORM_FILESYSTEM_DISK` environment names remain supported.

Republish resources with `php artisan orchid:publish`. Compare published views with the new package views before
restoring customizations. The old build output and manifest are not compatible with the new Vite assets.

## Presenters

Use `Orchid\Presenter\Presenter`, `Presentable`, and `UsePresenter`:

```php
use App\Orchid\Presenters\PostPresenter;
use Orchid\Presenter\Presentable;
use Orchid\Presenter\UsePresenter;

#[UsePresenter(PostPresenter::class)]
class Post extends Model
{
    use Presentable;
}
```

A child inherits the nearest presenter declaration. `presenter(OtherPresenter::class)` overrides one call.
Without either declaration or override, `presenter()` throws. Review presenters that depended on forwarding model
method calls. See [presenters](/en/docs/presenters) and the updated [search contract](/en/docs/global-search).

## URL filters and sort columns

Replace `$allowedFilters` and `$allowedSorts` with class attributes:

```php
use Orchid\Filters\AllowedFilters;
use Orchid\Filters\AllowedSorts;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;

#[AllowedFilters(['title' => Like::class])]
#[AllowedSorts(['title', 'created_at'])]
class Post extends Model
{
    use Filterable;
}
```

The old properties are no longer read. Migrate overrides on child models as well, or the parent's attribute applies.
Each list inherits independently. A child attribute replaces the complete list, and `[]` disables it.
See [URL filters](/en/docs/filters) for supported filter classes and examples.

## Local scopes

Orchid's local scopes now use Laravel's `Scope` attribute. Keep calls such as `Post::filters()` and
`User::countByDays()` unchanged. Migrate custom `scope...` overrides and direct parent calls to the new method names:

```php
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

#[Scope]
protected function published(Builder $query): void
{
    $query->whereNotNull('published_at');
}
```

A child overriding an Orchid scope must keep `#[Scope]` and call the corresponding unprefixed parent method.

## Model casts and permission values

User, Role, and Attachment declare casts through `casts()`. Extend them with `parent::casts()`:

```php
protected function casts(): array
{
    return [...parent::casts(), 'settings' => 'array'];
}
```

A legacy child `$casts` property does not override the same key returned by the parent's `casts()`.
Move such overrides to the method. User and Role permissions now use `Orchid\Access\Permissions`:

```php
use Orchid\Access\Permissions;
use Orchid\Support\Facades\Orchid;

$user->permissions = Orchid::allowedPermissions();
$user->save();

$user->permissions = Permissions::make(['orchid.users' => true]);
$user->save();

$states = $user->permissions->toArray();
```

Use `allows()` to check a value object, `toArray()` for an array, and `PermissionGroup::make()->add()` to register groups.
`Orchid::allowedPermissions()` replaces `Dashboard::getAllowAllPermission()`.
Use `Permissions::fromEncodedForm()` for Orchid's encoded permission checkbox input.
The removed `Orchid\Access\UserInterface` and `RoleInterface` contracts must not remain on custom models.
Extend the package models or use the relevant current access traits. See [permissions](/en/docs/permissions).

## Select replaces Relation

Replace `Relation` with `Select` and opt into lazy model choices:

```php
Select::make('user_id')
    ->lazy(20)
    ->fromModel(User::class, 'name')
    ->searchColumns('name', 'email')
    ->applyScope('active');
```

`lazy($chunk)` controls the remote page size. `max($count)` now limits the number of selected items.
Keep scopes that restrict tenant access. Existing selections are resolved for display.
`allowCreate()` is the preferred replacement for the deprecated `allowAdd()` name.
The old relation endpoint is replaced by choices handled by the field. See [Select](/en/docs/field#select).

## Editors and collection fields

`Markdown` replaces the SimpleMDE implementation. `SimpleMDE` remains a deprecated PHP alias.
Code and Markdown use CodeMirror. Remove old client-side editor plugins and unsupported configuration.
TextArea remains a native multiline input. The removed `Upload` field is replaced by `Attach`.

[KeyValue](/en/docs/field#keyvalue), [BlockEditor](/en/docs/field#blockeditor), and
[Repeater](/en/docs/field#repeater) provide map, structured document, and row-list editing.
Check their submitted data shapes before saving. Keep validation and authorization on the server.

## Charts

Orchid Charts replaces Frappe. Provide shared labels and datasets:

```php
return [
    'visits' => [
        'labels' => ['Mon', 'Tue'],
        'datasets' => [['name' => 'Visits', 'values' => [12, 18]]],
    ],
];

// In layout():
Layout::chart('visits', 'Visits')->type(Chart::TYPE_LINE)->height(300);
```

`Chartable` collections now return this complete shape from `toChart()`.
Move presentation properties to fluent methods or supported options. Frappe options and JavaScript APIs are removed.
Use [the chart reference](/en/docs/charts) to migrate mixed charts, markers, gradients, and generated subclasses.

## Navigation, dialogs, and notifications

Use [SideMenu](/en/docs/side-menu) for contextual navigation between related screens.
Dialog layouts support `Modal::SIZE_COMPACT` and `scrollable()`.
The notification panel operates through its dialog and read-state endpoints, not the old notification screen.
Use `OrchidMessage` and `OrchidChannel`. `DashboardMessage` and `DashboardChannel` remain deprecated aliases for
compatibility with stored notifications. Existing database notification records do not need to be rewritten.

Global search also uses a dialog. Remove links to the old search screen.
Review custom Stimulus controllers for `connect()` and `disconnect()` cleanup under Turbo.
The field and navigation controls now expose keyboard and focus behavior. Preserve that behavior in custom views.

## Screen state and tests

Screen state signs ordinary values and closures. Saved Eloquent models use model identifiers and reload from the
database. Keep `APP_KEY` stable across requests. The signed state is not an authorization decision: authorize actions
and validate submitted data on every request.

Update tests for the new route names and Permissions object. For package contributors, the test environment now uses
Testbench Workbench, PHPStan, and Rector. See [testing](/en/docs/testing).

## Other public API changes

Use `Orchid::permissionGroups()` instead of `Dashboard::getPermission()` when reading the permission catalog.
`Screen::asyncParticalLayout()` has been corrected to `asyncPartialLayout()`; update custom calls or overrides.
Use `Orchid\Screen\Concerns\CanSee` and `Orchid\Screen\Concerns\HasCommandBar` for the moved screen traits.
Prefer enum cases such as `Color::INFO` to the legacy `Color::INFO()` calls in new examples.
Check third-party Orchid packages for 15.x compatibility before upgrading them with the platform.

## Fluent layout objects

Declare standard layouts with `Rows::make()`, `Table::make()`, and the other factories listed in
[layout objects](/en/docs/layouts). Layout facade methods return those same concrete objects.

Change target-based calls from `Layout::table('users', $columns)` to `Layout::table($columns)->target('users')`.
The same change applies to `legend()` and `sortable()`. Table and Sortable reject a missing or empty data source.

Replace table presentation overrides with `striped()`, `compact()`, `bordered()`, `hoverable()`, and `onEachSide($count)`.
Use `totals($columns)` for footer cells and `emptyTitle()`, `emptyDescription()`, `emptyIcon()`, and `emptyAction()`
for empty states. SideMenu's old `label(): string` override becomes `->label('Settings')` or a protected string `$label`.

The `orchid:rows` and `orchid:table` commands and their published stubs are removed.
Named menu classes and their generators remain supported. Listener's class-based request handler is unchanged.
If a layout subclass defines a custom constructor, keep the parent signature or extract a factory that returns an object.

The constructors store `fields`, `columns`, `filters`, and `navigations` as protected arrays where applicable.
If a custom subclass already declares one of those properties, match the array type and visibility or rename its storage.
