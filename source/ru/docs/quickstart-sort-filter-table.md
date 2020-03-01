---
title: Сортировка и фильтрация в таблице
description: Laravel CRUD
extends: _layouts.documentation.ru
section: main
---

Это руководство продолжение учебника ["Управление данными"](/ru/docs/quickstart-crud/), в котором мы будем разбирать работу с очень простой "Сортировкой и фильтрацией".

Сортировка в таблице полностью основана на автоматическом распознавании `Http` запроса и применима к моделям `Eloquent`. Для того, что бы включить его необходимо добавить трейт `Filterable` и определить разрешённые колонки:


```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource, Attachable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'body',
        'author',
        'hero'
    ];

    /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'title',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hero()
    {
        return $this->hasOne(Attachment::class, 'id', 'hero');
    }
}
```

Теперь при вызове метода `filters` запрос к базе данных будет модифицирован.
В методе источника данных у экрана `PostListScreen`, это  будет выглядеть следующим образом:

```php
/**
 * Query data.
 *
 * @return array
 */
public function query(): array
{
    return [
        'posts' => Post::filters()->defaultSort('id')->paginate()
    ];
}
```

Теперь даныне будет различными в зависимости от параметров в `url` адресе, например:

* `http://localhost:8000/dashboard/posts?sort=id` - результом будут записи по возрастанию идентифицирующего номера
* `http://localhost:8000/dashboard/posts?sort=-id` - Сортировка по убыванию

> ** Обратите внимание. ** Таким способом вы не можете сортировать связанные модели.


Для того, что бы отобразить в графическом интерфейсе возможность сортировки мы должны вызвать метод `sort` для небходимых колонок таблицы в `PostListLayout`:

```php
namespace App\Orchid\Layouts;

use App\Post;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class PostListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'posts';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::set('title', 'Title')
                ->sort()
                ->render(function (Post $post) {
                    return Link::make($post->title)
                        ->route('platform.post.edit', $post);
                }),

            TD::set('created_at', 'Created')
                ->sort(),

            TD::set('updated_at', 'Last edit')
                ->sort(),
        ];
    }
}
```


После этого заголовок колонки будет реагировать на нажатие и менять положение сортировки.


Трейт `Filterable`, позволяет устанавливать не только сортировку, но и простую `Http` фильтрацию, для её установки вернёмся к модели и добавим новое свойство:
 
 ```php
/**
 * Name of columns to which http filter can be applied
 *
 * @var array
 */
protected $allowedFilters = [
    'title',
];
 ```
 
 А затем вызовем новый метод для колонки с заголовком:
 
 ```php
 TD::set('title', 'Title')
    ->sort()
    ->filter(TD::FILTER_TEXT)
    ->render(function (Post $post) {
        return Link::make($post->title)
            ->route('platform.post.edit', $post);
    }),
 ```
 
 После этого рядом с именем колонки появиться иконка открывающее тестовое поле, устанвливая её значение которого можно фильтровать результаты.
 
 > **Обратите внимание.** Такое выражение будет выполнять `sql` с фильрацией `like`, для того, что бы поиск был регистронезависимым вам необходимо проверить кодировку базы данных.
