---
title: Руководство по обновлению
extends: _layouts.documentation
section: main
lang: ru
---

# Обновление до 8.0 с 7.x


## Обновление зависимостей

В вашем файле `composer.json` обновите зависимость `orchid/platform` до `^8.0`


## Конструктор экрана

В передаче обьекта `request` и вызова родительского класса больше нет необходимости. 
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


## Маршруты экрана

### Методы

Не использованые методы были удалены.
Больше нельзя обратиться к экранам через методы `PUT|PATCH|DELETE`, 
обращение должно использовать `GET|POSTS` для получения/отправки данных.

```php
Method           | URI                                  | Name
-----------------+--------------------------------------+--------------
GET|HEAD|POST    | dashboard/idea/{method?}             | platform.idea
```


### Подмена данных экрана (Acync)

Ожидание `{argument?}` было удалено из адресной строки.
Теперь для обращения используеться отдельный маршрут:

```php
$this->router->post('async/{screen}/{method?}/{template?}', [AsyncController::class, 'load'])->name('async');
```


## Хлебные крошки

Пакет `davejamesmiller/laravel-breadcrumbs` заменён на  `tabuna/breadcrumbs` 
и должен быть установлен автоматически при обновлении зависимостей.


> **Примечание.** Может потребоваться удаление загрузочных файлов кэша в директории `bootstrap/cache`.

Синтаксис нового пакета позволяет указывать хлебные крошки прямо в определнии маршрута:

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


## Редактор TinyMCE

`Html` редактор был удалён из стандартной поставке, для его использование необходимо установить новую зависимость `orchidcommunity/tinymce`.
А так же изменить пространство имён на 

```php
use OrchidCommunity\TinyMCE\TinyMCE;
```

## Модель настроек

Модель настроек так же была удалена. Данные хранящееся в базе данные, не будут удалены автоматически. 
Для их удаления необходимо выполнить следующий `SQL` код:

```php
DROP TABLE settings;

DELETE FROM migrations
WHERE migration = '2015_12_02_181214_create_table_settings';
```

## Иконки

Отображение иконок было переработано с `font` на `SVG` формат. 
Теперь методы `->icon` принимают не значение `css` которое необходимо установить, а название файла.
В большинстве случаев необходимо только убрать префикс `icon-`.



