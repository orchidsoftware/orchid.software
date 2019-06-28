---
title: Notifications
description:  A simple way to notify the user about the status of your application.
extends: _layouts.documentation.en
section: main
---

A simple way to notify the user about the status of your application. For example, they can inform the user about the completion of a lengthy process or the arrival of a new message. In this section, we will show you how to make them work in your application.

## Flash messages:

Flash notification is a one-time message that will be deleted upon next access.
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
Alert::view('alert', Alert::info, [
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

The default mapping is already built into the template, but you can explicitly call it in the `blade` template with
To display in the required place is required:

```html
@include('platform::partials.alert')
```

## Notifications in the admin panel

The notification in the administration panel differs from flash-messages in that they are not deleted after viewing and
can be added to any users even when they are offline. This is another great way to inform
for example, for a task manager application to notify an employee about a new task.

To create a notification is required:
```php
$user = User::find(1);

$user->notify(new \Orchid\Platform\Notifications\DashboardNotification([
    'title'   => 'Hello Word',
    'message' => 'New post!',
    'action'  => 'http://orchid.software/',
    'type'    =>  DashboardNotification::INFO,
]));
```

Supported Types:

- DashboardNotification::INFO (Default)
- DashboardNotification::SUCCESS
- DashboardNotification::WARNING
- DashboardNotification::ERROR
