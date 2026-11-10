---
title: Боковое меню
description: Добавьте навигацию для группы связанных экранов.
---

SideMenu выводит вертикальную навигацию внутри экрана. Используйте его для ссылок между связанными экранами,
например страницами настроек. Главное меню приложения настраивается в поставщике сервисов.

## Добавьте боковое меню

Расположите меню рядом с содержимым экрана через Columns:

```php
use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\SideMenu;

public function query(): array
{
    return [
        'user' => auth()->user(),
    ];
}

public function layout(): iterable
{
    return [
        Columns::make([
            SideMenu::make([
                Menu::make('Profile')->route('orchid.profile'),
                Menu::make('Users')->route('orchid.users')->permission('orchid.users'),
            ])->label('Account navigation'),
            Rows::make([
                Input::make('user.name')->title('Name'),
            ]),
        ]),
    ];
}
```

В примере имя читается из значения `user`, возвращённого методом `query()`.
Метод `label()` задаёт название области навигации для вспомогательных технологий.

Элементы поддерживают методы `route()`, `list()`, `permission()` и `canSee()`, как и главное меню.
Скрытые пункты не выводятся. Если видимых пунктов не осталось, весь макет скрывается.
На узких экранах меню сворачивается.

Конечная ссылка `/settings/profile` также активна на `/settings/profile?tab=security`, но не на вложенных путях.
Родительские пункты учитывают дочерние ссылки и вложенные пути. Для собственных правил используйте `active()`.

Скрытие пункта не защищает его адрес. Отдельно проверяйте доступ к экрану и его действиям.

## Используйте меню на нескольких экранах

Создайте именованный макет для общей навигации:

```shell
php artisan orchid:side-menu SettingsMenu
```

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Layouts\SideMenu;

class SettingsMenu extends SideMenu
{
    protected string $label = 'Settings';

    protected function navigations(): iterable
    {
        return [
            Menu::make('Profile')->route('orchid.profile'),
            Menu::make('Users')->route('orchid.users')->permission('orchid.users'),
            Menu::make('Roles')->route('orchid.roles')->permission('orchid.roles'),
        ];
    }
}
```

Верните класс из метода `layout()` каждого экрана:

```php
use App\Orchid\Layouts\SettingsMenu;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Layouts\Rows;

public function layout(): iterable
{
    return [
        Columns::make([
            SettingsMenu::class,
            Rows::make([
                Input::make('user.name')->title('Name'),
            ]),
        ]),
    ];
}
```
