---
title: Тестирование
description: Orchid screen testing
---

В настоящее время разработка качественного программного обеспечения тесно связана с автоматизированным тестированием. Поэтому пакет содержит инструменты тестирования, которые помогут вам упростить его.

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
    $screen = $this->screen('platform.example');

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

Во многих случаях маршруты принимают параметры, например `users/{user}/edit`, чтобы их передать можно использовать метод:

```php
$screen = $this->screen('platform.systems.users.edit')
    ->parameters([
        'user' => 1,
    ]);
```

Метод `parameters` добавляет значения только к GET параметрам.

Скорее всего, ваши маршруты закрыты от гостей и доступны только авторизованным пользователям. В этом случае нужно вызвать метод `actingAs` передающий пользователя для входа в систему..

```php
// Create a single App\Models\User instance...
$user = User::factory()->create();

$screen = $this->screen('platform.example')->actingAs($user);
```

При запросе у вас может возникнуть 403 ошибка - которая означает что у пользователя недостаточно прав.
Один из вариантов получить все доступные права через фасад `Dashboard`

```php
use Orchid\Support\Facades\Dashboard;

// Create a single App\Models\User instance...
$user = User::factory()->create([
  'permissions' => Dashboard::getAllowAllPermission(),
]);

$screen = $this->screen('platform.example')->actingAs($user);
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
            'permissions' => Dashboard::getAllowAllPermission(),
        ]);
    }
}
```
