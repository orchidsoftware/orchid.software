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


### Using Filters for Different Models

One of the great advantages of filters is that you can reuse the same filter class for different models.
This allows you to define a filter once and apply it to multiple models, reducing code duplication.
Simply specify the filter class when applying filters to your models:

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
php artisan orchid:selection MailingSelection
```

This command will generate a new PHP file called `MailingSelection` in the `App\Orchid\Layouts` directory.
Inside this class, you will find a single method called `filters()`. 
This method is where you should list all the filters that need to be displayed and applied.

For example, let's say you want to display and apply two filters: a email filter and a created filter.
Your `MailingSelection` class would look like this:

```php
namespace App\Orchid\Layouts;

use App\Orchid\Filters\EmailFilter;
use App\Orchid\Filters\CreatedFilter;
use Orchid\Screen\Layouts\Selection;

class MailingSelection extends Selection
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


Once you have defined your filters in the `MailingSelection` class, you can apply them to a model by using the `filters()` method. For example:

```php
Model::filters(MailingSelection::class)->simplePaginate();
```

By calling the `filters()` method on your model and passing `MailingSelection::class` as the argument, you can apply the filters defined in the `MailingSelection` class to the model.

### Displaying on a Screen

The "Selection" layer can also be used to display filters on a [screen](/en/docs/screens). 
In the `layout()` method of your screen, you can include the `MailingSelection` class to display the filters on the screen.
For example:

```php
use App\Orchid\Layouts\MailingSelection;

public function layout(): array
{
    return [
        MailingSelection::class,
    ];
}
```

> Please note that filters with empty fields will not be rendered, ensuring a clean and user-friendly interface.

### Customization with Templates

The appearance of the selection layer can vary, such as being displayed as a drop-down list (the default) or as a form. You can define this using the `template` property. For instance:

```php
class MailingSelection extends Selection
{
    public $template = self::TEMPLATE_DROP_DOWN; // or self::TEMPLATE_LINE
    
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
            //...
        ];
    }
}
```

Moreover, you have the flexibility to define your own `Blade` template within this property.


## Handling HTTP Parameters

To automatically filter and sort your application's data based on user-supplied HTTP parameters, the package provides a powerful and flexible set of tools.
The key to effectively utilizing these tools is to ensure that your model includes the `Filterable` trait and implements a whitelist of acceptable filter and sort parameters.

To make your `App\Models\Post` model filterable, follow these steps:

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
}
```

### Filtering

As mentioned before, any filtering action can only be performed on an allowed list of filters, which is specified using the `allowedFilters` property as a key-value pair. The key represents the name of your columns, and the value is the handling class. Here's an example:

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
}
```

Once you have specified the list, using automatic filtering is straightforward. Simply call the `filters()` method, for example:

```php
Post::filters()->paginate();
```

By leveraging this approach, you can easily apply filters to your query and paginate the results.

This code will automatically apply any filters or sorting rules that were included in the user's HTTP request.

#### Query Examples

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

### Sorting

To enable sorting functionality, you need to specify a list of columns in the `allowedSorts` property. This list represents the columns in your database table that can be used for sorting. Here's an example:


```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Post extends Model
{
    use Filterable;

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

Once you have defined the allowed sortable columns, you can easily enable sorting by calling the `filters()` method. This method will handle the sorting based on the provided HTTP parameter. For instance:

```php
Post::filters()->paginate();
```

Now, when you make an HTTP request, the sorting behavior will be as follows:

```php
http://example.com/demo?sort=created_at
$model->orderBy('created_at', 'asc');

http://example.com/demo?sort=-created_at
$model->orderBy('created_at', 'desc');
```

### Default Sorting


If you want to specify a default sorting order for your data, you can use the `defaultSort` method. This method allows you to set a default column for sorting when no specific sorting parameter is provided via the HTTP request. For example:

```php
Post::filters()->defaultSort('id')->paginate();
```

You can also specify the sort direction as a second parameter. For instance:

```php
Post::filters()->defaultSort('id', 'desc')->paginate();
```

Automatic sorting and filtering of HTTP requests will not work with fields of models obtained through relationships. If you need sorting or filtering based on such fields, you can use third-party packages, such as [Eloquent Power Joins](https://github.com/kirschbaum-development/eloquent-power-joins). This package can help you solve this issue:

```php
User::orderByPowerJoins('profile.city');
User::orderByPowerJoins('profile.city', 'desc');
```

However, you will need to manually handle the HTTP parameters `sort` and `filter`, as the package does not automatically recognize that the `-` sign before the field name indicates descending order for sorting, and also how to apply filters. You can do this using a "Filter." Additionally, you should only use the package methods for sorting or filtering based on fields accessible through relationships.

