---
title: Руководство по обновлению
extends: _layouts.documentation
section: main
lang: ru
---

> Мы пытаемся задокументировать все возможные критические изменения. Некоторые из этих изменений относятся к внутренним обращениям, поэтому только часть этих изменений может фактически повлиять на ваше приложение.

## Обновление до 10.0 с 9.x

### Обновление зависимостей

В вашем файле `composer.json` обновите зависимость `orchid/platform` до `^10.0`

### Меню

Разделы меню были сокращены,  "системное меню" было удалено. Константы теперь в классе `Orchid\Platform\Dashboard`.

```php
use Orchid\Platform\Dashboard;

Dashboard::MENU_MAIN;
Dashboard::MENU_PROFILE;
```

Меню теперь являются классами `Field` и имеют унифицированный синтаксис. До:

```php
ItemMenu::label('Example screen')
    ->icon('monitor')
    ->route('platform.example')
    ->title('Navigation')
    ->badge(function () {
        return 6;
    });
```

После:
```php
use Orchid\Screen\Actions\Menu;

Menu::make('Example screen')
    ->icon('monitor')
    ->route('platform.example')
    ->title('Navigation')
    ->badge(function () {
        return 6;
    });
```

Как видите, обновление должно быть очень мягким.
Но отличия также будут, например, написание вложенных элементов будет более наглядным:

До:

```php
ItemMenu::label('Dropdown menu')
    ->slug('example-menu')
    ->icon('code')
    ->withChildren(),

ItemMenu::label('Sub element item 1')
    ->place('example-menu')
    ->icon('bag'),

ItemMenu::label('Sub element item 2')
    ->place('example-menu')
    ->icon('heart'),
```

После:

```php
Menu::make('Dropdown menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag'),
        Menu::make('Sub element item 2')->icon('heart'),
    ]),
```

Значение по умолчанию для сортировки изменено с 1000 на 0:

```php
Menu::make('Example screen')
    ->icon('monitor')
    ->route('platform.example')
    ->title('Navigation')
    ->sort(2),
```

Это также верно для вложенных элементов:

```php
Menu::make('Dropdown menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag')->sort(2),
        Menu::make('Sub element item 2')->icon('heart')->sort(0),
    ]),
```

Для динамического определения вам нужно вызвать метод `slug`, в котором передается уникальная строка:

```php
Menu::make('Dropdown menu')
    ->slug('sub-menu')
    ->icon('code')
    ->list([
        Menu::make('Sub element item 1')->icon('bag'),
        Menu::make('Sub element item 2')->icon('heart'),
    ]),
```

Что бы добавить новые элементы динамически:

```php
Dashboard::addMenuSubElements(Dashboard::MENU_MAIN, 'sub-menu', [
   Menu::make('Sub element item 3')->icon('badge')
]);
```

> **Внимание.** Нужно соблюдать порядок загрузки.

### CanSee

Теперь у `Fields/Layouts/TD` есть общий trait. Теперь вы можете это сделать:

```php
Input::make()->canSee(false);
TD::make()->canSee(false);
Layout::rows([])->canSee(false);
```

Но теперь определение внутри слоя другое:

```php
// before
public function canSee(Repository $query): bool
{
    return ...;
}

// after
public function isSee(): bool
{
    return ...;
}
```

### Stimulus

Фреймворк Stimulus обновлен до версии 2.0. Обратная совместимость сохранена, но в именах контроллеров избавлены от префиксов:

```js
<!--  before: -->
<div data-controller="fields--checkbox">

<!--  after: -->
<div data-controller="checkbox">
```

### Turbo

Библиотека Turbolinks была обновлена до Turbo, подробнее здесь: https://turbo.hotwire.dev/

Если вы использовали собственные js-скрипты, то рекомендуется ознакомиться с их изменениями. Например:

```js
// before
document.addEventListener("turbolinks:load", function() {
    // ...
})

// after
document.addEventListener("turbo:load", function() {
  // ...
})
```

### Compendium

Класс `Compendium` был удален. Рекомендую использовать более новую версию `Legend`.

### Collapse

Класс `Collapse` был удален.


## Обновление до 9.0 с 8.x

### Обновление зависимостей

В вашем файле `composer.json` обновите зависимость `orchid/platform` до `^9.0`

### Auth

