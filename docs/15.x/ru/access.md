---
title: Права доступа
description: Регистрация разрешений и назначение прав пользователям и ролям.
---

Разрешения определяют доступные действия, роли объединяют их для назначения пользователю.
В логике приложения проверяйте разрешения, а для доступа к конкретным записям используйте политики Laravel.
Скрытие кнопки или меню не заменяет авторизацию.

## Регистрация разрешений

Добавьте группы в метод `permissions()` поставщика Orchid в приложении:

```php
use Orchid\Access\PermissionGroup;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    public function permissions(): array
    {
        return [
            PermissionGroup::make('Orders')
                ->add('orders.view', 'View orders')
                ->add('orders.update', 'Update orders'),
        ];
    }
}
```

В обычном поставщике Laravel внедрите `Orchid\Platform\Orchid` в `boot()` и вызовите
`$orchid->registerPermissionGroup($group)` для каждой группы. Для статических вызовов используйте
`Orchid\Support\Facades\Orchid`. Регистрация делает разрешение доступным для назначения, но не выдаёт его пользователям.

Встроенные ключи включают `orchid.users`, `orchid.roles` и `orchid.attachment`.
Миграция старых назначений описана в [руководстве по обновлению](/ru/docs/upgrade).

## Проверка доступа

```php
$user->hasAccess('orders.view');
$user->hasAnyAccess(['orders.view', 'orders.update']);
$user->hasAccess('orders.*');
```

`hasAccess()` проверяет собственные права пользователя и права его ролей. Любое совпавшее разрешение даёт доступ.
Запрет в собственных правах не отменяет разрешение роли. `hasAnyAccess()` проверяет наличие хотя бы одного разрешения;
пустой список не ограничивает доступ. Маска в проверке сопоставляется с именами назначенных разрешений.

```php
use App\Models\User;

User::byAccess('orders.view')->get();
User::byAnyAccess(['orders.view', 'orders.update'])->get();
```

Эти scopes проверяют точные ключи без масок.
После изменения назначений уже загруженного пользователя вызовите `$user->clearCachePermission()` перед новой проверкой.
Методы `addRole()`, `removeRole()` и `replaceRoles()` сбрасывают этот кеш самостоятельно.

## Значение permissions

User и Role приводят `permissions` к `Orchid\Access\Permissions`. Присвойте карту прав или объект Permissions и сохраните:

```php
use Orchid\Access\Permissions;

$user->permissions = Permissions::make(['orders.view' => true]);
$user->save();

$user->permissions->isActive('orders.view');
$user->permissions->allows('orders.*');
$user->permissions->count();
$user->permissions->toArray();
```

`count()` считает разрешённые ключи. `isEmpty()` проверяет отсутствие любых назначений, включая запреты.
Это не массив и не изменяемая коллекция Laravel. Для изменения получите карту через `toArray()`, обновите её,
присвойте обратно и сохраните модель. При расширении `casts()` сохраняйте родительское приведение Permissions.

`Orchid::allowedPermissions()` возвращает объект Permissions со всеми зарегистрированными разрешениями.
В авторизованном обработчике формы прав Orchid используйте
`Permissions::fromEncodedForm($request->input('permissions', []))` для декодирования ключей флажков.
Изменять назначения должен только администратор с соответствующими правами.

## Роли

Новая схема использует UUID для ролей и уникальные имена. Колонки `slug` больше нет.
Вместо удалённых `getRoles()`, `getUsers()`, `getRoleId()` и `getRoleSlug()` используйте отношения Eloquent:

```php
use Orchid\Platform\Models\Role;

$role = Role::create([
    'name' => 'Editor',
    'permissions' => ['orders.view' => true, 'orders.update' => true],
]);

$user->addRole($role);
$user->roles()->get();
$user->inRole($role);
$role->users()->get();
$user->removeRole($role);
```

Ключ доступен через `$role->getKey()`, имя через `$role->name`.
`inRole()` принимает модель роли, ID или имя. Для назначения и удаления передавайте модель.
Перед использованием UUID-моделей существующим базам нужна [миграция схемы](/ru/docs/upgrade).

## Защита экранов и маршрутов

Определите необходимые разрешения экрана:

```php
public function permission(): ?iterable
{
    return ['orders.view'];
}
```

Если указано несколько разрешений, достаточно одного. По умолчанию отказ возвращает HTTP 403.
Для другого ответа переопределите статический метод `unaccessed()` экрана.
В обработчиках действий дополнительно проверяйте доступ к конкретной записи и валидируйте входные данные.

Для маршрутов вне настроенной группы middleware Orchid зарегистрируйте псевдоним в `bootstrap/app.php`:

```php
use Illuminate\Foundation\Configuration\Middleware;
use Orchid\Platform\Http\Middleware\Access;

// In bootstrap/app.php:
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias(['access' => Access::class]);
})
```

```php
Route::screen('/orders', OrderListScreen::class)->middleware('access:orders.view');
```

В Blade проверяйте пользователя через `@if (auth()->user()?->hasAccess('orders.view'))`.

## Создание администратора

```shell
php artisan orchid:admin
php artisan orchid:admin --id=1
```

Команда выдаёт разрешения, зарегистрированные на момент её запуска. Новые разрешения нужно назначать отдельно.
Чтобы изменить создание пользователя, зарегистрируйте свою модель через `Orchid::useModel()` и переопределите `createAdmin()`.

## Вход от имени другого пользователя

Проверяйте право на смену пользователя до вызова. Настроенный guard Orchid должен поддерживать сессии:

```php
use Orchid\Access\Impersonation;

Impersonation::loginAs($otherUser);
Impersonation::isImpersonating();
$originalUser = Impersonation::impersonator();
Impersonation::logout();
```
