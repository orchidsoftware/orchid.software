---
title: Change the appearance of a table
description: 
extends: _layouts.page
section: main
---


There should be a story about additional methods for the table:

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
