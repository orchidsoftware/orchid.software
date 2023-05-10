---
title: Global Search
description: Learn how to use Laravel Orchid's global search feature powered by Laravel Scout to easily search and filter through large amounts of data in your administration-style applications.
---

## Using Full-Text Search

Orchid provides full-text search capabilities through the [Laravel Scout](https://github.com/laravel/scout) package.
This package offers an abstraction for searching through your `Eloquent` models and requires that you specify the search driver that you will use for your application. 
These can be elasticsearch, algolia, sphinx, or other solutions.

To make your models searchable within the application, you must register them in the Orchid [configuration file](/en/docs/configuration). 
You can do this by adding a new entry to the 'search' array for each model you want to make searchable. For example:

```php
'search' => [
    \App\Models\Idea::class,
],
```

> This example uses [presenters](/en/docs/presenters), it is highly recommended that you familiarize yourself with them. And also, take steps to configure the model from the documentation [Laravel Scout](https://github.com/laravel/scout).


The [Presenter](/en/docs/presenters) is used to display the search results, which calls the `presenter()` method of the model:


```php
namespace App;

use App\Orchid\Presenters\IdeaPresenter;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use Searchable;

    /**
     * Get the presenter for the model.
     *
     * @return IdeaPresenter
     */
    public function presenter()
    {
        return new IdeaPresenter($this);
    }
    
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

In the representatives, we indicate the `Searchable` interface and define methods that will return values for a display to the user, for example like this:


```php
namespace App\Orchid\Presenters;

use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class IdeaPresenter extends Presenter implements Searchable
{
    /**
     * @return string
     */
    public function label(): string
    {
        return 'Ideas';
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->entity->name;
    }

    /**
     * @return string
     */
    public function subTitle(): string
    {
        return 'Small descriptions';
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return url('/');
    }

    /**
     * @return string
     */
    public function image(): ?string
    {
        return null;
    }
    
    /**
     * @param string|null $query
     *
     * @return Builder
     */
    public function searchQuery(string $query = null): Builder
    {
        return $this->entity->search($query);
    }
    
    /**
     * @return int
     */
    public function perSearchShow(): int
    {
        return 3;
    }
}
```


## Customizing Search Queries

To customize search queries, you can override the default `searchQuery()` method. 
This method returns a `Builder` instance representing the query used to index the model.


```php
public function searchQuery(string $query = null): Builder
{
    return $this->entity->search($query)->where('active', true);
}
```

Here, in the `searchQuery()` method, the `where()` method was used to limit the search to only active models
