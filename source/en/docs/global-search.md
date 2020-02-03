---
title: Global search
description: 
extends: _layouts.documentation.en
section: main
---

## Using Full-Text Search

The platform comes with a package [Laravel Scout](https://github.com/laravel/scout) which is an abstraction for full-text search in your `Eloquent` models. 
Since **`Scout` does not contain the search driver itself**, you need to supply and specify the required solution, these can be elasticsearch, algolia, sphinx or other solutions.

To use global search, you need to add a new treit `Orchid\Platform\Searchable` to the model, it already includes `Laravel Scout`.

As an example, a model might look like this:


```php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Searchable;

class Idea extends Model
{
    use Orchid\Platform\Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'photo', 'price'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
}
```

In order for the application to have information about which models should participate in the search, you must register them with the service provider:

```php
namespace App\Providers;

use App\Idea;
use Orchid\Platform\Dashboard;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $dashboard->registerGlobalSearch([
          Idea::class,
          //...Models
        ]);
    }
}
```


## Modifying Results

The search results may include the following parameters:
- **label** - Is a group, for example: news, users, etc.
- **titile** - Main lines of text, for example, last name and username
- **subTitile** - additional line, for example, position, status
- **url** - available link for transition/editing
- **avatar** - Images

By default, the specified attributes will be taken from the model. 
In order to determine which data will be transmitted, the methods with the `search` prefix specified in an explicit form, for example:

```php
/**
 * @return string
 */
public function searchLabel(): ?string;

/**
 * @return string
 */
public function searchTitle(): ?string

/**
 * @return string
 */
public function searchSubTitle(): ?string

/**
 * @return string
 */
public function searchUrl(): ?string

/**
 * @return string
 */
public function searchAvatar(): ?string
```

To modify queries, for example, to display only actual data in the results, you can modify the query using the method override:

```php
public function searchQuery(string $query = null) : LengthAwarePaginator
```
