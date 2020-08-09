---
title: Права доступа
description: Как правило, вы управляете несколькими дюжинами разрешений в типичном бизнесе процессе. 
extends: _layouts.documentation
section: main
lang: ru
---

Обычно пользователям не назначаются разрешения в приложении (Хотя такая возможность имеется), а скорее роли.  Роль связана с набором разрешений, а не с отдельным пользователем. 

Как правило, вы управляете несколькими дюжинами разрешений в типичном бизнес-процессе. 
Вы также можете иметь, скажем, от 10 до 100 пользователей.
Хотя эти пользователи не полностью отличные друг от друга,
вы можете разделить их на логические группы в соответствии с тем, что они делают с программой.
Эти группы называются ролями.

Если вам нужно было управлять пользователями напрямую, назначив им разрешения,
это было бы утомительным и ошибочным,
из-за большого количества пользователей и разрешений. 


- Вы можете группировать одно, два или больше разрешений в роли.
- Пользователю назначается одна или несколько ролей.
- Набор разрешений, которыми владеет пользователь, вычисляется как объединение разрешений от каждой роли пользователя.


У пользователя есть несколько вариантов управления ролями:

```php
// Проверяем, имеет ли пользователь права
// Проверка осуществляется как для пользователя, так и для его роли
Auth::user()->hasAccess($string);

// Получить все роли пользователя
Auth::user()->getRoles();

// Проверить имеет ли пользователь роль
Auth::user()->inRole($role);

// Добавить к пользователю роль
Auth::user()->addRole($role);
```

> **Примечание.** Права доступа не являются заменой для `Gate` или `Policies` входящих в состав фреймворка.

## Роли

Роли также имеют процедуры для:

```php
// Возвращает всех пользователей с этой ролью
$role->getUsers();
```


## Создание администратора

Чтобы создать пользователя с максимальными (на момент создания) правами, выполните следующую команду:


```php
php artisan orchid:admin nickname email@email.com secretpassword
```


## Добавление собственных разрешений


Вы можете определять ваши собственные разрешения в приложениях.
 Используя их, вы явно реализуете доступ к определённым функциям.

Пример добавления собственных разрешений с использованием поставщика:

```php
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('modules')
            ->addPermission('analytics', 'Access to data analytics')
            ->addPermission('monitor', 'Access to the system monitor');

        $dashboard->registerPermissions($permissions);
    }
}
```

## Проверка в Экранах

Каждый созданный экран уже имеет встроенную проверку прав, установленных с помощью свойства 
`$permission`, которое принимает как массив, так и строковое значение для проверки:

```php
namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class History extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'History';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'History of changes to system objects';

    /**
     * Permissions for this screen
     *
     * @var array|string
     */
    public $permission = [
        'systems.history'
    ];
    
    // ...
}
```

Если перечислено несколько ключей, то доступ будет предоставлен при наличии у пользователя хотя бы одного разрешения.


## Проверка в Middleware

Небольшие приложения могут не нуждаться в определении прав для каждого экрана или класса,
вместо этого имеет смысл проверять их наличие для маршрутов. 
Для этого необходимо зарегистрировать новый `middleware` в `app/Http/Kernel`:

```php
/**
 * The application's route middleware.
 *
 * These middleware may be assigned to groups or used individually.
 *
 * @var array
 */
protected $routeMiddleware = [
    //...
    'access' => \Orchid\Platform\Http\Middleware\Access::class,
];
```

После этого его можно использовать при любых определений маршрута, через передачу параметра `access:my-permission`, так же как и в `Auth::user()->hasAccess($string);`

```php
Route::middleware('access:systems.history')->get('/stories', function () {
   // ...
});
```

Так же вы можете объединять их в группы:

```php
Route::middleware(['access:systems.history'])->group(function () {
    Route::get('/stories', function () {
        // ...
    });

    Route::get('stories/best', function () {
        // ...
    });
});
```
