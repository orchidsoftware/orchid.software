---
title: Global search
---

## Using Full-Text Search

The platform comes with a package [Laravel Scout](https://github.com/laravel/scout), which is an abstraction for full-text search in your `Eloquent` models. 
Since **`Scout` does not contain the search driver itself**, you need to supply and specify the required solution. These can be elasticsearch, algolia, sphinx, or other solutions.

> This example uses [presenters](/en/docs/presenters), it is highly recommended that you familiarize yourself with them. And also, take steps to configure the model from the documentation [Laravel Scout](https://github.com/laravel/scout).

In order for the application to have information about which models should participate in the search, it is necessary to register them with the service provider:


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
        $dashboard->registerSearch([
          Idea::class,
          //...Models
        ]);
    }
}
```

The results are displayed using the `presenter()` call on the object.

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


## Modifying Results

To modify queries, for example, to display only relevant data in the results, you can modify the query by overriding the method:


```php
public function searchQuery(string $query = null): Builder
{
    return $this->entity->search($query)->where('active', true);
}
```
