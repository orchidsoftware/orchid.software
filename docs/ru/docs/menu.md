---
title: Меню панели платформы
description: Важный элемент графического интерфейса пользователя, потому, что с помощью него осуществляется основная навигация по проекту.
---

Меню панели платформы - это важный элемент графического интерфейса пользователя, потому, что с помощью его осуществляется основная навигация по проекту.


Для того чтобы добавить новый элемент в меню, нужно сообщить об этом нашему приложению `Dashboard`.
Для этого нужно вызвать метод в свойствах меню и передать аргументы: 

* Название меню, к которому необходимо прикрепить элемент
* Объект меню, содержащий название, ссылки и т.п.

## Пример добавления

Регистрация меню по умолчанию происходит в `app/Orchid/PlatformProvider.php`:

```php
namespace App\Orchid;

use Orchid\Screen\Actions\Menu;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    //...

    public function registerMainMenu(): array
    {
        return [
            Menu::make('Example')->url('https://orchid.software/'),
        ];
    }
}
```

Методы `registerMainMenu` и `registerProfileMenu` должны возвращать элементы меню которые необходимы для показа.


## Месторасположение

Разберём пример. Изначально мы создаём объект `Menu`, устанавливая различные задавая, после чего добавляем элемент в определенное место.
Таких мест несколько:

- **registerMainMenu** - Меню, отображаемое на каждой странице с левой стороны.
- **registerProfileMenu** - Меню, отображаемое при нажатии на профиль.

> **Примечание.** для каждого элемента при создании генерируется уникальный ключ, который не может повторяться, но может быть изменен вручную с помощью метода `slug`.


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

#### Внешний вид


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
Dashboard::addMenuSubElements(Dashboard::MENU_MAIN, 'sub-menu', [
    Menu::make('Sub element item 3')->icon('badge')
]);
```
