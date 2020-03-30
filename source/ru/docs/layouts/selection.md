---
title: Набор фильтров
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Для группировки фильтров, их сброса и применения, существует отдельный слой `Selection`, в котором они указываются. 

Для создания исполните команду:
```php
php artisan orchid:selection MySelection
```

Пример класса:
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
