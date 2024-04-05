---
title: Руководство по обновлению
---

Нам нравится делать вещи как можно более современными и придерживаться подхода «release early, release often»(«выпускайте раньше, выпускайте чаще») 
к основным выпускам. Это означает, что мы не будем ждать произвольное количество месяцев, чтобы накопить большие изменения 
и выпустить следующую основную версию. Благодаря частому выпуску основных версий новые функции будут доступны раньше, 
а обновление на свежую версию будет намного проще.

> Мы пытаемся задокументировать все возможные критические изменения. Некоторые из этих изменений относятся к внутренним обращениям, поэтому только часть этих изменений может фактически повлиять на ваше приложение.

## Обновление до версии 15.0 с версии 14.x

## Обновление с версии 14.x до 15.0

Исторически, в развитии Orchid закрепились определённые обозначения: фасад `Dashboard`, файл конфигурации `platform.php` и применение различных наименований. Ранее мы рассматривали возможность сделать Orchid более модульным, выпустив несколько версий с этой целью. Однако данное решение оказалось не самым удачным, и его последствия до сих пор заметны. Для новых пользователей непонятно, почему пакет называется `orchid`, а файл конфигурации — `platform.php`, и так далее.

С выпуском версии 15.0 мы внесли критические изменения, включая переименование всех `routes`, `middleware`, `facade`, файлов конфигурации и префикса шаблонов на `orchid`. Это существенное изменение, но необходимое для обеспечения будущего развития Orchid.

Для облегчения процесса обновления и гарантирования плавного перехода мы предоставляем пошаговую инструкцию по обновлению до Orchid 15.0.

### Обновление зависимостей

В файле `composer.json` обновите зависимость `orchid/platform` до версии `^15.0`.

### Переменные среды

Теперь переменные среды имеют префикс `ORCHID_`, вместо `DASHBOARD_`:

```php
DASHBOARD_DOMAIN => ORCHID_DOMAIN
DASHBOARD_PREFIX => ORCHID_PREFIX
DASHBOARD_FILESYSTEM_DISK => ORCHID_FILESYSTEM_DISK
```

### Группа middleware

Группа middleware, используемая для приватных страниц, была переименована с `platform` на `orchid`.

### Фасад 

Фасад `Orchid\Support\Facades\Dashboard;` теперь переименован в `use Orchid\Support\Facades\Orchid;`

### Шаблоны и переводы

Теперь шаблоны и переводы используют префикс `orchid`, вместо `platform`.

### Разрешения

Разрешения также были переименованы, например, `platform.systems.attachment` на `orchid.systems.attachment`. Вам необходимо внести изменения в вашу базу данных, чтобы обновить информацию о пользователях и ролях.

### Имена маршрутов

Имена маршрутов были изменены, теперь они начинаются с `orchid`, вместо `platform`.

### Удалены устаревшие методы

Все устаревшие методы и константы, такие как `MAIN_MENU`, были удалены.


## Обновление до версии 14.0 с версии 13.x

Обновление Laravel Orchid с версии `13.x` до `14.0` может быть процессом, который будет простым, если выполнен правильно.

Перед началом процесса обновления важно создать резервную копию вашего текущего приложения и протестировать процесс обновления в разработочной среде. Это поможет обнаружить и устранить любые неожиданные проблемы до того, как они повлияют на рабочую среду.

### Обновление зависимостей

В файле `composer.json` обновите зависимость `orchid/platform` до версии `^14.0`.

### Laravel 10.x

