---
title: Уведомления
description:  Простой способ уведомить пользователя о состоянии вашего приложения.
---

Уведомления - это отличный способ информировать ваших пользователей о том, что происходит в вашем приложении. Например, они могут оповещать пользователя о завершении длительного процесса или приходе нового сообщения. В этом разделе мы покажем вам, как использовать их в вашем приложении.

## Одноразовые сообщения

Flash-уведомление — это одноразовое сообщение, которое будет удалено при следующем обращении. 
Уведомления призваны информировать о непосредственно произошедшем событии, например сообщение о сохранении данных.

ORCHID имеет удобный вызов и отображение уведомлений поверх одноразовых flash-данных.


```php
use Orchid\Support\Facades\Alert;

Alert::message('Welcome Aboard!');
```

Можно использовать более короткую запись:

```php
alert('Message');
```

Сообщения могут визуально отображать статус с помощью цветовой гаммы, для этого предназначены методы:

```php
Alert::info('Message')
Alert::success('Message')
Alert::error('Message')
Alert::warning('Message')
```

Для вставки собственного шаблона с использованием переменных, тегов используется метод `view`:

```php
use Orchid\Support\Facades\Alert;
use Orchid\Support\Color;

Alert::view('alert', Color::INFO(), [
    'name' => 'Alexandr'
]);
```

Первый аргумент метода это путь/имя `Blade` шаблона:
```php
// resources/views/alert.blade.php

Hello <strong>{{ $name }}</strong>
```


При использовании, будет установлено несколько ключей в сессии:
- 'flash_notification.message' - Сообщение для отображения.
- 'flash_notification.level' - Строка, представляющая тип уведомления.

Отображение по умолчанию уже встроено в шаблон, но Вы можете вызывать его явно в `blade` шаблонах, для этого необходимо указать:

```php
@include('platform::partials.alert')
```


## Тост сообщения

Это маленькое всплывающее сообщение в правом верхнем углу экрана,
для краткого уведомления пользователя о результате. 
Оно полностью соответствует одноразовым сообщениям `Alert`, но имеет другой внешний вид и несколько дополнительных методов:

```php
use Orchid\Support\Facades\Toast;

Toast::warning('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
```

Вы можете указать необходимость автоматического скрытия и времени до этого:

```php
Toast::warning('Lorem ipsum dolor sit amet.')
    ->autoHide(false);

Toast::warning('Lorem ipsum dolor sit amet.')
    ->delay(2000);
```

## Уведомления в панели администрирования

Уведомления в панели администрирования отличаются от flash-сообщений тем, что не удаляются после просмотра и
могут быть добавлены любым пользователям, даже когда они находятся не в сети. Это ещё один отличный способ информирования,
например для  приложения "менеджер задач" -  уведомлять сотрудника о новой задаче.

Эти уведомления можно просмотреть, нажав на значок «Колокольчик уведомлений» на панели навигации приложения. При наличии непрочитанных уведомлений будет отображаться счетчик.

> **Примечание:** Перед использованием этой функции, прочитайте [Laravel notification documentation](https://laravel.com/docs/notifications).


Чтобы создать уведомление, Вы можете использовать следующую команду Artisan:

```php
php artisan make:notification TaskCompleted
```

Эта команда создаст новый класс в вашем каталоге `app/Notifications`. 
Необходимо добавить канал `DashboardChannel` в `via` методе уведомления:

```php
use Orchid\Platform\Notifications\DashboardChannel;

public function via($notifiable)
{
    return [DashboardChannel::class];
}
```

Перед использованием `DashboardChannel` необходимо определить метод `toDashboard` в классе уведомлений. 
Этот метод получит объект `$notifiable` и должен вернуть объект `DashboardMessage`:

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

Уведомления могут быть отправлены двумя способами: с помощью `notify` метода в трейте `Notifiable` или с помощью `Notification` фасада. Вы можете взглянуть на [документацию уведомлений Laravel](https://laravel.com/docs/notifications#sending-notifications), чтобы получить более подробную информацию об этих двух подходах к отправке уведомлений.

Вот пример отправки уведомлений пользователю с использованием `notify` метода:

```php
$user = User::find(1);

$user->notify(new TaskCompleted);
```
