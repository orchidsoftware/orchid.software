---
title: Раскрывающийся список
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---


```php
public function layout(): array
{
    return [
        Layout::collapse([
            Input::make('name')
                ->type('text')
                ->title('Name Articles')
        ])->label('More'),
    ];
}
```
