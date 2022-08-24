---
title: Eloquent Filters
description: Filters used to simplify the search for records using a typical filter.
---

Filters used to simplify the search for records using a typical filter.
For example, if you want to filter the product catalog by attributes, brands, etc.
The sample values based on the Http request parameters.

> **Note.** This is not a ready-made solution or a universal remedy.
You must expand the structure for your specific applications.


## Automatic HTTP Filtering and Sorting

To respond to HTTP parameters, the model must include `Filterable`, as well as the definition of available
attributes:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Post extends Model
{
    use Filterable;

    /**
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'user_id',
        'type',
        'status',
        'content',
        'options',
        'slug',
        'publish_at',
        'created_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'user_id',
        'type',
        'status',
        'slug',
        'publish_at',
        'created_at',
        'deleted_at',
    ];
}
```

Usage is a method call `filters`:

```php
Post::filters()->defaultSort('id')->paginate();
```

> **Note.** Automatic HTTP filters will not work with relationships. If you are interested in these, you can use the Eloquent filter discussed below.


How filtering will react:

```php
http://example.com/demo?filter[id]=1
$model->where('id', '=', 1)

http://example.com/demo?filter[name]=A
$model->where('name', 'like', '%A%')


http://example.com/demo?filter[id]=1,2,3,4,5
$model->whereIn('id', [1,2,3,4,5]);

http://example.com/demo?filter[id][min]=1&filter[id][max]=5
$model->whereBetween('id', [1,5]);

http://example.com/demo?filter[id][]=1&filter[id][]=2&filter[id][]=3
$model->whereIn('id', [1,2,3]);


http://example.com/demo?filter[content.ru.name]=dwqdwq
$model->where('content->ru->name', 'like', 'dwqdwq');
```

> **Note.** Filter accomodates the `cast` of the model. This works with `bool`,`datetime` and `string` (and their aliases). To be able to filter for a number as substring (using `like` instead of exact match), make sure that it casts as a `string`. 


How sorting will respond:

```php
http://example.com/demo?sort=content.ru.name
$model->orderBy('content->ru->name', 'asc');

http://example.com/demo?sort=-content.ru.name
$model->orderBy('content->ru->name', 'desc');
```

HTTP filters or sorting do not have separate display templates. You can see an example of this [use in the table headers](/en/docs/table/#sorting).


## Eloquent filter

When you need to create more complex queries, you can use Eloquent filters, which allow you to manage yourself completely.
There is an artisan command to create a new filter:

```php
php artisan orchid:filter QueryFilter
```

This will create a class filter in the `app/Http/Filters` folder. Filter example:

```php
namespace App\Http\Filters;

use Orchid\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class QueryFilter extends Filter
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

The filter will work, provided there is at least one parameter specified in the array `$parameters`,
if the array is empty, then the filter will work on every request.

> **Note.** You can use the same filters for different models.

To use filters in your own models,
you need to connect the trait `Orchid\Filters\Filterable` and pass an array of classes to the `filtersApply` function:

```php
use App\Model;

Model::filters([Filter::class])->simplePaginate();
```


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



