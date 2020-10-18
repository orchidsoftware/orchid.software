---
title: Custom template
extends: _layouts.documentation
section: main
lang: en
---


It is an expected situation when you need to display your own `blade` template,
to do this, call `Layout::view` by passing the parameter a name string:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::view('myTemplate'),
    ];
}
```

All data from the `query` method will be passed to your template.

```php
// ... Screen

public function query(): array
{
    return [
        'name' => 'Alexandr Chernyaev',
    ];
}

public function layout(): array
{
    return [
        Layout::view('hello'),
    ];
}
```

You can display the contents of `name` like this:

```php
// ... /views/hello.blade.php

Hello {{ $name }}!
```
