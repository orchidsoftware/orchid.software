---
title: Columns
extends: _layouts.documentation
section: main
lang: en
menu: layouts
---

Columns are useful when you need to group content.

![Columns](/assets/img/layouts/columns.png)

Columns support short syntax by calling a static method,
which does not require creating a separate class:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::columns([
           TableExample::class,
           RowExample::class,
        ]),
    ];
}
```
