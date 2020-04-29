---
title: Wrapper
extends: _layouts.documentation
section: main
lang: en
menu: layouts
---


An intermediate link between the "Custom Template" and the standard layers can serve as a "Wrapper", with which
it is available to specify where other layers should be displayed.

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

The variables `foo` and` bar` will be passed to the `myTemplate` template, containing the already collected `View`, which can be displayed:


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

The variables from query are also available in the template.
