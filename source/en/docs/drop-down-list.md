---
title: Drop-down list
extends: _layouts.documentation
section: main
lang: en
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
