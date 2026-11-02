---
title: 'Раскрывающийся список'
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
