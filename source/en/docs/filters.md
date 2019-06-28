---
title: Filters
description: Filters are used to simplify the search for records using a typical filter.
extends: _layouts.documentation.en
section: main
---

Filters are used to simplify the search for records using a typical filter.
For example, if you want to filter the product catalog by attributes, brands, etc.
The sample values are based on the Http request parameters.

This is not a ready-made solution or a universal remedy.
You must expand the structure for your specific applications.

## Creation

To create a new filter there is a command:

```php
php artisan orchid:filter QueryFilter
```

This will create a class filter in the `app/Http/Filters` folder.


Filter example:
```php
namespace App\Http\Filters;

use Orchid\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class QueryFilter extends Filter
{

    /**
     * @var array
     */
    public $parameters = ['query'];

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('demo', $this->request->get('query'));
    }

    /**
     * @return Field
     */
    public function display(): Field
    {
        return Input::make('query')
            ->type('text')
            ->value($this->request->get('query'))
            ->placeholder('Search...')
            ->title('Search');
    }
}
```

The filter will work, provided there is at least one parameter specified in the array `$parameters`,
if the array is empty, then the filter will work on every request.

> **Note.** You can use the same filters for different models.

## Use

To use filters in your own models,
you need to connect the trait `Orchid\Filter\Filterable` and pass an array of classes to the` filtersApply` function:

```php
use App\Model;

Model::filtersApply([
   Filter::class,
])->simplePaginate();
```

It is possible to use a whole group of filters merged into the `Selection` layer, through:

```php
Model::filtersApplySelection(RoleSelection::class)->simplePaginate();
```

Then all filters installed in the layer will be applied.


## Automatic HTTP Filtering and Sorting

To respond to HTTP parameters, the model must include `Filterable`, as well as the definition of available
attributes:


```php
use Filterable;


/**
 * @var
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
 * @var
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

```

### Use

```php
Post::filters()->defaultSort('id')->paginate();
```

How filtering will react:

```php
http://example.com/demo?filter[id]=1
$model->where('id', '=', 1)


http://example.com/demo?filter[id]=1,2,3,4,5
$model->whereIn('id', [1,2,3,4,5]);


http://example.com/demo?filter[content.ru.name]=dwqdwq
$model->where('content->ru->name', '=', 'dwqdwq');

```

How sorting will respond:

```php
http://example.com/demo?sort=content.ru.name
$model->orderBy('content.ru.name', 'asc');

http://example.com/demo?sort=-content.ru.name
$model->orderBy('content.ru.name', 'desc');
```

