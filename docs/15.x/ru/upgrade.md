---
title: Переход на 15.x
description: Обновление приложения 14.x для работы с текущим API 15.x.
---

## Переход с 14.x на 15.x

15.x находится в разработке. До проверки изменений используйте выпущенную версию в рабочем приложении.
Сделайте резервную копию базы и выполните обновление в отдельном окружении.

## Требования и зависимости

Нужны PHP 8.3 или новее и Laravel `^12.4 || ^13.0`. Laravel 10 и 11 больше не поддерживаются.
После выпуска 15.0 укажите `orchid/platform:^15.0` и обновите связанные зависимости вместе.
Для проверки разрабатываемой версии используйте текущие исходники, а не ещё не выпущенный стабильный тег.

## Схема базы и идентификаторы

Для существующей базы 14.x нужна миграция данных приложения перед подключением новых моделей по умолчанию.
Изменённые create-table миграции пакета не выполняются повторно, если Laravel уже записал их как применённые.
`orchid:install` не преобразует существующие рабочие данные.

Новая схема использует UUID для первичных ключей `roles` и `attachments`. `role_users.role_id` становится строкой,
`attachmentable.attachment_id` является UUID внешним ключом, `attachmentable.attachmentable_id` становится строкой.
Pivot вложений больше не требует собственного `id`. Уникальное имя роли `name` заменяет старый `slug`.

Подготовьте и проверьте прямые миграции в приложении:

1. Сделайте резервную копию и найдите все ссылки на ID ролей и вложений, включая собственные таблицы.
2. Создайте соответствия числовых ID и UUID. Обновите записи, pivot-таблицы и внешние ключи приложения вместе.
3. Устраните повторяющиеся имена ролей перед добавлением уникальности. Замените код, зависящий от slug.
4. Проверьте длину имён и путей вложений перед заменой text на string. Сохраните данные приложения из `description`
   и `alt`: этих столбцов нет в новой create-table миграции по умолчанию.
5. Проверьте назначения ролей, владение файлами, загрузку, скачивание и удаление на копии рабочей базы.

Не удаляйте историю миграций, не запускайте `migrate:fresh` и не обрезайте ID ради соответствия новой схеме.
Если сохраняете собственные типы ключей, настройте совместимые модели и связи до создания новых записей.

## Конфигурация, фасад и маршруты

| 14.x | 15.x |
| --- | --- |
| `config/platform.php` | `config/orchid.php` |
| `routes/platform.php` | `routes/orchid.php` |
| Группа middleware `platform` | Группа middleware `orchid` |
| `Orchid\Support\Facades\Dashboard` | `Orchid\Support\Facades\Orchid` |
| `Orchid\Platform\Dashboard` | `Orchid\Platform\Orchid` для внедрения |
| `platform.main` | `orchid.main` |
| `platform.profile` | `orchid.profile` |
| `platform.systems.users` | `orchid.users` |
| `platform.systems.roles` | `orchid.roles` |
| Представления `platform::` | Представления `orchid::` |

Для статических вызовов используйте фасад `Orchid::`. Для внедрения экземпляра ядра нужен `Orchid\Platform\Orchid`.
Обновите маршруты, меню, middleware авторизации, политики, сохранённые ключи прав и пользовательские шаблоны.
Встроенные права пользователей и ролей называются `orchid.users` и `orchid.roles`, работа с файлами использует
`orchid.attachment`. Собственные ключи прав определяет приложение. Меняйте регистрации вместе с назначенными правами.
Имена переменных `PLATFORM_DOMAIN`, `PLATFORM_PREFIX` и `PLATFORM_FILESYSTEM_DISK` сохраняются.

Опубликуйте ресурсы через `php artisan orchid:publish`. Сравните переопределённые представления с новой версией,
прежде чем возвращать изменения. Старые файлы сборки и манифест несовместимы с ресурсами Vite.

## Presenters

Используйте `Orchid\Presenter\Presenter`, `Presentable` и `UsePresenter`:

```php
use App\Orchid\Presenters\PostPresenter;
use Orchid\Presenter\Presentable;
use Orchid\Presenter\UsePresenter;

#[UsePresenter(PostPresenter::class)]
class Post extends Model
{
    use Presentable;
}
```

Дочерняя модель наследует ближайшее объявление. `presenter(OtherPresenter::class)` переопределяет один вызов.
Без объявления или аргумента `presenter()` выбрасывает исключение. Проверьте presenter, которые перенаправляли
методы модели. См. [presenters](/ru/docs/presenters) и [контракт поиска](/ru/docs/global-search).

## URL-фильтры и сортировка

Замените `$allowedFilters` и `$allowedSorts` атрибутами класса:

```php
use Orchid\Filters\AllowedFilters;
use Orchid\Filters\AllowedSorts;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;

#[AllowedFilters(['title' => Like::class])]
#[AllowedSorts(['title', 'created_at'])]
class Post extends Model
{
    use Filterable;
}
```

Старые свойства больше не читаются. Перенесите переопределения дочерних моделей, иначе действует атрибут родителя.
Списки наследуются независимо. Дочерний атрибут заменяет весь список, `[]` отключает его.
Примеры и классы условий описаны в разделе [фильтрации](/ru/docs/filters).

## Локальные scopes

Scopes Orchid используют атрибут Laravel `Scope`. Вызовы `Post::filters()` и `User::countByDays()` сохраняются.
Переведите собственные переопределения `scope...` и прямые вызовы родителей на новые имена методов:

