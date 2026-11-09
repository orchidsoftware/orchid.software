---
title: Testing
description:
    Learn how to test your Laravel Orchid applications with our comprehensive documentation on testing. From unit tests
    to browser tests, we cover it all.
---

Nowadays, the development of high-quality software is intertwined with automated testing. Therefore, the package
contains testing tools to help you make it easy.

To use them, it is enough to add the `ScreenTesting` trait to your testing class, for example:

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

After that, a new method for obtaining screen data by route name will be available:

```php
public function testExampleScreen()
{
    $screen = $this->screen('orchid.example');

    $screen
        ->display()
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

In many cases, routes take parameters, for example `users/{user}/edit`. To pass them, you can use the method:

```php
$screen = $this->screen('orchid.users.edit')
    ->parameters([
        'user' => 1,
    ]);
```

> Note. If your action relies on GET parameters, for example for action `/admin/orders/approve?order=1`, then this value
> must also be set, using method `parameters`.

Most likely, your routes are closed from guests and are available only for users. You need to call the `actingAs` method
passing the user to log in.

```php
// Create a single App\Models\User instance...
$user = User::factory()->create();

$screen = $this->screen('orchid.example')->actingAs($user);
```

You may get a `403|401 Error` when prompted - which means that the user does not have enough rights. One option is to
get all available permissions through the `Orchid` facade.

```php
use Orchid\Support\Facades\Orchid;

$user = User::factory()->create([
  'permissions' => Orchid::allowedPermissions(),
]);

$screen = $this->screen('orchid.example')->actingAs($user);
```

A more elegant solution is to define a method in the factory:

```php
class UserFactory extends Factory
{
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

## Database isolation

Application feature tests that use a database may use Laravel's lazy refresh trait:

```php
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class OrderTest extends TestCase
{
    use LazilyRefreshDatabase;
    use ScreenTesting;
}
```

This defers the database refresh until the first query. It still uses transactions for isolation.
A browser runs requests in a separate process and cannot share the test's transaction. Use the appropriate Dusk
migration or truncation lifecycle and a dedicated test database. Never point a refresh trait at production data.

## Temporary screen routes

Register a screen without adding a permanent application route:

```php
$this->screen()
    ->register(OrderScreen::class)
    ->actingAs($user)
    ->display()
    ->assertOk();
```

`register()` uses the `web` middleware by default. Supply the actual application's middleware when testing those checks.
`screen($name, $parameters)` also accepts route parameters directly. The helper supports `session()`, `from()`,
`followingRedirects()`, and `method()` for request scenarios. Assert outcomes, validation failures, and access denial.

## Contributing to the platform package

These commands run in a platform checkout, not in an application that merely requires Orchid.
The package uses Testbench Workbench, PHPStan level 3 with Larastan, and Rector. Psalm is no longer used.
Strict rules and a custom PHPStan temporary directory are not required.

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

The browser commands require Chrome and a compatible ChromeDriver. Workbench builds and publishes the fixture app;
its configured test database is separate from the in-memory database used by the main suite.
