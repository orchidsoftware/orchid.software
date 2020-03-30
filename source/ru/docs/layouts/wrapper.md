---
title: Обертка
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---


Промежуточным звеном между "Пользовательским шаблоном" и стандартными слоями может служить "Обёртка", с помощью которой
доступно указывать где именно должны отображаться другие слои.

```php
public function layout(): array
{
    return [
        Layout::wrapper('myTemplate', [
            'foo' => [
                RowLayout::class,
                RowLayout::class,
            ],
            'bar' => RowLayout::class,
        ]),
    ];
}
```

В шаблон `myTemplate` будут переданы переменные `foo` и `bar`, содержащие уже собранные `View`, которые можно выводить:

```html
<div class="row">
    <div class="col-7 border-right">
        @foreach($foo as $row)
            {!! $row !!}
        @endforeach
    </div>
    <div class="col-5 no-gutter">
        {!! $bar !!}
    </div>
</div>
```

Переменные из `query` так же доступны в шаблоне.