```php
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

#[Scope]
protected function published(Builder $query): void
{
    $query->whereNotNull('published_at');
}
```

При переопределении scope Orchid сохраняйте `#[Scope]` и вызывайте метод родителя без префикса `scope`.

## Преобразования моделей и значения прав

User, Role и Attachment объявляют преобразования в `casts()`. Дополняйте их через `parent::casts()`:

```php
protected function casts(): array
{
    return [...parent::casts(), 'settings' => 'array'];
}
```

Свойство `$casts` дочерней модели не переопределяет одноимённый ключ из `casts()` родителя.
Перенесите такие настройки в метод. Права User и Role используют `Orchid\Access\Permissions`:

```php
use Orchid\Access\Permissions;
use Orchid\Support\Facades\Orchid;

$user->permissions = Orchid::allowedPermissions();
$user->save();

$user->permissions = Permissions::make(['orchid.users' => true]);
$user->save();

$states = $user->permissions->toArray();
```

`allows()` проверяет право в объекте, `toArray()` возвращает массив,
`PermissionGroup::make()->add()` регистрирует группы.
`Orchid::allowedPermissions()` заменяет `Dashboard::getAllowAllPermission()`.
Для закодированных checkbox-полей Orchid используется `Permissions::fromEncodedForm()`.
Удалите ссылки на удалённые контракты `Orchid\Access\UserInterface` и `RoleInterface` в собственных моделях.
Наследуйте модели пакета или подключайте актуальные трейты доступа. См. [права доступа](/ru/docs/access).

## Select вместо Relation

Замените `Relation` на `Select` с ленивой загрузкой модели:

```php
Select::make('user_id')
    ->lazy(20)
    ->fromModel(User::class, 'name')
    ->searchColumns('name', 'email')
    ->applyScope('active');
```

`lazy($chunk)` задаёт размер удалённой порции. `max($count)` ограничивает количество выбранных элементов.
Сохраните scopes, ограничивающие доступ к данным клиента. Выбранные значения разрешаются при отображении.
`allowCreate()` заменяет устаревшее имя `allowAdd()`. Старый endpoint Relation заменён механизмом choices.
См. [Select](/ru/docs/field#select).

## Редакторы и составные поля

`Markdown` заменяет реализацию SimpleMDE. `SimpleMDE` остаётся устаревшим PHP-псевдонимом.
Code и Markdown используют CodeMirror. Удалите плагины старых редакторов и несовместимые параметры.
TextArea остаётся обычным многострочным полем. Вместо удалённого `Upload` используйте `Attach`.

[KeyValue](/ru/docs/field#keyvalue), [BlockEditor](/ru/docs/field#blockeditor) и
[Repeater](/ru/docs/field#repeater) редактируют карты, документы и списки строк.
Проверьте структуру отправляемых данных. Валидация и авторизация остаются на сервере.

## Графики

Orchid Charts заменяет Frappe. Передавайте общие подписи и наборы данных:

```php
return [
    'visits' => [
        'labels' => ['Mon', 'Tue'],
        'datasets' => [['name' => 'Visits', 'values' => [12, 18]]],
    ],
];

// In layout():
Layout::chart('visits', 'Visits')->type(Chart::TYPE_LINE)->height(300);
```

`toChart()` коллекций `Chartable` возвращает всю эту структуру.
Замените свойства отображения методами и допустимыми параметрами. API JavaScript и параметры Frappe удалены.
Смешанные графики, отметки и наследование описаны в разделе [графиков](/ru/docs/charts).

## Навигация, диалоги и уведомления

[SideMenu](/ru/docs/side-menu) добавляет контекстную навигацию между связанными экранами.
Модальные макеты поддерживают `Modal::SIZE_COMPACT` и `scrollable()`.
Панель уведомлений использует диалог и endpoints состояния прочтения вместо старого отдельного экрана.
Используйте `OrchidMessage` и `OrchidChannel`. `DashboardMessage` и `DashboardChannel` сохранены как устаревшие
псевдонимы для записанных уведомлений. Перезаписывать существующие записи уведомлений не требуется.

Глобальный поиск также открывается в диалоге. Удалите ссылки на старый экран поиска.
Проверьте очистку собственных контроллеров Stimulus в `disconnect()` при переходах Turbo.
Сохраняйте клавиатурное управление и работу фокуса при изменении шаблонов.

## Состояние экранов и тесты

Состояние экранов подписывает обычные значения и замыкания. Сохранённые модели Eloquent передаются как
идентификаторы и повторно загружаются из базы. Сохраняйте постоянный `APP_KEY` между запросами.
Подпись состояния не заменяет авторизацию. Проверяйте доступ и введённые данные при каждом действии.

Обновите имена маршрутов и работу с объектом Permissions в тестах.
Для разработки самого пакета используются Testbench Workbench, PHPStan и Rector.
См. [тестирование](/ru/docs/testing).

## Другие изменения публичного API

Для чтения каталога прав используйте `Orchid::permissionGroups()` вместо `Dashboard::getPermission()`.
Опечатка `Screen::asyncParticalLayout()` исправлена на `asyncPartialLayout()`; обновите свои вызовы и переопределения.
Перемещённые трейты доступны как `Orchid\Screen\Concerns\CanSee` и `Orchid\Screen\Concerns\HasCommandBar`.
В новых примерах используйте варианты enum, например `Color::INFO`, вместо старого вызова `Color::INFO()`.
Перед обновлением проверьте совместимость сторонних пакетов Orchid с 15.x.
