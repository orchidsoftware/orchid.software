---
title: Глобальный поиск
description:
---

## Использование полнотекстового поиска

Платформа поставляется с пакетом [Laravel Scout](https://github.com/laravel/scout), который является абстракцией для полнотекстового поиска в ваши модели `Eloquent`. Так как **`Scout` не содержит самого «драйвера» поиска**, требуется поставить и указать требуемое решение, это могут быть elasticsearch, algolia, sphinx или другие решения.

> В этом примере используется [представители](/ru/docs/presenters), настоятельно рекомендуется ознакомится с ними. А так же произвести действия по настройки модели из документации [Laravel Scout](https://github.com/laravel/scout).

Для того чтобы приложение имело информацию о том, какие модели должны участвовать в поиске, необходимо зарегистрировать их в сервис провайдере:

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

Отображение результатов осуществляется с помощью вызова `presenter()` у объекта.

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

В представителе укажем интерфейс `Searchable` и определим методы, которые будут возвращать значения для показа пользователю, например так:

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

## Модификация результатов

Для модификации запросов, например, чтобы выдавать в результатах только актуальные данные, можно модифицировать запрос с помощью переопределения метода:

```php
public function searchQuery(string $query = null): Builder
{
    return $this->entity->search($query)->where('active', true);
}
```
