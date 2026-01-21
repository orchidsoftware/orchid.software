---
title: Sorting and Filtering In a Table
description: Laravel CRUD
---

This guide is a continuation of the tutorial ["Data Management"](/en/docs/quickstart-crud), in which we will help the user find information in tables faster.

The sorting in the table is based entirely on the automatic recognition of the `Http` request and is applicable to the `Eloquent` models. 
In order to enable it, you need to add the `Filterable` trait and define the allowed columns:

```php
namespace App\Models;

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

Now, when calling the `filters` method, the database query will be modified.
In the data source method of the `PostListScreen` screen, it will look like this: 

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

Now the data will be different, depending on the parameters in the `url` address, for example:

* `http://localhost:8000/admin/posts?sort=id` - Records in ascending order of identification number
* `http://localhost:8000/admin/posts?sort=-id` - Sort descending

> **Note.** In this way, you cannot sort related models.


In order to display the sorting feature in the graphical interface, we must call the `sort` method for the necessary table columns in the `PostListLayout`:

```php
namespace App\Orchid\Layouts;

use App\Models\Post;
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
            TD::make('title')
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


After that, the column heading will respond to clicking and change the sorting position.

The trait `Filterable`, allows you to set not only sorting. But also simple `Http` filtering, to set it back to the model and add a new property:
 
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
 
And then call the new `filter` method with a text type for the header column:
 
```php
use Orchid\Screen\Fields\Input;

TD::make('title')
    ->sort()
    ->filter(Input::make())
    ->render(function (Post $post) {
        return Link::make($post->title)
            ->route('platform.post.edit', $post);
    }),
```
 
After that, an icon will open next to the column name, opening the text field, setting its value in which you can filter the results.
 
> **Please note.** Such an expression will be performed by `sql` with `like` filtering. In order for the search to be case-insensitive, you need to check the database encoding.

Now our table has some interactivity and helps the user find information faster. For a detailed acquaintance and to **create complex filters**, it is necessary to familiarize yourself with the [Filtering](/en/docs/filters) section.
