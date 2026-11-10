---
title: Rows
description: Располагайте поля формы друг под другом.
---

Rows располагает [поля формы](/ru/docs/field) друг под другом.

## Создание формы

```php
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

public function query(): array
{
    return [
        'user' => auth()->user(),
    ];
}

public function layout(): iterable
{
    return [
        Rows::make([
            Input::make('user.name')->title('Name'),
            Input::make('user.email')->type('email')->title('Email'),
        ])->title('Profile'),
    ];
}
```

Группа Profile показывает имя и email текущего пользователя. Имена полей, например `user.name`, читают значения
из записи `user`, возвращённой методом `query()`.
Метод `title()` задаёт заголовок группы, `canSee($condition)` управляет видимостью.
Скрытие формы не заменяет авторизацию на сервере. Для обработки данных добавьте [действие экрана](/ru/docs/screens).

Конфигурацию, зависящую от данных, задавайте в `layout()` через публичные свойства экрана.
Для форм, реагирующих на изменение полей, используйте [Listener](/ru/docs/listener).

## Повторное использование

Чтобы использовать форму на нескольких экранах, создайте класс с методом, возвращающим объект Rows:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AddressLayout
{
    public static function make(string $prefix): Rows
    {
        return Rows::make([
            Input::make($prefix.'.city')->title('City'),
            Input::make($prefix.'.street')->title('Street'),
        ])->title('Address');
    }
}
```

Вызовите метод в `layout()` экрана:

```php
use App\Orchid\Layouts\AddressLayout;

public function layout(): iterable
{
    return [
        AddressLayout::make('customer.address'),
    ];
}
```
