---
title: Меню панели платформы
description: Важный элемент графического интерфейса пользователя, потому, что с помощью него осуществляется основная навигация по проекту.
---

Меню панели платформы — важный элемент графического пользовательского интерфейса, так как оно является основной навигацией в проекте.

## Использование

Регистрация меню по умолчанию происходит в файле `app/Orchid/PlatformProvider.php`:

```php
namespace App\Orchid;

use Orchid\Screen\Actions\Menu;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    // ...
    
    public function menu(): array
    {
        return [
            Menu::make('Пример')->url('https://orchid.software/'),
        ];
    }
}
```

> **Примечание:** При создании каждого элемента автоматически генерируется уникальный ключ, который не должен повторяться. Однако, вы можете вручную изменить ключ, используя метод `slug`.

## Ссылки

Базовое использование:

```php
use Orchid\Screen\Actions\Menu;

Menu::make('Example')->url('https://orchid.software/');
```

Указание ссылки через маршрут:

```php
Menu::make('Example')->route('route.idea');
```

### Настройка ссылок

Для определения активности ссылки используется пакет [dwightwatson/active](https://github.com/dwightwatson/active).
Активность ссылок, при использовании `route` и `url`, устанавливается автоматически,
но допустимо изменение с помощью явного указания:

```php
Menu::make('Example')
    ->route('route.idea')
    ->active('route.idea*');
    
Menu::make('Example')
    ->route('route.idea')
    ->active([
        'route.idea',
        'route.other'
    ]);
    
Menu::make('Example')
    ->url('/pages/contact')
    ->active('not:pages/contact');
```

### Права доступа

Вполне ожидаема ситуация, когда некоторые ссылки должны отсутствовать
в зависимости от наличия прав или других обстоятельств, для этого:

```php
Menu::make('Example')->permission('platform.idea');
```

или любая другая проверка возвращающая булево значение:

```php
Menu::make('Example')->canSee(true);
```

### Внешний вид

Для элемента меню можно указать графическую иконку с помощью:

```php
Menu::make('Example')->icon('heart');
```

Так же, возможно объединение в визуальную группу с помощью установки заголовка для первого элемента:

```php
Menu::make('Example')->title('Analytics');
```

### Порядок отображения

Сортировка устанавливается через задание порядкового номера:

```php
Menu::make('Second')->sort(5);
Menu::make('First')->sort(4);
```

### Уведомления

Пункты меню имеют возможность уведомлять пользователя о каких либо событиях в виде числового значения, для этого:

```php
Menu::make('Comments')
    ->icon('bubbles')
    ->route('platform.systems.comments')
    ->badge(function () {
        return 10;
    });
```

## Вложенное меню

Вы можете указать одноуровневое подменю следующим образом:

```php
Menu::make('Dropdown menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag')->sort(2),
        Menu::make('Sub element item 2')->icon('heart')->sort(0),
    ]),
```

Чтобы создать динамическое подменю, вам нужно добавить основной элемент и указать его уникальное имя с помощью метода `slug`.
Затем вы можете добавить к новому элементу другие элементы.

```php
Menu::make('Dropdown menu')
    ->slug('sub-menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag'),
        Menu::make('Sub element item 2')->icon('heart'),
    ]),
```

А затем добавляем новые элементы, например:

```php
use Orchid\Support\Facades\Dashboard;

Dashboard::addMenuSubElements('sub-menu', [
    Menu::make('Sub element item 3')->icon('badge')
]);
```
