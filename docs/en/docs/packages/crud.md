---
title: Orchid CRUD for Laravel
description: Easily create a user interface for Laravel eloquent models with Orchid's new package. This simplified CRUD solution allows you to efficiently perform common database operations, including create, read, update, and delete. With seamless integration, you can describe the entire process using a single file and easily switch to using the Orchid platform for more advanced options. Compatible with all fields, filters, and traits.
---

## Introduction

Orchid has provided a unique experience for writing applications. Still, sometimes a simple CRUD needs to be done when it might seem overkill.
Therefore, we have created a new package aimed at developers who want to quickly create a user interface for eloquent models with functions such as creating,
reading, updating, and deleting.

You can describe the entire process using one file. And when you need more options, it's easy to switch to using the platform.
All fields, filters, and traits are compatible.

## Installation

> The manual assumes that you already have a copy of [Laravel](https://laravel.com/docs/installation) with [Orchid](https://orchid.software/en/docs/installation/)

You can install the package using the Сomposer. Run this at the command line:

```php
composer require orchid/crud
```

This will update `composer.json` and install the package into the `vendor/` directory.

## Defining Resources

Resources are stored in the `app/Orchid/Resources` directory of your application.
You may generate a new resource using the `orchid:resource` Artisan command:

```bash
php artisan orchid:resource PostResource
```

The most fundamental property of a resource is its `model` property.
This property tells the generator which Eloquent model the resource corresponds to:

```php
use App\Models\Post;

/**
 * The model the resource corresponds to.
 *
 * @var string
 */
public static $model = Post::class;
```

These classes are completely static. They don't have any state at all due to their declarative nature.
They only tell what to do. They don't hold any data. So if you add custom methods, make sure they're static.

Freshly created resources contain nothing. Don't worry. We'll add more fields to our resource soon.

## Registering Resources

All resources within the `app/Orchid/Resources` directory will automatically be registered by default.
You are not required to register them manually. But if this is required, for example, when creating an additional package, then the best way would be:

```php
use App\Orchid\Resources\UserResource;
use Illuminate\Support\ServiceProvider;
use Orchid\Crud\Arbitrator;

class CrudServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Arbitrator $arbitrator)
    {
        $arbitrator->resources([
            UserResource::class,
        ]);
    }
}
```

## Expanding of Model

Many features of the Orchid platform relies on model customization. You can add or remove traits depending on your goals. But we will assume that you have set these for your model:

```php
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource, Filterable, Attachable;
}
````

## Defining Fields

Each resource contains a `fields` method. This method returns an array of fields, which generally extend the `Orchid\Screen\Field` class. To add a field to a resource, we can add it to the resource's `fields` method. Typically, fields may be created using their static `make` method. This method accepts several arguments; however, you usually only need to pass the field's name.

```php
use Orchid\Screen\Fields\Input;

/**
 * Get the fields displayed by the resource.
 *
 * @return array
 */
public function fields(): array
{
    return [
        Input::make('title')
            ->title('Title')
            ->placeholder('Enter title here'),
    ];
}
```

In the package to generate CRUD, you can use the fields Orchid platform. Review [all available fields on the documentation site](https://orchid.software/en/docs/field/).

## Defining Сolumns

Each resource contains a `сolumns` method. To add a column to a resource, we can add it to the resource's `column` method. Typically, columns may be created using their static `make` method.

```php
use Orchid\Screen\TD;

/**
 * Get the columns displayed by the resource.
 *
 * @return TD[]
 */
public function columns(): array
{
    return [
        TD::make('id'),
        TD::make('title'),
    ];
}
```

The CRUD generation package is entirely based on the table layer. You can [read more about this on the documentation page](https://orchid.software/en/docs/table/).

## Defining Legend

Each resource contains a `legend` method. It determines how the model will look when viewed. To add to a resource, we can add it to the resource's `legend` method. Typically, columns may be created using their static `make` method.

```php
use Orchid\Screen\Sight;

/**
 * Get the sights displayed by the resource.
 *
 * @return Sight[]
 */
public function legend(): array
{
    return [
        Sight::make('id'),
        Sight::make('title'),
    ];
}
```

The CRUD generation package is entirely based on the legend layer. You can [read more about this on the documentation page](https://orchid.software/en/docs/legend).

## Defining Rules

Each resource contains a `rules` method. When submitting a create or update form, the data can be validated, which is described in the `rules` method:

``` php
/**
 * Get the validation rules that apply to save/update.
 *
 * @return array
 */
public function rules(Model $model): array
{
    return [
        'slug' => [
            'required',
            Rule::unique(self::$model, 'slug')->ignore($model),
        ],
    ];
}
```

You can learn more on the Laravel [validation page](https://laravel.com/docs/validation#available-validation-rules).

## Defining Filters

Each resource contains a `filters` method. Which expects you to return a list of class names that should be rendered and, if necessary, swapped out for the viewed model.

``` php
/**
 * Get the filters available for the resource.
 *
 * @return array
 */
public function filters(): array
{
    return [];
}
```

To create a new filter, there is a command:

```bash
php artisan orchid:filter QueryFilter
```

This will create a class filter in the `app/Http/Filters` folder. To use filters in your own resource, you need:

```php
public function filters(): array
{
    return [
        QueryFilter::class
    ];
}
```

We already offer some prepared filters:

- `Orchid\Crud\Filters\DefaultSorted` - Setting default column sorting
- `Orchid\Crud\Filters\WithTrashed` - To display deleted records

```php
public function filters(): array
{
    return [
        new DefaultSorted('id', 'desc'),
    ];
}
```

You can learn more on the Orchid [filtration page](https://orchid.software/en/docs/filters/#eloquent-filter).

## Navigation

If you do not want a resource to appear in the navigation, you may override the `displayInNavigation` method of your resource class:

```php
/**
 * Get the resource should be displayed in the navigation
 *
 * @return bool
 */
public static function displayInNavigation(): bool
{
    return false;
}
```

## Eager Loading

Suppose you routinely need to access a resource's relationships within your fields. In that case, it may be a good idea to add the relationship to the `with` property of your resource. This property instructs to always eager to load the listed relationships when retrieving the resource.

```php
 /**
 * Get relationships that should be eager loaded when performing an index query.
 *
 * @return array
 */
public function with(): array
{
    return ['user'];
}
```

## Pagination

To define how many results should be shown per page, set the `perPage` method:

```php
/**
 * Get the number of models to return per page
 *
 * @return int
 */
public static function perPage(): int
{
    return 30;
}
```

## Resource Events

Each resource has two methods that do the processing, `onSave` and `onDelete`. Each of them is launched when the event is executed, and you can change or supplement the logic:

``` php
use Orchid\Crud\ResourceRequest;
use Illuminate\Database\Eloquent\Model;

/**
 * Action to create and update the model
 *
 * @param ResourceRequest $request
 * @param Model           $model
 */
public function onSave(ResourceRequest $request, Model $model)
{
    $model->forceFill($request->all())->save();
}

/**
 * Action to delete a model
 *
 * @param Model $model
 *
 * @throws Exception
 */
public function onDelete(Model $model)
{
    $model->delete();
}
```

## Permissions Resources

Each resource contains a `permission` method, which should return the string key that the user needs to access this resource. By default, all resources are available to every user.

```php
/**
 * Get the permission key for the resource.
 *
 * @return string|null
 */
public static function permission(): ?string
{
    return null;
}
```

For each registered resource in which the method returns a non-null value, a new permission is created.

```php
/**
 * Get the permission key for the resource.
 *
 * @return string|null
 */
public static function permission(): ?string
{
    return 'private-post-resource';
}
```

It is necessary to give the right to manage it to the user.
To click on the profile in the left column, go to the system page, and then to the page with users,
you can issue them a mandate or assign a role. After that, they will be displayed in the left menu.

## Actions

Actions may be generated using the `orchid:action` Artisan command:

```bash
php artisan orchid:action CustomAction
```

By default, all actions are placed in the `app/Orchid/Actions` directory. The action necessarily consists of two methods. Method `button` defines name, icon, dialog box, etc. And the `handler` method directly handles the action with the models.

```php
namespace App\Orchid\Actions;

use Illuminate\Support\Collection;
use Orchid\Crud\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class CustomAction extends Action
{
    /**
     * The button of the action.
     *
     * @return Button
     */
    public function button(): Button
    {
        return Button::make('Run Custom Action')->icon('bs.fire');
    }

    /**
     * Perform the action on the given models.
     *
     * @param \Illuminate\Support\Collection $models
     */
    public function handle(Collection $models)
    {
        $models->each(function () {
            // action
        });

        Toast::message('It worked!');
    }
}
```

Within the `handle` method, you may perform whatever tasks are necessary to complete the action.

> The handle method always receives a `Collection` of models, even if the action is only being performed against a single model.

Once you have defined an action, you are ready to attach it to a resource. Each resource contains an actions method. To attach an action to a resource, you should add it to the array of actions returned by this method:

```php
/**
 * Get the actions available for the resource.
 *
 * @return array
 */
public function actions(): array
{
    return [
        CustomAction::class,
    ];
}
```

## Policies

To limit which users may view, create, update, or delete resources leverages Laravel's [authorization policies](https://laravel.com/docs/authorization#creating-policies). Policies are simple PHP classes that organize authorization logic for a particular model or resource. For example, if your application is a blog, you may have a `Post` model and a corresponding `PostPolicy` within your application.

Typically, these policies will be registered in your application's `AuthServiceProvider`. If CRUD detects a policy has been registered for the model, it will automatically check that policy's relevant authorization methods before performing their respective actions, such as:

- viewAny
- view
- create
- update
- delete
- restore
- forceDelete

No additional configuration is required! So, for example, to determine which users are allowed to update a `Post` model, you need to define an `update` method on the model's corresponding policy class:

```php
namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the post.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return true;
    }
}
```

> If a policy exists but is missing a particular action method, the user will not be allowed to perform that action. So, if you have defined a policy, don't forget to define all of its relevant authorization methods.

If you don't want the policy to affect CRUD generation users, you may wish to authorize all actions within a given policy. To accomplish this, define a `before` method on the policy. Before any other policy methods, the before method will be executed, allowing you to authorize the action before the intended policy method is actually called.

```php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->hasAccess('private-post-resource')) {
            return true;
        }
    }
}
```

## Preventing Conflicts (Traffic Cop)

If this option is active, the model will be checked for the last change if it was updated after the edit form was opened. A validation error will be thrown. Feature Traffic Cop is disabled by default.

```php
/**
 * Indicates whether should check for modifications
 * between viewing and updating a resource.
 *
 * @return  bool
*/
public static function trafficCop(): bool
{
    return false;
}
```

## Description

To display an additional description on each page of the resource, use the `description`:

```php
/**
 * Get the descriptions for the screen.
 *
 * @return null|string
 */
