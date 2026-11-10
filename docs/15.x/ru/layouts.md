---
title: Макеты
description: Располагайте формы, таблицы и другое содержимое на экране.
---

Макеты отображают данные из метода `query()` экрана. Верните макеты из `layout()` и объедините их,
чтобы расположить поля формы, записи, графики и другое содержимое.

## Соберите экран

В примере поля профиля текущего пользователя расположены рядом со списком пользователей с пагинацией:

```php
use Orchid\Platform\Models\User;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

public function query(): array
{
    return [
        'user'  => auth()->user(),
        'users' => User::paginate(),
    ];
}

public function layout(): iterable
{
    return [
        Columns::make([
            Rows::make([
                Input::make('user.name')->title('Name'),
                Input::make('user.email')->type('email')->title('Email'),
            ])->title('Profile'),

            Table::make('users', [
                TD::make('name'),
                TD::make('email'),
            ])->title('Users'),
        ]),
    ];
}
```

Rows выводит поля профиля. Имена полей, например `user.name`, выбирают значения из записи `user`.
Table получает записи из `users`, а Columns располагает форму и таблицу рядом.

## Выберите макет

Выберите макет по его назначению. Все перечисленные классы находятся в `Orchid\Screen\Layouts`.

| Макет | Назначение | Создание |
| --- | --- | --- |
| [Rows](/ru/docs/rows) | Поля формы | `Rows::make($fields)` |
| [Table](/ru/docs/table) | Список записей | `Table::make('users', $columns)` |
| [Legend](/ru/docs/legend) | Одна запись | `Legend::make($sights)->target('user')` |
| [Sortable](/ru/docs/grouping#sortable) | Перетаскиваемые записи | `Sortable::make('items', $sights)` |
| Selection | Группа фильтров | `Selection::make($filters)->inline()` |
| TabMenu | Вкладки навигации | `TabMenu::make($menus)` |
| [SideMenu](/ru/docs/side-menu) | Вертикальная навигация | `SideMenu::make($menus)` |
| [Columns](/ru/docs/grouping) | Колонки одинаковой ширины | `Columns::make($layouts)` |
| [Split](/ru/docs/grouping) | Две секции с настраиваемой шириной | `Split::make($layouts)` |
| [Tabs](/ru/docs/grouping) | Группы макетов с переключением по вкладкам | `Tabs::make($namedLayouts)` |
| [Accordion](/ru/docs/grouping) | Сворачиваемые группы макетов | `Accordion::make($namedLayouts)` |
| [Block](/ru/docs/grouping) | Макеты с заголовком, описанием и действиями | `Block::make($layouts)` |
| Blank | Макеты без дополнительного оформления | `Blank::make($layouts)` |
| [Modal](/ru/docs/modals) | Диалог с макетами | `Modal::make('edit', $layouts)` |
| [Wrapper](/ru/docs/custom-template) | Blade-представление с макетами | `Wrapper::make('custom-view', $namedLayouts)` |
| [View](/ru/docs/custom-template) | Blade-представление с данными | `View::make('custom-view', $data)` |
| Component | Blade-компонент | `Component::make(Hello::class)` |
| Metric | Подписанные значения | `Metric::make(['Users' => 'users'])` |
| Browsing | Встроенная веб-страница | `Browsing::make($url)` |
| [Chart](/ru/docs/charts) | График | `Chart::make('visits')->title('Daily visits')` |
| [Card](/ru/docs/display-elements) | Карточка из объекта Cardable | `Card::make($card)` |
| [Persona](/ru/docs/display-elements) | Один пользователь из объекта Personable | `Persona::make($person)` |
| [Facepile](/ru/docs/display-elements) | Аватары из коллекции объектов Personable | `Facepile::make($people)` |

Интерфейсы Cardable и Personable находятся в `Orchid\Screen\Contracts`.
Полные примеры приведены в разделе [Элементы отображения](/ru/docs/display-elements).

## Повторное использование макетов

Если один макет нужен нескольким экранам, вынесите его создание в метод или класс, возвращающий настроенный объект.
Верните этот объект из `layout()`. Пример приведён в разделе [повторного использования форм](/ru/docs/rows).

Для форм, реагирующих на изменение полей, используйте [Listener](/ru/docs/listener).
