---
title: Sorting and Filtering In a Table
description: Laravel CRUD
---

This guide is a continuation of the [Data Management](/en/docs/quickstart-crud) tutorial, in which we will help the user
find information in tables faster.

The sorting in the table is based entirely on the automatic recognition of the `Http` request and is applicable to the
`Eloquent` models. To enable it, you need to add the `Filterable` trait and define the allowed columns:

```php
namespace App\Models;

use Orchid\Filters\AllowedSorts;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

#[AllowedSorts([
    'id',
    'title',
    'created_at',
    'updated_at',
])]
class Post extends Model
{
    use AsSource, Filterable;

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
    ];
}
```

Now, when calling the `filters` method, the database query will be modified. In the data source method of the
`PostListScreen` screen, it will look like this:

```php
/**
 * Query data.
 *
 * @return array
 */
public function query(): array
{
    return [
        'posts' => Post::filters()->defaultSort('id')->paginate(),
    ];
}
```

Now the data will be different, depending on the parameters in the `url` address, for example:

- `http://localhost:8000/admin/posts?sort=id` - Records in ascending order of identification number
- `http://localhost:8000/admin/posts?sort=-id` - Sort descending

> **Note.** In this way, you cannot sort related models.

To display the sorting feature in the graphical interface, call the `sort` method for the necessary table columns in the
`PostListScreen::layout()`:

```php
use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

public function layout(): iterable
{
    return [
        Table::make('posts', [
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
        ]),
    ];
}
```

After that, the column heading will respond to clicking and change the sorting position.

To filter posts by title, add `AllowedFilters` to the Post model. Keep `AllowedSorts` and the remaining model
properties:

```php
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
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
    use AsSource, Filterable;

    // Keep the remaining model traits, properties, and methods.
}
```

And then call the new `filter` method with a text type for the header column:

```php
use Orchid\Screen\Fields\Input;

TD::make('title')
    ->sort()
    ->filter(Input::make())
    ->render(function (Post $post) {
        return Link::make($post->title)
            ->route('orchid.post.edit', $post);
    }),
```

After that, an icon will open next to the column name, opening the text field, setting its value in which you can filter
the results.

> **Please note.** Such an expression will be performed by `sql` with `like` filtering. In order for the search to be
> case-insensitive, you need to check the database encoding.

Now our table has some interactivity and helps the user find information faster. For a detailed acquaintance and to
**create complex filters**, it is necessary to familiarize yourself with the [Filtering](/en/docs/filters) section.
