---
title: Изменение внешнего вида таблице
description: Typically, you manage several dozen permits in a typical business process.
extends: _layouts.page
section: main
---

# Изменение внешнего вида таблице

Тут должен быть рассказ, о дополнительных методах для таблицы:


```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ExampleTable extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = '';

    /**
     * @var string
     */
    protected $template = 'platform::layouts.table';

    /**
     * @return TD[]
     */
    protected function columns(): array
    {
        return [];
    }

    /**
     * @return string
     */
    protected function iconNotFound(): string
    {
        return 'icon-table';
    }

    /**
     * @return string
     */
    protected function textNotFound(): string
    {
        return __('Records not found');
    }

    /**
     * @return string
     */
    protected function subNotFound(): string
    {
        return '';
    }

    /**
     * @return bool
     */
    protected function striped(): bool
    {
        return false;
    }
}
```
