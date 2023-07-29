---
title: Eloquent Filters
description: Learn how to use the Eloquent Filters feature in Laravel Orchid to easily filter and search your database records. Improve the user experience of your administration-style app with powerful and customizable filters.
---

Filters used to simplify the search for records using a typical filter.
For example, if you want to filter the product catalog by attributes, brands, etc.
The sample values based on the Http request parameters.

> **Note.** This is not a ready-made solution or a universal remedy.
You must expand the structure for your specific applications.


## Eloquent Filter

When you need to create complex queries, you can use Eloquent filters, which allow you to manage yourself completely.
There is an artisan command to create a new filter:

```php
php artisan orchid:filter EmailFilter
```

This will create a class filter in the `app/Http/Filters` folder. Filter example:

```php
namespace App\Http\Filters;

use Orchid\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class EmailFilter extends Filter
{

    /**
     * @var array
     */
    public $parameters = ['email'];

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('email', $this->request->get('email'));
    }

    /**
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

When you need to display filters and apply them to a model, it is more convenient to group them by creating a separate layer, "Selection".
To make, run the command:

```php
php artisan orchid:selection MySelection
```

In this class, there is one single method in which it is necessary to list all filters that should be displayed and applied, for example:

```php
namespace App\Orchid\Layouts;

use Orchid\Platform\Filters\Filter;
use Orchid\Press\Http\Filters\CreatedFilter;
use Orchid\Press\Http\Filters\SearchFilter;
use Orchid\Screen\Layouts\Selection;

class MySelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
          SearchFilter::class,
          CreatedFilter::class
        ];
    }
}
```


After that, we can apply it to the model:

```php
Model::filters(MySelection::class)->simplePaginate();
```

Since this is a layer, it can also be used to display fields on the screen:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        MySelection::class,
    ];
}
```



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


