---
title: Сортировка и фильтрация в таблице
description: Laravel CRUD
---

Это руководство продолжение учебника ["Управление данными"](/ru/docs/quickstart-crud), в котором мы будем помогать
пользователю быстрее находить информацию в таблицах.

Сортировка в таблице полностью основана на автоматическом распознавании `Http` запроса и применяется к моделям
`Eloquent`. Для того чтобы включить её, необходимо добавить трейт `Filterable` и определить разрешённые колонки:

```php
namespace App\Models;

use Orchid\Filters\AllowedSorts;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

#[AllowedSorts([
    'id',
    'title',
    'created_at',
    'updated_at'
])]
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
}
```

Теперь при вызове метода `filters` запрос к базе данных будет модифицирован. В методе источника данных у экрана
`PostListScreen`, это будет выглядеть следующим образом:

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

- `http://localhost:8000/admin/posts?sort=id` - Записи по возрастанию идентифицирующего номера
- `http://localhost:8000/admin/posts?sort=-id` - Сортировка по убыванию

> **Обратите внимание.** Таким способом вы не можете сортировать связанные модели.

Для того чтобы отобразить в графическом интерфейсе возможность сортировки, мы должны вызвать метод `sort` для
необходимых колонок таблицы в `PostListScreen::layout()`:

```php
use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

public function layout(): iterable
{
    return [
        Table::make([
            TD::make('title')
                ->sort()
                ->render(function (Post $post) {
                    return Link::make($post->title)
                        ->route('orchid.post.edit', $post);
                }),

            TD::make('created_at', 'Created')
                ->sort(),

            TD::make('updated_at', 'Last edit')
                ->sort(),
        ])->target('posts'),
    ];
}
```

После этого заголовок колонки будет реагировать на нажатие и менять положение сортировки.

Трейт `Filterable` позволяет устанавливать не только сортировку, но и простую `Http` фильтрацию. Для её установки
вернёмся к модели и добавим новое свойство:

```php
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;
use Orchid\Filters\AllowedFilters;
use Orchid\Filters\Types\Like;
use Orchid\Filters\AllowedSorts;

#[AllowedFilters([
    'title' => Like::class,
])]
#[AllowedSorts(['id', 'title', 'created_at', 'updated_at'])]
class Post extends Model
{
    use AsSource, Attachable, Filterable;

    // Keep the remaining model traits, properties, and methods.
}
```

А затем вызовем новый метод `filter` с текстовым типом для колонки с заголовком:

```php
use Orchid\Screen\Fields\Input;

TD::make('title')
   ->sort()
   ->filter(Input::make())
   ->render(function (Post $post) {
       return Link::make($post->title)->route('orchid.post.edit', $post);
   }),
```

После этого рядом с именем колонки появится иконка открывающая текстовое поле, устанавливая значение которого можно
фильтровать результаты.

> **Обратите внимание.** Такое выражение будет выполнять `sql` с фильтрацией `like`. Для того чтобы поиск был не
> чувствительным к регистру, вам необходимо проверить кодировку базы данных.

Теперь наша таблица обладает некоторой интерактивностью и помогает пользователю быстрее найти информацию. Для детального
знакомства и для создания сложных фильтров, необходимо ознакомиться с разделом ["Фильтрация"](/ru/docs/filters).
