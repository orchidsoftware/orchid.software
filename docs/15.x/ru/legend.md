---
title: Legend
description: Покажите одну запись в виде подписанных значений.
---

Legend выводит одну запись в виде подписанных значений. Ячейки `Sight` определяют, какие значения показать.

## Покажите запись

Верните запись из `query()` экрана и выберите её через `target()`:

```php
use Orchid\Screen\Layouts\Legend;
use Orchid\Screen\Repository;
use Orchid\Screen\Sight;

public function query(): array
{
    return [
        'user' => new Repository([
            'id'    => 1,
            'name'  => 'Alex',
            'email' => 'alex@example.com',
        ]),
    ];
}

public function layout(): iterable
{
    return [
        Legend::make([
            Sight::make('id'),
            Sight::make('name'),
            Sight::make('email'),
        ])->target('user'),
    ];
}
```

Для стандартного вывода ячеек выбранная запись должна быть объектом `Repository` или моделью с трейтом
`Orchid\Screen\AsSource`. Обычный массив оберните в `new Repository($data)`.
Без `target()` Legend читает значения из корня репозитория экрана.

![Legend с данными пользователя.](/img/layouts/legend.png)

## Настройте значения

Метод `popover()` добавляет пояснение к значению:

```php
Sight::make('id')->popover('Unique number in the system');
```

Замыкание `render()` получает выбранную запись. Верните значение для отображения:

```php
Sight::make('name')->render(fn (Repository $user) => e(strtoupper($user->get('name'))));
```

Стандартные значения экранируются. Результат замыкания выводится как HTML, поэтому экранируйте недоверенный текст
через `e()`.
Для повторного использования отображения создайте Blade-компонент. Он получает выбранную запись, как и
[компоненты таблицы](/ru/docs/table).
