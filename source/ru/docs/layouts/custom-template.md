---
title: Пользовательский шаблон
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---


Вполне ожидаемая ситуация, когда необходимо отобразить собственный `blade` шаблон, 
для этого необходимо вызвать `Layout::view`, передав параметром строку имени:

```php
use Orchid\Screen\Layout;

public function layout(): array
{
    return [
        Layout::view('myTemplate'),
    ];
}
```

Все данные из метода `query` будут переданы в ваш шаблон.

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

Вы можете отобразить содержимое `name` вот так:

```php
// ... /views/hello.blade.php

Hello {{ $name }}!
```
