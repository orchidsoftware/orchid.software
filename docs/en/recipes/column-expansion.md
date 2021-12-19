---
title: How to re-use the column?
description: 
extends: _layouts.page
section: main
---

Working with the same type of data, you often need to process them in the same way. To duplicate the code, it is possible in the layers to extend the `TD` class with their own methods. For this, it is necessary to register the closure function in the service provider.

Registration example:

```php
// AppServiceProvider.php
TD::macro('bool', function () {

    $column = $this->column;

    $this->render(function ($datum) use ($column) {
        return view('bool',[
            'bool' => $datum->$column
        ]);
    });

    return $this;
});
```

Example template:

```php
// bool.blade.php

<span class="{{ $bool ? 'text-success' : 'text-danger' }}">●</span>
```

Usage example:

```php
public function grid(): array
{
    return [
        TD::make('status')->bool(),
    ];
}
```
