---
title: Selection
extends: _layouts.documentation
section: main
lang: en
menu: layouts
---

To group filters, reset them and apply them, there is a separate layer `Selection`, in which they are indicated.

To create, run the command:
```php
php artisan orchid:selection MySelection
```

Class Example:
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
