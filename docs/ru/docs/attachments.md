---
title: Вложения
description: Вложения - это файлы, относящиеся к записи.
---

Файлы различных форматов и расширений относящиеся к записи являются вложениями.

Вложения могут быть прикреплены к любой модели посредством связей, для этого необходимо добавить трейт:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;

class Hostel extends Model
{
    use Attachable;
    //
}
```

После этого мы можем добавлять и получать её вложения, например:

```php
$item = Hostel::find(42);
$item->attachment()->get();
```


## Пример загрузки

В действительности вы уже имеете маршрут для загрузки файлов (если конечно, к нему разрешён доступ).

Пример метода контроллера:

```php
use Orchid\Attachment\File;

public function upload(Request $request)
{
    $file = new File($request->file('photo'));
    $attachment = $file->load();

    return response()->json()
}
```

Это автоматически загрузит ваш файл в хранилище по умолчанию (`public`) и создаст запись в базе данных.


```php
$image = $item->attachment()->first();

//Получить URL адрес файла
$image->url();
```


## Повторная загрузка

Благодаря хешу, вложения не загружаются повторно, вместо этого создаётся ссылка в базе данных на необходимый физический файл,
позволяя эффективно использовать ресурсы. Файл будет удалён только тогда, когда все ссылки будут уничтожены.

## Удаление вложений

При удалении модели ее вложения не удаляются автоматически. В случае если вложение не должно существовать без модели, то его нужно удалить непосредственно перед удалением модели. Если удалить запись о вложении в таблице `attachments`, файл не будет удален. Очищать вложения нужно через функцию `delete()` модели `Attachment`. В этом случае произойдет проверка на существование других ссылок на файл и если их нет, то файл удалится. Это легко можно сделать используя [отношения](https://laravel.com/docs/master/eloquent-relationships) и [обсервер](https://laravel.com/docs/master/eloquent#observers).

Вернемся к примеру с `hero` из ["Управление вложенными файлами"](/ru/docs/quickstart-files)

```php
// app/Post.php

use Orchid\Attachment\Models\Attachment;

public function hero()
{
    return $this->hasOne(Attachment::class, 'id', 'hero')->withDefault();
}
```

При обращении к отношению как к функции `$post->hero()` оно вернет экземпляр класса `Illuminate\Database\Eloquent\Builder` у которого тоже есть функция `delete()`, однако она выполняет sql запрос. При обращении к отношению как к свойству `$post->hero` оно вернет экземпляр модели. В данном случае модели `Attachment`, которая нам и нужна.

```php
$post->hero()->delete();
```

> **Примечание.** Отношение важно описать используя функцию `withDefault()`, чтобы избежать null pointer exception.

Удалять нужно во время события `deleting` модели. Для этого создадим [обсервер](https://laravel.com/docs/master/eloquent#observers) нашей модели.

```bash
php artisan make:observer PostObserver
```

В PostObserver создаем функцию `deleting`

```php
public function deleting(Post $post)
{
    $post->hero()->delete();
}
```

В случае, когда у нас вложений много, мы используем отношение `attachment` из трейта `Attachable`

```php
public function deleting(Post $post)
{
    $post->attachment()->delete();
}
```

Подписываем модель на наш обсервер в `AppServiceProvider`

```php
public function boot()
{
    ...
    
    Post::observe(PostObserver::class);
}
```

## Подписка на событие загрузки

Различные варианты обработки файлов могут потребовать дополнительной обработки, например, сжатие видео,
это возможно благодаря событию, на которое можно подписаться стандартными средствами и выполнить задачу в фоне:

```php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listener\UploadListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UploadFileEvent::class => [
             UploadListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
```

Каждая подписка получит объект `UploadFileEvent`:

```php
namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Orchid\Platform\Events\UploadFileEvent;

class UploadListener extends ShouldQueue
{
    use InteractsWithQueue;
    
    /**
     * Handle the event.
     *
     * @param  UploadFileEvent  $event
     * @return void
     */
    public function handle(UploadFileEvent $event)
    {
        //$event->attachment
        //$event->time
    }
}
``` 
