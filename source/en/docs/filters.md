---
title: Eloquent Filters
description: Filters used to simplify the search for records using a typical filter.
extends: _layouts.documentation
section: main
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

How filtering will react:

```php
http://example.com/demo?filter[id]=1
$model->where('id', '=', 1)


http://example.com/demo?filter[id]=1,2,3,4,5
$model->whereIn('id', [1,2,3,4,5]);


http://example.com/demo?filter[content.ru.name]=dwqdwq
$model->where('content->ru->name', 'like', 'dwqdwq');

```

How sorting will respond:

```php
http://example.com/demo?sort=content.ru.name
$model->orderBy('content->ru->name', 'asc');

http://example.com/demo?sort=-content.ru.name
$model->orderBy('content->ru->name', 'desc');
```


## Eloquent filter

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
    public $parameters = ['email'];

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('demo', $this->request->get('email'));
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

Model::filtersApply([Filter::class])->simplePaginate();
```

It is possible to use a whole group of filters merged into the `Selection` layer, through:

```php
Model::filtersApplySelection(RoleSelection::class)->simplePaginate();
```

Then all filters installed in the layer will be applied.

For display and join filters each others use layout "[Selection](https://orchid.software/en/docs/grouping/#selection)".
