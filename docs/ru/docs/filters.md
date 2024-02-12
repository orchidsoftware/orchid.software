---
title: Фильтры
description: Фильтры служат для упрощения поиска записей с использованием типичного фильтра.
---

Фильтры служат для упрощения поиска записей с использованием типичного фильтра.
Например, если вы хотите отфильтровать каталог продуктов по атрибутам, брендам и т.п.
Выборка значений основана на параметрах Http запросов.

> Это не является готовым решением или универсальным средством, 
вы должны расширить структуру для своих конкретных приложений.


## Классический фильтр

Для создания более сложных запросов, вы можете использовать фильтры Eloquent, которые позволяют вам полностью управлять собой. 
Существует команда для создания нового фильтра:


```php
php artisan orchid:filter QueryFilter
```

Это создаст класс фильтра в папке `app/Http/Filters`. Пример фильтра:

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
     * @return Field[]
     */
    public function display() : array
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

Фильтр сработает при наличии хотя бы одного параметра, указанного в массиве `$parameters`. 
Если массив будет пуст, то фильтр будет работать при каждом запросе.

> **Примечание.** Вы можете использовать одни и те же фильтры для разных моделей.


Для использования фильтров в собственных моделях, 
требуется подключить трейт `Orchid\Filter\Filterable` и передавать в функцию `filtersApply` массив классов:

```php
use App\Model;

Model::filters([Filter::class])->simplePaginate();
```

## Selection

Когда вам нужно отобразить фильтры и применить их к модели, их удобнее сгруппировать, создав отдельный слой «Selection». 
Для создания нового слоя выполните команду:

```php
php artisan orchid:selection MySelection
```

В этом классе есть один-единственный метод, в котором необходимо перечислить все фильтры, которые должны отображаться и применяться, например:

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


После этого мы можем применить его к модели:

```php
Model::filters(MySelection::class)->simplePaginate();
```

Поскольку это слой, его также можно использовать для отображения полей на экране:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        MySelection::class,
    ];
}
```


## Автоматическая HTTP фильтрация и сортировка

Для реагирования на HTTP параметры, модель должна включать в себя `Filterable`, а так же определение доступных
атрибутов:

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

Использование заключается в вызове метода `filters`:

```php
Post::filters()->defaultSort('id')->paginate();
```

> **Примечание.** Автоматические HTTP фильтры не будут работать с отношениями. 
>Если вас это интересует, вы можете использовать классический фильтр, описанный выше.


Как будет реагировать сортировка на HTTP параметры:

```php
http://example.com/demo?sort=content
$model->orderBy('content', 'asc');

http://example.com/demo?sort=-content
$model->orderBy('content', 'desc');
```

Отличным способом будет использовать такую сортировку в таблицах. Для того чтобы заголовки колонки стали активными, используйте:

```php
use Orchid\Screen\TD;

TD::make('name')->sort();
```


Автоматическая сортировка и фильтрация HTTP запросов не будут работать с полями моделей, полученными через связи. Если вам необходима сортировка или фильтрация по таким полям, вы можете воспользоваться сторонними пакетами, например [Eloquent Power Joins](https://github.com/kirschbaum-development/eloquent-power-joins). С его помощью можно решить эту проблему:

```php
User::orderByPowerJoins('profile.city');
User::orderByPowerJoins('profile.city', 'desc');
```

Однако вам потребуется самостоятельно написать обработчик для HTTP-параметров sort и filter, так как пакет не автоматически распознает, что знак "-" перед названием поля означает порядок сортировки "desc", а также каким образом применять фильтры. Вы можете сделать это используя "Фильтр". Кроме того, следует использовать методы пакета только в случае сортировки или фильтрации по полям, доступным через связи.
