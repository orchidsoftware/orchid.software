---
title: Rows
description: Формы из полей и fluent-объектов макета.
---

Rows объединяет [поля формы](/ru/docs/field) в вертикальный макет. Создавайте его напрямую или через фасад Layout.
Оба способа возвращают один и тот же конкретный объект Rows. Подкласс и команда Artisan для этого не нужны.

## Создание формы

```php
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

public function layout(): iterable
{
    return [
        Rows::make([
            Input::make('user.name')->title('Name'),
            Input::make('user.email')->type('email')->title('Email'),
        ])->title('Profile'),

        Layout::rows([
            Input::make('user.phone')->title('Phone'),
        ]),
    ];
}
```

Имена полей связываются с результатом `query()` экрана. Например, `user.name` читает атрибут `name` модели `user`.
Метод `title()` задаёт заголовок группы, `canSee($condition)` управляет видимостью.
Скрытие формы не заменяет авторизацию на сервере.

Конфигурацию, зависящую от данных, задавайте в `layout()` через публичные свойства экрана.
Асинхронные изменения данных остаются в обработчике Listener.

## Повторное использование

Выносите форму в фабрику, когда она нужна нескольким экранам. Обычный класс возвращает настроенный объект Rows:

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

// In the screen's layout():
return [AddressLayout::make('customer.address')];
```

Возвращайте результат фабрики, а не `AddressLayout::class`: этот класс не наследует Layout.
Существующие именованные подклассы Rows остаются допустимыми. Новым формам не нужно переопределять `fields()` или `$title`.
Генератор `orchid:rows` удалён.
