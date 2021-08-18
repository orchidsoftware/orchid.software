---
title: Фильтры
description: Фильтры служат для упрощения поиска записей с использованием типичного фильтра.
extends: _layouts.documentation
section: main
lang: ru
---

Фильтры служат для упрощения поиска записей с использованием типичного фильтра.
Например, если вы хотите отфильтровать каталог продуктов по атрибутам, брендам и т.п.
Выборка значений основана на параметрах Http запросов.

> Это не является готовым решением или универсальным средством, 
вы должны расширить структуру для своих конкретных приложений.

## Автоматическая HTTP фильтрация и сортировка

Для реагирования на HTTP параметры, модель должна включать в себя `Filterable`, а так же определение доступных
атрибутов:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filter\Filterable;

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

Использование заключается в вызове метода `filters`:

```php
Post::filters()->defaultSort('id')->paginate();
```

Как будет реагировать фильтрация:

```php
http://example.com/demo?filter[id]=1
$model->where('id', '=', 1)


http://example.com/demo?filter[id]=1,2,3,4,5
$model->whereIn('id', [1,2,3,4,5]);


http://example.com/demo?filter[content.ru.name]=dwqdwq
$model->where('content->ru->name', 'like', 'dwqdwq');

```

Как будет реагировать сортировка:

```php
http://example.com/demo?sort=content.ru.name
$model->orderBy('content->ru->name', 'asc');

http://example.com/demo?sort=-content.ru.name
$model->orderBy('content->ru->name', 'desc');
```

Отличным способом будет использовать такую сортировку в таблицах. Для того чтобы заголовки колонки стали активными, используйте:

```php
use Orchid\Screen\TD;

TD::make('name')->sort();
```


## Классический фильтр

Для создания нового фильтра существует команда:

```php
php artisan orchid:filter QueryFilter
```

Это создаст класс фильтр в папке `app/Http/Filters`


Пример фильтра:
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

Фильтр сработает, при условии наличия хотя бы одного параметра указанного в массиве `$parameters`. 
Если массив будет пуст, то фильтр будет работать при каждом запросе.

> **Примечание.** Вы можете использовать одни и те же фильтры для разных поведений.


Для использования фильтров в собственных моделях, 
требуется подключить трейт `Orchid\Filter\Filterable` и передавать в функцию `filtersApply` массив классов:

```php
use App\Model;

Model::filtersApply([Filter::class])->simplePaginate();
```

Возможно использование целой группы фильтров объединённых в слой `Selection`:

```php
Model::filtersApplySelection(RoleSelection::class)->simplePaginate();
```

Тогда все фильтры установленные в слое будут применены.

Для удобного отображения и объединения фильтров используйте слой "[Selection](https://orchid.software/ru/docs/grouping/#nabor-filtrov)".

