---
title: Notifications
description: The Laravel Orchid Notifications documentation page is the ultimate resource for learning how to use the Orchid Notifications system to send real-time notifications to your users. Discover how to easily create and manage notification channels, customize notification templates, and send notifications through a variety of methods. Whether you're a beginner or an advanced developer, this page has everything you need to get started with Orchid Notifications.
---

**Notifications** are a powerful tool that allows you to keep your users informed and engaged with your app. They can be used to alert users of important events, such as the completion of a long process or the arrival of a new message. In this guide, we will show you how to use notifications in your app using Laravel Orchid.

> Please take a moment to [review our recommendations for providing feedback](https://orchid.software/en/hig/providing-feedback) to ensure that your application looks exceptional.

## Flash Messages

A flash notification is a one-time message that is automatically deleted after the user views it. 
Designed to inform the user of a recent event—such as the successful saving of data—flash notifications provide quick, concise feedback without cluttering the interface. 
If you need to retain notification data, consider using persistent notifications instead.

### Alert Messages

To create a flash notification, you can use the following code:

```php
use Orchid\Support\Facades\Alert;

Alert::message('Welcome Aboard!');
```

You can also use a shorter version of this code:

```php
alert('Your action has been completed.');
```

In addition to displaying a message, Laravel Orchid also allows you to visually indicate the type of notification using different colors. You can do this using the following methods:

```php
Alert::info('Welcome to our website!');
Alert::success('Your message has been sent.');
Alert::error('Please fill in all required fields.');
Alert::warning('Your account will be permanently deleted.');
```

If you want to prevent the automatic escaping of data in your alerts, you can use the `withoutEscaping` method. By default, data passed to the alert is escaped to prevent XSS attacks. Calling this method will disable that behavior:

```php
use Orchid\Support\Facades\Alert;

Alert::info('This is <strong>bold</strong> text.')
    ->withoutEscaping();
```

This will render the HTML content in the message without escaping it.

If you want to use a custom template for your notifications, you can use the `view` method. This method takes three arguments: the path/name of the `Blade` template, the color of the notification, and an array of variables to be passed to the template:

```php
use Orchid\Support\Facades\Alert;
use Orchid\Support\Color;

Alert::view('alert', Color::INFO(), [
    'name' => 'Alexandr'
]);
```

The `Blade` template would look like this:

```php
// resources/views/alert.blade.php

Hello <strong>{{ $name }}</strong>
```

### Toast Messages

Toast messages are small pop-up notifications that appear in the upper right corner of the screen. They are designed to briefly notify the user of the result of an action or event, such as the successful completion of a task. Toast messages are similar to flash notifications, but have a different appearance and a few additional features.

To create a toast message, you can use the following code:

```php
use Orchid\Support\Facades\Toast;

Toast::warning('Invalid input. Please check your form.');
```

One of the additional features of toast messages is the ability to specify whether the message should automatically hide after a certain period of time. By default, toast messages will automatically hide after a few seconds, but you can disable this behavior by using the `persistent` method:

```php
Toast::warning('Invalid input. Please check your form.')
    ->persistent();
```

To re-enable auto-hide, simply call the `autoHide` method again.

You can also specify the delay in milliseconds before hiding the toast message by using the `delay` method. This method takes one argument, which is the number of milliseconds to wait before hiding the message:

```php
Toast::warning('Invalid input. Please check your form.')
    ->delay(2000);
```

The `seconds` method allows you to set the delay before hiding the toast message, but in seconds instead of milliseconds. 
This makes it easier to configure the delay in a more human-readable format:

```php
Toast::info('Your data has been saved!')
    ->seconds(5);  // 5 seconds delay
```

If you want to prevent the automatic escaping of data in your toasts, you can use the `withoutEscaping` method. By default, data passed to the toast is escaped to prevent XSS attacks. Calling this method will disable that behavior:

```php
use Orchid\Support\Facades\Toast;

Toast::info('This is <strong>bold</strong> text.')
    ->withoutEscaping();
```

This will render the HTML content in the message without escaping it.

## Persistent Notification

Persistent notification are different from flash messages, they are not deleted after being viewed and can be sent to users even when they are offline. 
They are an excellent way to inform, for example, for a task manager application to notify an employee about a new task.

You can view these notifications by clicking the "Notification Bell icon" in the application navigation bar. If there are unread notifications, a counter will be displayed.


Before using this feature, it's important to check out the [Laravel notification documentation](https://laravel.com/docs/notifications) as it provides more details and examples on how to use this feature.


To send a notification, you can simply pass a `DashboardMessage` instance to a user’s `notify` method.  
Before proceeding, ensure that your user model implements the `Notifiable` trait:

```php
use Orchid\Platform\Notifications\DashboardMessage;
use Orchid\Support\Color;

$user->notify(DashboardMessage::make()
    ->title('New Task: January Report')
    ->message('Please review the task details and deadline.')
    ->action('https://example.com/reports/january')
    ->type(Color::INFO)
);
```

You can also create a custom notification class using the following Artisan command:

```php
php artisan make:notification TaskCompleted
```


This command will create a new class in your `app/Notifications` directory.

To send the notification, you must add the `DashboardChannel` to the `via` notification method:


```php
use Orchid\Platform\Notifications\DashboardChannel;

public function via($notifiable)
{
    return [
        DashboardChannel::class
    ];
}
```

Before sending the notification, you must also define a `toDashboard` method in the notification class. 
This method will receive a `$notifiable` object and must return a `DashboardMessage` object:

```php
use Orchid\Platform\Notifications\DashboardMessage;

public function toDashboard($notifiable)
{
    return (new DashboardMessage)
        ->title('New Task: January Report')
        ->message('Please review the task details and deadline.')
        ->action(url('/'));
}
```


Notifications can be sent in two ways: by using the `notify` method in the `Notifiable` trait or by using the `Notification` facade.
You can take a look at [Laravel Notification Documentation](https://laravel.com/docs/notifications#sending-notifications) to learn more about these two approaches to sending notifications.

Here is an example of how to send notifications to a user using the 'notify' method:

```php
$user = User::find(1);

$user->notify(new TaskCompleted);
```
