---
title: Меню панели платформы
description: Важный элемент графического интерфейса пользователя, потому, что спомощью него осуществляется основаня навигация по проекту.
extends: _layouts.documentation
section: main
lang: ru
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

use Orchid\Platform\ItemMenu;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    //...

    public function registerMainMenu(): array
    {
        return [
            ItemMenu::label('Example')->url('https://orchid.software/'),
        ];
    }
}
```

Методы `registerMainMenu`, `registerProfileMenu` и `registerProfileMenu` должны возвращать элементы меню которые необходимы для показа.


## Месторасположение

Разберём пример, изначально мы создаём объект `ItemMenu`, устанавливая различные параметры, после чего добавляем элемент к конкретному месту.
Таких мест несколько:

- **registerMainMenu** - Меню отображаемое на каждой странице с левой стороны.
- **registerProfileMenu** - Меню формирующую навигацию по системной странице.
- **registerProfileMenu** - Меню отображаемое при нажатии на профиль.

## Параметры


Базовое использование:

```php
use Orchid\Platform\ItemMenu;

ItemMenu::label('Example');
```

> **Примечание.** Для каждого элемента при создании генерируется уникальный ключ, который не может повторяться, но его можно изменить вручную с помощью метода `slug`.

### Настройка ссылок

Указание ссылки:

 ```php
ItemMenu::label('Example')->url('https://orchid.software/');
```
 
Указание ссылки через маршрут:
 ```php
ItemMenu::label('Example')->route('route.idea');
```

Для определения активности ссылки используется пакет [dwightwatson/active](https://github.com/dwightwatson/active).
Активность ссылок, при использовании `route` и `url`, устанавливается автоматически,
но допустимо изменение с помощью явного указания:

```php
ItemMenu::label('Example')
    ->route('route.idea')
    ->active('route.idea*');
    
ItemMenu::label('Example')
    ->route('route.idea')
    ->active([
        'route.idea',
        'route.other'
    ]);
    
ItemMenu::label('Example')
    ->url('/pages/contact')
    ->active('not:pages/contact');
```

### Права доступа

Вполне ожидаема ситуация, когда некоторые ссылки должны отсутствовать
в зависимости от наличия прав или других обстоятельств, для этого:

 ```php
ItemMenu::label('Example')->permission('platform.idea');
```

или любая другая проверка возвращающая булево значение:

 ```php
ItemMenu::label('Example')->canSee(true);
```

#### Внешний вид


Для элемента меню можно указать графическую иконку с помощью:

```php
ItemMenu::label('Example')->icon('heart');
```

Так же, возможно объединение в визуальную группу с помощью установки заголовка для первого элемента:

```php
ItemMenu::label('Example')->title('Analytics');
```

### Порядок отображения

Сортировка устанавливается через задание порядкового номера:

 ```php
ItemMenu::label('Second')->sort(5);
ItemMenu::label('First')->sort(4);
```

### Уведомления

Пункты меню имеют возможность уведомлять пользователя о каких либо событиях в виде числового значения, для этого:

```php
ItemMenu::label('Comments')
    ->icon('bubbles')
    ->route('platform.systems.comments')
    ->badge(function () {
        return 10;
    });
```

## Вложенное меню

Для возможности создания вложенного меню необходимо добавить основной пункт и указать его уникальное имя с помощью метода `slug`, после этого можно добавлять остальные элементы к новому пункту.


```php
ItemMenu::label('My menu')
    ->slug('Idea')
    ->childs();
    
ItemMenu::label('Sub element')
    ->place('Idea');
```


Когда дочерние элементы имеют разные правила отображения, чтобы не перечислять их все и в родительском, можно воспользоваться методом 'hiddenEmpty'. Он спрячет пункт меню, когда подпункты будут недоступны:

```php
ItemMenu::label('Dropdown menu')
    ->slug('parent-hidden-menu')
    ->childs()
    ->hideEmpty();

ItemMenu::label('Sub element item 1')
    ->place('parent-hidden-menu')
    ->canSee(false);
    
ItemMenu::label('Sub element item 2')
    ->place('parent-hidden-menu')
    ->canSee(false);
```
