---
title: Объекты макетов
description: Композиция экранов из конкретных макетов с fluent-настройкой.
---

Макеты превращают данные `query()` в интерфейс экрана. Создавайте обычные объекты и настраивайте их методами.
Для объявления полей, колонок или вложенных макетов подкласс не нужен.

## Композиция экрана

```php
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

public function layout(): iterable
{
    return [
        Columns::make([
            Rows::make([
                Input::make('user.name')->title('Name'),
            ])->title('Profile'),

            Table::make([
                TD::make('name'),
                TD::make('email'),
            ])->target('users')->compact(),
        ]),
    ];
}
```

Пример ожидает `user` и `users` в репозитории экрана. Привязка полей, callbacks ячеек, пагинация и проверки доступа
сохраняют прежнее поведение.

## Прямое создание и фасад

Фасад Layout сокращённо вызывает те же фабрики объектов:

```php
Rows::make([Input::make('name')]);
Layout::rows([Input::make('name')]);

Table::make([TD::make('name')])->target('users');
Layout::table([TD::make('name')])->target('users');
```

Для фасада импортируйте `Orchid\Support\Facades\Layout`. Оба способа используют одну реализацию вывода.
Для Table и Sortable непустой `target()` обязателен. Legend без target читает корень репозитория.

## Доступные объекты

Все перечисленные классы находятся в `Orchid\Screen\Layouts`:

| Object | Construction |
| --- | --- |
| Rows | `Rows::make($fields)` |
| Table | `Table::make($columns)->target('users')` |
| Legend | `Legend::make($sights)->target('user')` |
| Sortable | `Sortable::make($sights)->target('items')` |
| Selection | `Selection::make($filters)->inline()` |
| TabMenu | `TabMenu::make($menus)` |
| SideMenu | `SideMenu::make($menus)->label('Settings')` |
| Columns, Split | `Columns::make($layouts)`, `Split::make($layouts)` |
| Tabs, Accordion | `Tabs::make($namedLayouts)`, `Accordion::make($namedLayouts)` |
| Block, Blank | `Block::make($layouts)`, `Blank::make($layouts)` |
| Modal | `Modal::make('edit', $layouts)` |
| Wrapper | `Wrapper::make('custom-view', $namedLayouts)` |
| View | `View::make('custom-view', $data)` |
| Component | `Component::make(Hello::class)` |
| Metric | `Metric::make(['Users' => 'users'])` |
| Browsing | `Browsing::make($url)` |
| Chart | `Chart::make('visits', 'Visits')` |
| Card, Persona, Facepile | `Card::make($card)`, `Persona::make($person)`, `Facepile::make($people)` |

## Повторное использование

Локальные определения оставляйте в экране. Общее определение можно вынести в обычную фабрику настроенного объекта.
Возвращайте этот объект из `layout()`: само имя класса фабрики не является Layout.
Именованные подклассы остаются доступны для общих меню и особого поведения. `make()` сохраняет их класс.

Listener остаётся классом поведения: `handle()` обрабатывает асинхронный запрос, а маршрут восстанавливает именованный
обработчик. Этот контракт не заменяется сериализацией callbacks.

Генераторы `orchid:rows` и `orchid:table` удалены. Генераторы Chart, Selection, TabMenu, SideMenu и Listener сохранены
для случаев, когда приложению нужен именованный класс. Для прямого создания генератор не требуется.
