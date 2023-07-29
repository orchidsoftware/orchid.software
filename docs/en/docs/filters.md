---
title: Eloquent Filters
description: Learn how to use the Eloquent Filters feature in Laravel Orchid to easily filter and search your database records. Improve the user experience of your administration-style app with powerful and customizable filters.
---

## Introduction

Eloquent Filters are powerful tools for creating complex queries in Laravel. 
They allow you to easily manage and customize your search criteria.
You can use Eloquent filters to filter your product catalog based on attributes, brands, and other criteria.

To create a new Eloquent filter, you can use the `php artisan orchid:filter` command followed by the desired filter name.
This command will generate a new filter class in the `app/Orchid/Filters` folder.

Here's an example of creating an `EmailFilter`:

```php
php artisan orchid:filter EmailFilter
```

The generated filter class will look like this:

```php
namespace App\Http\Filters;

use Orchid\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class EmailFilter extends Filter
{
    /**
     * The array of matched parameters.
     *
     * @var array
     */
    public $parameters = ['email'];

    /**
     * Apply filter if the request parameters were satisfied.
     * 
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('email', $this->request->get('email'));
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Input::make('email')
                ->type('text')
                ->value($this->request->get('email'))
                ->placeholder('Search...')
                ->title('Search')
        ];
    }
}
```

To use filters in your own models,
you need to connect the trait `Orchid\Filters\Filterable` and pass an array of classes to the `filtersApply` function:

```php
use App\Model;

Model::filters([EmailFilter::class])->simplePaginate();
```

> **Note.** You can use the same filters for different models.

### Using Filters for Different Models

One of the great advantages of Eloquent Filter is that you can reuse the same filter class for different models. This allows you to define a filter once and apply it to multiple models, reducing code duplication. Simply specify the filter class when applying filters to your models:

```php
User::filters([EmailFilter::class])->simplePaginate();

Customer::filters([EmailFilter::class])->simplePaginate();
```


### Running the Filter Always

By default, filters are applied only when the corresponding parameters are specified.
However, if you want a filter to run on every request, you can leave the `$parameters` property as an empty array in your filter class.
This way, the filter will be applied to all queries. For instance:

```php
public $parameters = [];
```

### Parameter Patterns

Filter provides the capability to define parameter patterns using a convenient syntax.
This allows you to create custom patterns and perform advanced filtering based on specific patterns. For example:

```php
/**
 * The array of matched parameters.
 *
 * @var null|array
 */
public $parameters = [
    'pattern.*',
];
```

In the above example, the filter will match any parameter that follows the pattern `pattern.*`. This allows you to handle a wide range of dynamic parameters in your filters.

## Selection

The "Selection" layer provides a convenient way to group and organize filters for both displaying and applying them to a model. 
This layer acts as an intermediary between the user interface and the model, simplifying the process of managing filters.

To create a "Selection" layer, you can use the following command:

```shell
php artisan orchid:selection MySelection
```

This command will generate a new PHP file called `MySelection` in the `App\Orchid\Layouts` directory.
Inside this class, you will find a single method called `filters()`. 
This method is where you should list all the filters that need to be displayed and applied.

For example, let's say you want to display and apply two filters: a email filter and a created filter.
Your `MySelection` class would look like this:

```php
namespace App\Orchid\Layouts;

use App\Orchid\Filters\EmailFilter;
use App\Orchid\Filters\CreatedFilter;
use Orchid\Screen\Layouts\Selection;

class MySelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
          EmailFilter::class,
          CreatedFilter::class
        ];
    }
}
```


Once you have defined your filters in the `MySelection` class, you can apply them to a model by using the `filters()` method. For example:

```php
Model::filters(MySelection::class)->simplePaginate();
```

By calling the `filters()` method on your model and passing `MySelection::class` as the argument, you can apply the filters defined in the `MySelection` class to the model.

The "Selection" layer can also be used to display filters on a [screen](/en/docs/screens). 
In the `layout()` method of your screen, you can include the `MySelection` class to display the filters on the screen.
For example:

```php
use App\Orchid\Layouts\MySelection;

public function layout(): array
{
    return [
        MySelection::class,
    ];
}
```

> Please note that filters with empty fields will not be rendered, ensuring a clean and user-friendly interface.


## Automatic HTTP Filtering and Sorting