Команда Laravel представила новые продукты [Jetstream](https://github.com/laravel/jetstream) и  [Fortify](https://github.com/laravel/fortify), которые пришли на смену более раннему [laravel/ui](https://github.com/laravel/ui). Чтобы обеспечивать совместимость с различными вариантами, зависимость от `laravel/ui` была удалена. А вместе с ней возможность восстановления пароля.

Новые продукты предоставляют двухфакторную аутентификацию пользователя, а также просмотр последних активных сессий.
Чтобы не конкурировать с ними, такие же возможности были удалены из пакета.

Хотя миграции были удалены, данные, хранящиеся в базе данных, не будут удалены автоматически. 
Для их удаления необходимо выполнить следующий `SQL` код:

```php
ALTER TABLE "users"
    DROP COLUMN "last_login"
    DROP COLUMN "uses_two_factor_auth"
    DROP COLUMN "two_factor_secret_code"
    DROP COLUMN "two_factor_recovery_code";

DELETE FROM migrations
WHERE migration = '2020_06_07_184338_added_columns_for_2fa';
```

После этого необходимо удалить данные колонки из вашей модели пользователя.

Если вы копировали миграцию `2020_06_07_184338_added_columns_for_2fa` к себе в проект, не забудьте ее тоже удалить.

------

## Обновление до 8.0 с 7.x


### Обновление зависимостей

В вашем файле `composer.json` обновите зависимость `orchid/platform` до `^8.0`

### Редактор TinyMCE

`Html` редактор был удалён из стандартной поставки. Код был перенесён в отдельный [репозиторий](https://github.com/orchidcommunity/TinyMCE).

### Модель настроек

Модель настроек так же была удалена. Данные, хранящиеся в базе данных, не будут удалены автоматически. 
Для их удаления необходимо выполнить следующий `SQL` код:

```php
DROP TABLE settings;

DELETE FROM migrations
WHERE migration = '2015_12_02_181214_create_table_settings';
```
Если вы копировали миграцию `2015_12_02_181214_create_table_settings` к себе в проект, не забудьте ее тоже удалить.

Исходный код доступен для установки в качестве отдельного [пакета](https://github.com/tabuna/settings).

### Хлебные крошки

Пакет `davejamesmiller/laravel-breadcrumbs` заменён на  `tabuna/breadcrumbs` 
и должен быть установлен автоматически при обновлении зависимостей.


> **Примечание.** Может потребоваться удаление загрузочных файлов кэша в директории `bootstrap/cache`.

Синтаксис нового пакета позволяет показывать хлебные крошки прямо в определении маршрута:

```php
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail->parent('platform.index')->push(__('Example screen'));
    });
```

Так же, вы можете продолжить использовать отдельный файл для них.
Для этого, необходимо загрузить его в сервис провайдере:

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        require base_path('routes/breadcrumbs.php');
    }
}
```

Если вы использовали полные имена классов, то необходимо произвести замену на аналогичные:

```php
use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;
```

### Изменения экрана

#### Конструктор 

В передаче объекта `Request` и вызова родительского класса больше нет необходимости. До:
```php
class PublicationScreen extends Screen
{
    public function __construct(Request $request, Locator $locator)
    {
        $this->request = $request;
        $this->locator = $locator;
    }
}
```

Определение теперь выглядит так:

```php
class PublicationScreen extends Screen
{
    public function __construct(Locator $locator)
    {
        $this->locator = $locator;
    }
}
```

#### Методы маршрута

Не использованные методы были удалены. Больше нельзя обратиться к экранам через методы `PUT|PATCH|DELETE`, обращение должно использовать `GET|POSTS` для получения/отправки данных.

```php
Method           | URI                                  | Name
-----------------+--------------------------------------+--------------
GET|HEAD|POST    | dashboard/idea/{method?}             | platform.idea
```

Теперь методы экрана, ожидающие модели, при их отсутствии будут реализовывать пустую модель так же, как и контроллеры. [Подробнее](https://github.com/orchidsoftware/platform/issues/1150).

### Подмена данных (Async)

Ожидание `{argument?}` было удалено из адресной строки.
Теперь для обращения используется отдельный маршрут:

```php
$this->router
    ->post('async/{screen}/{method?}/{template?}', [AsyncController::class, 'load'])
    ->name('async');
```

### Изменения слоёв

Каждый слой теперь наследуется от класса `Orchid\Screen\Layout`, а не от `Orchid\Screen\Layouts\Base`. 

Для объявления слоёв через короткий синтаксис теперь должен использоваться фасад `Orchid\Support\Facades\Layout` вместо класса `Orchid\Screen\Layout`.

Было:
```php
use Orchid\Screen\Layout;

Layout::row([
     // ...
]);
```

Стало:
```php
use Orchid\Support\Facades\Layout;

Layout::row([
     // ...
]);
```

### Сообщение о релизе

Системное сообщение проинформировало пользователей о выпуске новой версии пакета. Но у них нет возможности обновиться без помощи разработчика.
Это раздражало больше, чем поддерживало программное обеспечение в актуальном состоянии. По этому он был удалён, если вы использовали его (По умолчанию только на первом экране), то следует удалить его вызов так же как и `blade` шаблон. Пример вызова в экране:
```php
return [
    'status' => Dashboard::checkUpdate(),
];
```
Использование шаблона в экране:

```php
Layout::view('platform::partials.update');
```

### Иконки

Отображение иконок было переработано с `font` на `SVG` формат. 
Теперь методы `->icon` принимают не значение `css` которое необходимо установить, а название файла.
В большинстве случаев необходимо только убрать префикс `icon-`.