Теперь для установки или обновления требуется Laravel 10. Описания обновлений для существующих проектов можно найти в [документации](https://laravel.com/docs/10.x/upgrade).

### Сохранение состояния

Одной из основных новых функций этого выпуска является возможность сохранения состояния публичных свойств между действиями на экране.

Вот пример. В методе `query` вы можете установить публичные свойства, которые будут доступны в методах `name/layouts` и других.

Теперь эти публичные свойства будут сохранены и будут доступны во время выполнения методов.

```php
public $idea;

public function query() : array
{
    return [
        'idea' => Idea::first()
    ];
}

public function yourMethod()
{
    $this->idea; 
    // Свойство не является пустым и содержит
    // значение, установленное в начале.
}
```

### Маршрутизация

Ранее в Orchid использовалось собственное решение для определения аргументов маршрута. Однако для большинства методов (query/method) теперь используется то же решение, что и в контроллерах. Это позволяет определять следующее:

```php
Route::screen('/posts/{post:slug}', ExampleScreen::class);

Route::screen('/task', ExampleScreen::class)->withTrashed();
```

Также это позволяет использовать другие возможности, которые ранее не были доступны.

> Обратите внимание, что раньше в наших учебниках иногда указывалась модель по умолчанию, что иногда приводило к отсутствию параметра.
> Однако теперь это вызывает ошибку 404.

### Слушатель

Работа со слушателями ранее могла вызывать затруднения у пользователей. Поэтому у слушателей больше нет свойства для указания метода экрана. Вместо этого есть обязательный метод с именем `handler`. В этот метод передается текущее состояние экрана в качестве первого аргумента, а объект `request` передается в качестве второго аргумента.

```php
namespace App\Orchid\Layouts;

use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class SubtractListener extends Listener
{
    /**
     * Список имен полей, значения которых будут отслеживаться.
     *
     * @var string[]
     */
    protected $targets = [
        'minuend',
        'subtrahend',
    ];

    /**
     * @return Layout[]
     */
    protected function layouts(): iterable
    {
        return [
            Layout::rows([
                Input::make('minuend')
                    ->title('Первый аргумент')
                    ->type('number'),

                Input::make('subtrahend')
                    ->title('Второй аргумент')
                    ->type('number'),

                Input::make('result')
                    ->readonly()
                    ->canSee($this->query->has('result')),
            ]),
        ];
    }

    /**
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        [$minuend, $subtrahend] = $request->all();

        return $repository
            ->set('minuend', $minuend)
            ->set('subtrahend', $subtrahend)
            ->set('result', $minuend - $subtrahend);
    }
}
```

### Автоматическая фильтрация и сортировка HTTP

Ранее автоматические фильтры были основаны на типе данных, вводимых пользователем, что часто вызывало ошибки. Например, когда пользователь использовал запятую для поиска текста, фильтр иногда распознавал ее как массив.
Поэтому теперь фильтры должны явно указывать свое поведение:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Post extends Model
{
    use Filterable;

    protected $allowedFilters = [
        'id' => Where::class,
        'content' => Like::class,
    ];
}
```

Еще одно важное изменение состоит в том, что мы теперь получаем имя столбца без изменений. Поэтому нельзя использовать точечную нотацию для JSON-полей.
Мы работаем над поиском более эффективного и более безопасного способа обработки JSON-полей в будущем.

### Навигация

В версии 14.0 мы удалили выпадающее меню профиля. Вместо этого рекомендуется указывать информацию о профиле в главном меню или на экранах. Убедитесь, что вы удалили все ссылки на константу `Dashboard::MENU_PROFILE` и метод `registerProfileMenu` в сервис-провайдере из вашего кода.

Например, следующий элемент больше не будет работать корректно:

```php
public function registerProfileMenu(): array
{
    return [
        Menu::make('Документация')
            ->title('Docs')
            ->icon('docs')
            ->url('https://orchid.software/en/docs'),
    ];
}
```

Вместо этого создайте элементы меню с помощью метода `registerMenu`:

```php
public function registerMenu(): array
{
    return [
        Menu::make('Документация')
            ->title('Docs')
            ->icon('docs')
            ->url('https://orchid.software/en/docs'),
    ];
}
```

Все методы, зависящие от `location`, теперь больше не требуют этот аргумент. Например, метод `addMenuSubElements` теперь напрямую указывает на целевой slug:

```php
use Orchid\Support\Facades\Dashboard;

Dashboard::addMenuSubElements('sub-menu', [
    Menu::make('Элемент подменю 3')->icon('badge')
]);
```

### Иконки

В новой версии мы обновили иконки на набор из Bootstrap. Замена всех иконок в существующих приложениях может быть непростой задачей, но у вас есть возможность продолжать использовать иконки от Orchid.

Для этого просто добавьте следующую строку в ваш файл `composer.json`:

```bash
"orchid/icons": "^2.0",
```

Затем укажите в вашем файле конфигурации:

```php
'icons' => [
    'orc' => \Orchid\IconPack\Path::getFolder(),
],
```

Таким образом, вы продолжите использовать набор иконок от Orchid, который не обновлялся некоторое время из-за отсутствия дизайнера.

Чтобы также отображались новые иконки, добавьте:

```php
'icons' => [
    // ...
    'bs' => \Orchid\Support\BootstrapIconsPath::getFolder(),
],
```

### Выход и завершение подмены

Поведение действий "Выход" и "Завершение подмены" должно быть явно определено разработчиком. Для этого вы можете добавить кнопки на ваш экран профиля.

Вот пример того, как вы можете определить эти кнопки:

```php
use Orchid\Screen\Actions\Button;
use Orchid\Access\Impersonation;

public function commandBar(): iterable
{
    return [
        Button::make('Вернуться к моей учетной записи')
            ->canSee(Impersonation::isSwitch())
            ->icon('bs.people')
            ->route('platform.switch.logout'),

        Button::make('Выйти')
            ->icon('bs.box-arrow-left')
            ->route('platform.logout'),
    ];
}
```

- Первая кнопка "Вернуться к моей учетной записи" используется для завершения подмены и возврата к первоначальной учетной записи. Эта кнопка будет видна только при нахождении пользователя в режиме подмены.
- Вторая кнопка "Выйти" используется для выхода из системы.

Определяя поведение этих кнопок самостоятельно, у вас будет больше возможностей для управления действиями выхода и завершения подмены в вашем приложении Orchid.


## Обновление до 12.0 с 11.x

### Обновление зависимостей

В вашем файле `composer.json` обновите зависимость `orchid/platform` до `^12.0`

### Laravel 9.x

Теперь для установки или обновления требуется Laravel 9. Описания обновлений для существующих проектов можно найти в [документации](https://laravel.com/docs/9.x/upgrade).



## Обновление до 11.0 с 10.x

### Обновление зависимостей

В вашем файле `composer.json` обновите зависимость `orchid/platform` до `^11.0`

### Publish assets files

Вместо создания символической ссылки для загрузки ресурсов появилась новая команда для их публикации:

```bash
php artisan orchid:publish
```

Это поместит `JS/CSS` в директорию `public/vendor/orchid`. Также потребуется автоматизировать внесение изменений в composer.json:

```json
{
    "scripts": {
        "post-update-cmd": [
            "@php artisan orchid:publish --ansi"
        ]
    }
}
```

### Иконки

Значки теперь могут быть полностью заменены и не загружаются принудительно. Чтобы продолжить их использование, измените файл конфигурации:

```php
'icons' => [
    'orc' => \Orchid\IconPack\Path::getFolder(),
],
```

### Экран

Публичные свойства экрана теперь автоматически заполняются значениями по ключу из метода `query()`. Например:

```php
class IdeaScreen extends Screen
{
    public $name = 'Edit User';

    public function query(): array
    {
        return [
            'name' => 'Welcome',
        ];
    }
}
```

Значение свойства `name` будет перезаписано.
Чтобы этого избежать, измените видимость свойства на `protected`

```php
class IdeaScreen extends Screen
{
    protected $name = 'Edit User';

    public function query(): array
    {
        return [
            'name' => 'Welcome',
        ];
    }
}
```


### Компонент

Указание ожидаемого имени аргумента для компонентов больше не требуется:

```php
// Раньше
TD::make('index')->component(OrderShortInformation::class, 'order', [
    'limit' => 100
]);

// Сейчас
TD::make('index')->component(OrderShortInformation::class, [
    'limit' => 100
]);
```


### Метрики

Вместо отдельного класса теперь используется короткий синтаксис::

```php
use Orchid\Support\Facades\Layout;

public function query(): array
{
    return [
        'metrics' => [
            'sales'    => ['value' => number_format(6851), 'diff' => 10.08],
            'total'    => number_format(65661),
        ],
    ];
}
    
public function layout(): iterable
{
    return [
        Layout::metrics([
            'Sales Today'    => 'metrics.sales',
            'Total Earnings' => 'metrics.total',
        ]),
    ];
}
```


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