To automatically filter and sort your application's data based on user-supplied HTTP parameters, package provides a powerful and flexible set of tools.
The key to using these tools effectively is to ensure that your model includes the `Filterable` trait, and implements a whitelist of acceptable filter and sort parameters.

For example, here's how you might set up an `App\Models\Post` model to be filterable:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDate;
use Orchid\Filters\Types\WhereMaxMin;
use Orchid\Filters\Types\WhereDateStartEnd;

class Post extends Model
{
    use Filterable;

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id'            => Where::class,
        'user_id'       => WhereIn::class,
        'rating'        => WhereMaxMin::class,
        'content'       => Like::class,
        'publish_at'    => WhereDate::class,
        'created_at'    => WhereDateStartEnd::class,
        'deleted_at'    => WhereDateStartEnd::class,
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'user_id',
        'rating',
        'publish_at',
        'created_at',
        'deleted_at',
    ];
}
```
Once your model is properly configured, using the filter and sort functionality is as simple as a method call to `filters()`, like so:

```php
Post::filters()->defaultSort('id')->paginate();
```
This code will automatically apply any filters or sorting rules that were included in the user's HTTP request.

In order to use this feature effectively, it's important to have a solid understanding of how the HTTP parameters are translated into database queries. For example:

```php
http://example.com/demo?filter[id]=1
$model->where('id', '=', 1)
```
This query will apply a `where` clause to the `id` column of your model, filtering out any records that don't match the value provided by the user.

```php
http://example.com/demo?filter[name]=A
$model->where('name', 'like', '%A%')
```
This query will apply a `like` clause to the `name` column of your model, searching for any records that contain the letter "A" in their name.

```php
http://example.com/demo?filter[id]=1,2,3,4,5
$model->whereIn('id', [1,2,3,4,5]);
```

This query will apply a `wherein` clause to the `id` column of your model, filtering for any records that match one of the specified IDs.

```php
http://example.com/demo?filter[id][min]=1&filter[id][max]=5
$model->whereBetween('id', [1,5]);
```

This query will apply a `wherebetween` clause to the `id` column of your model, filtering for records where the ID is between 1 and 5.

```php
http://example.com/demo?filter[id][]=1&filter[id][]=2&filter[id][]=3
$model->whereIn('id', [1,2,3]);
```

This query will apply a `whereIn` clause to the `id` column of your model, filtering for records where the ID is one of the specified values.

```php
http://example.com/demo?filter[rating][min]=1&filter[rating][max]=5
$model->where('rating', '>=', 1)
    ->where('rating', '<=', 5);
```

This query will apply two separate `where` clauses to the `rating` column of your model, filtering for records where the rating is between 1 and 5.

```php
http://example.com/demo?filter[rating][min]=1
$model->where('rating', '>=', 1);
```

This query will apply a single `where` clause to the `rating` column of your model, filtering for records where the rating is greater than or equal to 1.

```php
http://example.com/demo?filter[publish_at]=2023-02-02
$model->where('publish_at', '2023-02-02')
```

This query will apply a single `where` clause to the `publish_at` column of your model, filtering for records where the `publish_at` date is exactly equal to February 2, 2023.

```php
http://example.com/demo?filter[created_at][start]=2023-01-01&filter[created_at][end]=2023-02-02
$model->whereDate('created_at', '>=', '2023-01-01')
    ->whereDate('created_at', '<=', '2023-02-02');
```

This query will apply two separate `whereDate` clauses to the `created_at` column of your model, filtering for records where the `created_at` date falls within the specified range.

```php
http://example.com/demo?filter[created_at][start]=2023-01-01
$model->whereDate('created_at', '>=', '2023-01-01')
```

This query will apply a single `whereDate` clause to the `created_at` column of your model, filtering for records where the `created_at` date is greater than or equal to January 1, 2023.


<!--
http://example.com/demo?filter[content.ru.name]=dwqdwq
$model->where('content->ru->name', 'like', 'dwqdwq');


> **Note.** Filter accomodates the `cast` of the model. This works with `bool`,`datetime` and `string` (and their aliases). To be able to filter for a number as substring (using `like` instead of exact match), make sure that it casts as a `string`. 


How sorting will respond:

```php
http://example.com/demo?sort=content.ru.name
$model->orderBy('content->ru->name', 'asc');

http://example.com/demo?sort=-content.ru.name
$model->orderBy('content->ru->name', 'desc');
```
-->

> HTTP filters or sorting do not have separate display templates. You can see an example of this [use in the table headers](/en/docs/table/#sorting).


