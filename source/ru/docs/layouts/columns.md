---
title: Колонки
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Колонки полезны, когда вам необходимо сгруппировать контент.

![Columns](/assets/img/layouts/columns.png)

Колонки поддерживают короткий синтаксис через вызов статического метода, 
что не требует создания отдельного класса:

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
