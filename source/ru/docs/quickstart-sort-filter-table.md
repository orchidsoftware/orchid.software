---
title: Сортировка и фильтрация в таблице
description: Laravel CRUD
extends: _layouts.documentation
section: main
lang: ru
---

Это руководство продолжение учебника ["Управление данными"](/ru/docs/quickstart-crud), в котором мы будем помогать пользователю быстрее находить информацию в таблицах.

Сортировка в таблице полностью основана на автоматическом распознавании `Http` запроса и применима к моделям `Eloquent`. Для того чтобы включить его, необходимо добавить трейт `Filterable` и определить разрешённые колонки:


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

Теперь данные будут различными, в зависимости от параметров в `url` адресе, например:

* `http://localhost:8000/admin/posts?sort=id` - Записи по возрастанию идентифицирующего номера
* `http://localhost:8000/admin/posts?sort=-id` - Сортировка по убыванию

> ** Обратите внимание. ** Таким способом вы не можете сортировать связанные модели.


Для того чтобы отобразить в графическом интерфейсе возможность сортировки, мы должны вызвать метод `sort` для необходимых колонок таблицы в `PostListLayout`:

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
            TD::make('title', 'Title')
                ->sort()
                ->render(function (Post $post) {
                    return Link::make($post->title)
                        ->route('platform.post.edit', $post);
                }),

            TD::make('created_at', 'Created')
                ->sort(),

            TD::make('updated_at', 'Last edit')
                ->sort(),
        ];
    }
}
```


После этого заголовок колонки будет реагировать на нажатие и менять положение сортировки.


Трейт `Filterable` позволяет устанавливать не только сортировку, но и простую `Http` фильтрацию, для её установки вернёмся к модели и добавим новое свойство:
 
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
 
 А затем вызовем новый метод `filter` с текстовым типом для колонки с заголовком:
 
```php
 TD::make('title', 'Title')
    ->sort()
    ->filter(TD::FILTER_TEXT)
    ->render(function (Post $post) {
        return Link::make($post->title)
            ->route('platform.post.edit', $post);
    }),
```
 
 После этого рядом с именем колонки появится иконка открывающая текстовое поле, устанавливая значение которого можно фильтровать результаты.
 
 > **Обратите внимание.** Такое выражение будет выполнять `sql` с фильтрацией `like`. Для того чтобы поиск был не чувствительным к регистру, вам необходимо проверить кодировку базы данных.


Теперь наша таблица обладает некоторой интерактивностью и помогает пользователю быстрее найти информацию. Для детального знакомства и для создания сложных фильтров, необходимо ознакомиться с разделом ["Фильтрация"](/ru/docs/filters).
