---
title: Notifications
description:  A simple way to notify the user about the status of your application.
---

Notifications are a great way to let your users know what's going on in your app. For example, they can alert the user when a long process is complete or a new message arrives. In this section, we'll show you how to use them in your app.

## Flash messages

Flash notification is a one-time message that will be deleted upon the next access.
Notifications are designed to inform about the event that occurred directly, for example, a message about saving data.

ORCHID has a convenient call and display notifications over one-time flash-data.

```php
use Orchid\Support\Facades\Alert;

Alert::message('Welcome Aboard!');
```

or use a shorter entry:

```php
alert('Message');
```

Messages can visually display the status using the color gamut, for this purpose are the methods:

```php
Alert::info('Message')
Alert::success('Message')
Alert::error('Message')
Alert::warning('Message')
```

To insert your own template using variables tags use the `view` method:

```php
use Orchid\Support\Facades\Alert;
use Orchid\Support\Color;

Alert::view('alert', Color::INFO(), [
    'name' => 'Alexandr'
]);
```

The first argument of the method is the path/name of the `Blade` template:

```php
// resources/views/alert.blade.php

Hello <strong>{{ $name }}</strong>
```


When used, several keys will be set per session:
- 'flash_notification.message' - Message to display
- 'flash_notification.level' - A string representing the type of notification


The default display is already built into the template. Still, you can call it explicitly in the `blade` templates for this, you must specify:

```php
@include('platform::partials.alert')
```

## Toast messages

It is a small pop-up message in the upper right corner of the screen,
to briefly notify the user of the result.
It is entirely consistent with the one-time `Alert` messages, but has a different appearance and several additional methods:

```php
use Orchid\Support\Facades\Toast;

Toast::warning('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
```

You can specify the need for automatic hiding and time before

```php
Toast::warning('Lorem ipsum dolor sit amet.')
    ->autoHide(false);

Toast::warning('Lorem ipsum dolor sit amet.')
    ->delay(2000);
```


## Notifications in the admin panel

The notification in the administration panel differs from flash-messages. They are not deleted after viewing and
can be added to any users even when they are offline. It is another excellent way to inform, for example, for a task manager application to notify an employee about a new task.

You can view these notifications by clicking the "Notification Bell icon" in the application navigation bar. If there are unread notifications, a counter will be displayed.

> **Note:** Before using this feature, check out the [Laravel notification documentation](https://laravel.com/docs/notifications).


To create a notification, you can use the following Artisan command:

```php
php artisan make:notification TaskCompleted
```

This command will create a new class in your `app/Notifications` directory.
You must add channel `DashboardChannel` to the `via` notification method:

```php
use Orchid\Platform\Notifications\DashboardChannel;

public function via($notifiable)
{
    return [DashboardChannel::class];
}
```

Before using `DashboardChannel`, you must define a `toDashboard` method in the notification class.
This method will receive a `$notifiable` object and must return a `DashboardMessage` object:


```php
use Orchid\Platform\Notifications\DashboardMessage;

public function toDashboard($notifiable)
{
    return (new DashboardMessage)
        ->title('Hello Word')
        ->message('New post!')
        ->action(url('/'));
}
```

Notifications can be sent in two ways: by using the `notify` method in the `Notifiable` trait or by using the `Notification` facade. You can take a look at [Laravel Notification Documentation](https://laravel.com/docs/notifications#sending-notifications) to learn more about these two approaches to sending notifications.

Here is an example of how to send notifications to a user using the 'notify' method:

```php
$user = User::find(1);

$user->notify(new TaskCompleted);
```
