---
title: How to use sorting on a table?
description: 
extends: _layouts.page
section: main
---


Sorting in a table is entirely based on the automatic recognition of an HTTP request and applies to Eloquent models.

Consider this on an empty `Idea` model:

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

It is necessary to add the trait `Filterable` and define the allowed fields for sorting:

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

Now, when calling the `filters` method, the database query will be modified.
In the data source method at the screen, it might look like this:

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

Now the data will be different depending on the parameters in the URL, for example:

* `http://example.com/yourScreen?sort=id` - the result will be records in ascending order of the identifying number
* `http://example.com/yourScreen?sort=-id` - Sort descending

> **Please note.** You cannot sort related models this way.


In order to display the sorting option in the GUI, we must add the `sort` method

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
            TD::make('id', 'ID')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->sort(),
            //...
        ];
    }
}
```

After that, the column heading will react to clicking and change the sorting position.
