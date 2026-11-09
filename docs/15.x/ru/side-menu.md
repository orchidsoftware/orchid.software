---
title: Боковое меню
description: Контекстная навигация между связанными экранами.
---

SideMenu выводит вертикальную навигацию внутри экрана. Используйте его для ссылок, общих для группы экранов,
например настроек. Главное меню приложения по-прежнему определяется в поставщике сервисов.

## Создание меню

Создайте макет, задайте ссылки и доступное имя навигации:

```shell
php artisan orchid:side-menu SettingsMenu
```

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Layouts\SideMenu;

class SettingsMenu extends SideMenu
{
    protected function label(): string
    {
        return 'Settings';
    }

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

## Добавление на экран

Верните класс макета из `layout()`. Например, разместите меню рядом с полями экрана:

```php
use App\Orchid\Layouts\SettingsMenu;
use Orchid\Support\Facades\Layout;

public function layout(): iterable
{
    return [
        Layout::columns([
            SettingsMenu::class,
            Layout::rows([
                // Fields for this screen...
            ]),
        ]),
    ];
}
```

Элементы поддерживают те же методы `route()`, `list()`, `permission()` и `canSee()`, что и главное меню.
Скрытые пункты удаляются; если доступных пунктов не осталось, макет не выводится.
На узких экранах меню сворачивается. Конечная ссылка активна при точном совпадении URL, включая параметры запроса;
родительский пункт учитывает и дочерние адреса. Для собственных правил используйте `active()`.

Скрытие пункта не защищает его адрес. Отдельно проверяйте доступ к экрану и его действиям.