public static function description(): ?string
{
    return null;
}
```

## Breadcrumbs

On every page of the resource, there are breadcrumbs. You can monitor messages using the following methods:

```php
/**
 * Get the text for the list breadcrumbs.
 *
 * @return string
 */
public static function listBreadcrumbsMessage(): string
{
    return static::label();
}

/**
 * Get the text for the create breadcrumbs.
 *
 * @return string
 */
public static function createBreadcrumbsMessage(): string
{
    return __('New :resource', ['resource' => static::singularLabel()]);
}

/**
 * Get the text for the edit breadcrumbs.
 *
 * @return string
 */
public static function editBreadcrumbsMessage(): string
{
    return __('Edit :resource', ['resource' => static::singularLabel()]);
}
```

## Localization

Resource names may be localized by overriding the `label` and `singularLabel` methods on the resource class:

``` php
/**
 * Get the displayable label of the resource.
 *
 * @return string
 */
public static function label()
{
    return __('Posts');
}

/**
 * Get the displayable singular label of the resource.
 *
 * @return string
 */
public static function singularLabel()
{
    return __('Post');
}
```

Action buttons and notifications can also be translated, for example:

```php
/**
 * Get the text for the create resource button.
 *
 * @return string|null
 */
public static function createButtonLabel(): string
{
    return __('Create :resource', [
        'resource' => static::singularLabel()
    ]);
}

/**
 * Get the text for the create resource toast.
 *
 * @return string
 */
public static function createToastMessage(): string
{
    return __('The :resource was created!', [
        'resource' => static::singularLabel()
    ]);
}
```

You can learn more on the [Laravel localization page](https://laravel.com/docs/localization).
