---
title: Тестирование
description: Orchid screen testing
---

В настоящее время разработка качественного программного обеспечения тесно связана с автоматизированным тестированием.
Поэтому пакет содержит инструменты тестирования, которые помогут вам упростить его.

Для их использования достаточно добавить трейт `ScreenTesting` в свой тестовый класс, например:

```php
namespace Tests\Feature;

use Orchid\Support\Testing\ScreenTesting;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use ScreenTesting;
    //...
}
```

После этого станет доступен новый метод получения данных экрана по имени маршрута:

```php
public function testExampleScreen()
{
    $screen = $this->screen('orchid.example');

    $screen->display()
        ->assertSee('Example screen');

    $screen
        ->method('showToast')
        ->assertSee('Hello, world! This is a toast message.');

    $screen
        ->method('showToast', [
            'toast' => 'Custom message'
        ])
        ->assertSee('Custom message');
}
```

Во многих случаях маршруты принимают параметры, например `users/{user}/edit`, чтобы их передать можно использовать
метод:

```php
$screen = $this->screen('orchid.users.edit')
    ->parameters([
        'user' => 1,
    ]);
```

Метод `parameters` добавляет значения только к GET параметрам.

Скорее всего, ваши маршруты закрыты от гостей и доступны только авторизованным пользователям. В этом случае нужно
вызвать метод `actingAs` передающий пользователя для входа в систему..

```php
// Create a single App\Models\User instance...
$user = User::factory()->create();

$screen = $this->screen('orchid.example')->actingAs($user);
```

При запросе у вас может возникнуть 403 ошибка - которая означает что у пользователя недостаточно прав. Один из вариантов
получить все доступные права через фасад `Orchid`

```php
use Orchid\Support\Facades\Orchid;

// Create a single App\Models\User instance...
$user = User::factory()->create([
  'permissions' => Orchid::allowedPermissions(),
]);

$screen = $this->screen('orchid.example')->actingAs($user);
```

Более элегантным решением будет определить метод в самой фабрике:

```php
class UserFactory extends Factory {

    // ...

    /**
     * Indicate that the model's must have all permissions.
     *
     * @return static
     */
    public function admin()
    {
        return $this->state(fn (array $attributes) => [
            'permissions' => Orchid::allowedPermissions(),
        ]);
    }
}
```

## Изоляция базы данных

В тестах приложения можно использовать ленивое обновление базы Laravel:

```php
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class OrderTest extends TestCase
{
    use LazilyRefreshDatabase;
    use ScreenTesting;
}
```

Подготовка базы откладывается до первого запроса. Для изоляции по-прежнему используются транзакции.
Браузер отправляет запросы в отдельном процессе и не видит транзакцию теста. Для Dusk используйте соответствующий
жизненный цикл миграций или очистки и отдельную тестовую базу. Не направляйте refresh-трейты на рабочие данные.

## Временные маршруты экранов

Экран можно зарегистрировать без постоянного маршрута приложения:

```php
$this->screen()
    ->register(OrderScreen::class)
    ->actingAs($user)
    ->display()
    ->assertOk();
```

`register()` по умолчанию использует middleware `web`. Для проверки ограничений передайте настоящий набор приложения.
`screen($name, $parameters)` также принимает параметры маршрута вторым аргументом.
Доступны `session()`, `from()`, `followingRedirects()` и `method()`. Проверяйте результат действий, валидацию и отказ доступа.

## Разработка самого пакета

Эти команды выполняются в checkout platform, а не в приложении, которое подключает Orchid как зависимость.
Пакет использует Testbench Workbench, PHPStan уровня 3 с Larastan и Rector. Psalm больше не используется.
Набор strict rules и собственный временный каталог PHPStan не требуются.

```shell
composer install
vendor/bin/phpunit --testsuite=Main --no-coverage
vendor/bin/phpstan analyse --no-progress --memory-limit=3G
vendor/bin/rector process --dry-run --no-progress-bar
```

```shell
COMPOSER_ROOT_VERSION=dev-master vendor/bin/testbench-dusk workbench:build
vendor/bin/dusk-updater detect --auto-update
CI=true COMPOSER_ROOT_VERSION=dev-master vendor/bin/phpunit --testsuite=Browser --no-coverage
```

Для браузерных проверок нужны Chrome и совместимый ChromeDriver. Workbench собирает и публикует тестовое приложение;
его база отделена от in-memory базы основного набора.
