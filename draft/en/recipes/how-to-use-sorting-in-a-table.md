---
title: Как использовать сортировку в таблице?
description: Typically, you manage several dozen permits in a typical business process.
extends: _layouts.page
section: main
---

# Как использовать сортировку в таблице?


Сортировка в таблице полностью основана на автоматическом распозновании Http запроса и применима к моделям Eloquent.

Рассмотрим это на пустой модели `Idea`:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Idea extends Model
{
    use AsSource;

    //
}
```

Необходимо добавить трейт `Filterable` и определить разрешённые поля для сортировки:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Idea extends Model
{
    use AsSource, Filterable;

    /**
     * Name of columns to which http sorting can be applied
     * 
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
}
```

Теперь при вызове метода `filters` запрос к базе данных будет модифицирован.
В методе источника данных у экрана, это может выглядеть следующим образом:

```php
/**
 * Query data
 *
 * @return array
 */
public function query() : array
{
    return [
        'ideas' => Idea::filters()->defaultSort('id')->paginate(),
    ];
}
```

Теперь даныне будет различными в зависимости от параметров в `url` адресе, например:

* `http://example.com/yourScreen?sort=id` - результом будут записи по возрастанию идентифицирующего номера
* `http://example.com/yourScreen?sort=-id` - Сортировка по убыванию

> ** Обратите внимание. ** Таким способом вы не можете сортировать связанные модели.


Для того чтобы отобразить в графическом интерфейсе возможность сортировки, мы должны добавить метод `sort`

```php
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class IdeaListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'ideas';

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            TD::set('id', 'ID')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->sort(),
            //...
        ];
    }
}
```


После этого заголовок колонки будет реагировать на нажатие и менять положение сортировки.