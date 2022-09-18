---
title: Права доступа
description: Как правило, вы управляете несколькими дюжинами разрешений в типичном бизнесе процессе.
---

Обычно пользователям не назначаются разрешения в приложении (хотя такая возможность имеется), а скорее роли.  Роль связана с набором разрешений, а не с отдельным пользователем. 

> **Примечание.** Права доступа не являются заменой для `Gate` или `Policies` входящих в состав фреймворка.


Как правило, вы управляете несколькими дюжинами разрешений в типичном бизнес-процессе. 
Вы также можете иметь, скажем, от 10 до 100 пользователей.
Хотя эти пользователи не  сильно отличаю друг от друга,
вы можете разделить их на логические группы в соответствии с тем, что они делают с программой.
Эти группы называются ролями.

Если вам нужно было управлять пользователями напрямую, назначив им разрешения,
это было бы утомительным и ошибочным,
из-за большого количества пользователей и разрешений. 


- Вы можете группировать одно, два или больше разрешений в роли.
- Пользователю назначается одна или несколько ролей.
- Набор разрешений, которыми владеет пользователь, вычисляется как объединение разрешений от каждой роли пользователя.


## Применение


Метод `hasAccess` строго требует, чтобы переданное разрешение было действительным для предоставления доступа.

```php
// Check is carried out both for the user and for his role
Auth::user()->hasAccess($string);
```

Метод `hasAnyAccess` предоставит доступ, если какое-либо разрешение пройдет проверку.

```php
$user = User::find(1);

if ($user->hasAnyAccess(['user.admin', 'user.update'])) {
    // Execute this code if the user has permission
}
```

Разрешения можно проверить на основе подстановочных знаков, используя символ `*` , соответствующий любому набору разрешений.

```php
$user = User::find(1);

if ($user->hasAccess('user.*')) {
    // Execute this code if the user has permission
}
```

У пользователя есть несколько вариантов управления ролями:

```php
// Получить все роли пользователя
Auth::user()->getRoles();

// Проверить имеет ли пользователь роль
Auth::user()->inRole($role);

// Добавить к пользователю роль
Auth::user()->addRole($role);
```

В редких случаях может потребоваться выбрать пользователей, у которых есть разрешение, напрямую или через роль. Для этого вы можете использовать:

```php
User::byAccess('platform.systems.users')->get();

// Or if the user has at least one of the passed permissions
User::byAnyAccess([
   'platform.systems.users'   
   'non existent',
])->get();
```

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

Чтобы дать существующему пользователю максимальные разрешения, запустите с параметром `--id` :

```php
php artisan orchid:admin --id=1
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



## Roles vs Permissions

Как правило, лучше всего разрабатывать приложение, ориентируяся только на разрешения.

Роли по-прежнему можно использовать для группировки разрешений для простого назначения, и вы по-прежнему можете использовать 
вспомогательные методы на основе ролей, если это действительно необходимо. Но большую часть логики, связанной с приложением, 
обычно лучше всего контролировать с помощью методов can, что позволяет слою Laravel Gate выполнять всю тяжелую работу.

Например: у `users` есть  `roles`, а у `roles` есть `permissions`, и ваше приложение всегда проверяет наличие `permissions`, а не `roles`.

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
     * @return string
     */
    public function name(): ?string
    {
        return 'History';
    }

    /**
     * Display header description.
     *
     * @return string
     */
    public function description(): ?string
    {
        return 'History of changes to system objects';
    }

    /**
     * Permission
     *
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'systems.history'
        ];
    }
        
    // ...
}
```

Если перечислено несколько ключей, то доступ будет предоставлен при наличии у пользователя хотя бы одного разрешения.

При отсутствии доступа доступа будет вызван статический метод `unaccessed`, который по умолчанию покажет 403 ошибку. Вы можете переопределить это поведение, например на страницу оплаты или вернуть иной ответ:

```php
use Illuminate\Http\RedirectResponse;

/**
 * @return \Illuminate\Http\RedirectResponse
 */
public static function unaccessed(): RedirectResponse
{
    return redirect('/other-screen');
}
```

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
Route::screen('/stories', StoriesScreen::class)->middleware('access:systems.history');
```

Так же вы можете объединять их в группы:

```php
Route::middleware(['access:systems.history'])->group(function () {
    Route::screen('/stories', StoriesScreen::class);
    Route::get('stories/best', function () {
        // ...
    });
});
```
## Проверка в Blade

Для приложений, которые полагаются на шаблоны Blade для рендеринга, будет удобно добавить ["Пользовательские операторы If"](https://laravel.com/docs/8.x/blade#custom-if-statements) следующим образом:

```php
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

/**
 * Bootstrap any application services.
 *
 * @return void
 */
public function boot()
{
    Blade::if('hasAccess', function (string $value) {
        $user = Auth::user();

        if ($user === null) {
            return false;
        }

        return $user->hasAccess($value);
    });
}
```

После определения пользовательского условия вы можете использовать его в своих шаблонах:

```html
@hasAccess('platform.index')
    <!-- User has permission 'platform.index' -->
@elsehasAccess('platform.other')
    <!-- User does not have permission 'platform.index', but has 'platform.other' -->
@else
    <!-- User does not have permission 'platform.index' and 'platform.other'  -->
@endhasAccess

@unlesshasAccess('platform.index')
    <!-- User does not have permission 'platform.index' -->
@endhasAccess
```

## User Impersonation

Отличительной особенностью является возможность выдавать себя за других пользователей. Как администратор, вы можете просматривать все экраны, как если бы вы вошли в систему как другой пользователь. Это позволяет вам обнаружить проблему, о которой сообщил ваш пользователь.


По умолчанию в унаследованной пользовательской модели уже есть возможность «Войти как».  Но если вы хотите использовать это в другой модели, то для этого вам нужно добавить трейт Orchid\Access\UserSwitch. `Orchid\Access\UserSwitch`.

Выдать себя за другого пользователя::

```php
Auth::user()->loginAs($otherUser);
```

Прекратите выдавать себя за другого пользователя:

```php
Auth::user()->logout();
```

Чтобы проверить, выдает ли себя пользователь за кого-то другого, используйте:

```php
if (Auth::user()->isSwitch()) {
    // User impersonates someone else
}
```
