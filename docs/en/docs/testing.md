---
title: Testing
description: Orchid screen testing
---

Nowadays, the development of high-quality software is intertwined with automated testing. Therefore, the package contains testing tools to help you make it easy.

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

In many cases, routes take parameters, for example `users/{user}/edit`, in order to transfer them, you can use the method:

```php
$screen = $this->screen('platform.systems.users.edit')
    ->parameters([
        'user' => 1,
    ]);
```

Most likely, your routes are closed from guests and are available only for users. You need to call the `actingAs` method passing the user to log in.

```php
// Create a single App\Models\User instance...
$user = User::factory()->create();

$screen = $this->screen('platform.example')->actingAs($user);
```


