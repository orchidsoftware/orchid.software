---
title: Руководство по обновлению
extends: _layouts.documentation
section: main
lang: ru
---

# Обновление до 8.0 с 7.x


> Мы пытаемся задокументировать все возможные критические изменения. Некоторые из этих изменений относятся к внутренним обращениям, по этому только часть этих изменений может фактически повлиять на ваше приложение.

## Обновление зависимостей

В вашем файле `composer.json` обновите зависимость `orchid/platform` до `^8.0`

## Редактор TinyMCE

`Html` редактор был удалён из стандартной поставке. Код был перенесён в отдельный [репозиторий](https://github.com/orchidcommunity/TinyMCE).

## Модель настроек

Модель настроек так же была удалена. Данные хранящееся в базе данные, не будут удалены автоматически. 
Для их удаления необходимо выполнить следующий `SQL` код:

```php
DROP TABLE settings;

DELETE FROM migrations
WHERE migration = '2015_12_02_181214_create_table_settings';
```

Исходный код доступен для установки в качестве отдельного [пакета](https://github.com/tabuna/settings).

## Хлебные крошки

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

## Изменения экрана

### Конструктор 

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

### Методы маршрута

Не использованные методы были удалены. Больше нельзя обратиться к экранам через методы `PUT|PATCH|DELETE`, обращение должно использовать `GET|POSTS` для получения/отправки данных.

```php
Method           | URI                                  | Name
-----------------+--------------------------------------+--------------
GET|HEAD|POST    | dashboard/idea/{method?}             | platform.idea
```

Теперь методы экрана ожидающие модели при их отсутствии будут реализовывать пустую модель так же как и контроллеры. [Подробнее](https://github.com/orchidsoftware/platform/issues/1150).

### Подмена данных (Async)

Ожидание `{argument?}` было удалено из адресной строки.
Теперь для обращения используется отдельный маршрут:

```php
$this->router
    ->post('async/{screen}/{method?}/{template?}', [AsyncController::class, 'load'])
    ->name('async');
```

## Изменения слоёв

Каждый слой теперь наследуются от класса `Orchid\Screen\Layout`, а не от `Orchid\Screen\Layouts\Base`. 

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

## Сообщение о релизе

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

## Иконки

Отображение иконок было переработано с `font` на `SVG` формат. 
Теперь методы `->icon` принимают не значение `css` которое необходимо установить, а название файла.
В большинстве случаев необходимо только убрать префикс `icon-`.



