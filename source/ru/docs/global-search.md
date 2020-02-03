---
title: Глобальный поиск
description: 
extends: _layouts.documentation.ru
section: main
---

## Использование полнотекстового поиска

Платформа поставляется с пакетом [Laravel Scout](https://github.com/laravel/scout), который является абстракцией для полнотекстового поиска в ваши модели `Eloquent`. Так как **`Scout` не содержит самого «драйвера» поиска**, требуется поставить и указать требуемое решение, это могут быть elasticsearch, algolia, sphinx или другие решения.

Для использования глобального поиска требуется добавить новый трейт `Orchid\Platform\Searchable` к модели, он уже включает в себя `Laravel Scout`.

Как пример модель может выглядеть так:
```php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Searchable;

class Idea extends Model
{
    use Searchable;

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

Для того, что бы приложение имело информацию о том, какие модели должны учавствовать в поиске, необходимо зарегистрировать их в сервис провайдере:

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


## Модификация результатов

В результатах поиска могут быть указаны следующие параметры:
- **label** - Является группой, например: новости, пользователи и т.п.
- **titile** - Главная строка текста, например, фамилия и имя пользователя.
- **subTitile** - Дополнительная строка, например, должность, статус.
- **url** - Доступная ссылка для перехода/редактирования.
- **avatar** - Изображения.

По умолчанию из модели будут браться указанные атрибуты. Для того, что бы определить какие данные будут передаваться, указываются методы с префиксом `search` в явном виде, например:

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

Для модификации запросов, например, выдавать в результатах только актуальные данные, можно модифицировать запрос с помощью переопределения метода:

```php
public function searchQuery(string $query = null) : LengthAwarePaginator
```
