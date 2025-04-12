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

    return response()->json($attachment);
}
```

Это автоматически загрузит ваш файл в хранилище по умолчанию (`public`) и создаст запись в базе данных.


```php
$image = $item->attachment()->first();

//Получить URL адрес файла
$image->url();
```

> **Примечание.** Метод `url()` сначала проверит наличие пути, а затем получит URL-адрес. При использовании внешнего хранилища, такого как `s3`, будет выполнено два вызова. Для повышения производительности вы можете использовать [caching adapter](https://laravel.com/docs/filesystem#driver-prerequisites), рекомендованный `Laravel` для повышения производительности. Вы также можете просто переопределить этот метод и настроить его под свои нужды.


## Загрузка файла через консоль

Иногда нужные файлы уже есть на сервере, тогда для загрузки в нужное хранилище можно использовать следующее:

```php
use Illuminate\Http\UploadedFile;
use Orchid\Attachment\File;

$file = new UploadedFile($path, $originalName);

$attachment = (new File($file))->load();
```

## Повторная загрузка

Благодаря хешу, вложения не загружаются повторно. Вместо этого создаётся ссылка в базе данных на необходимый физический файл,
позволяя эффективно использовать ресурсы. Файл будет удалён только тогда, когда все ссылки будут уничтожены.

## Удаление вложений

При удалении модели ее вложения не удаляются автоматически. В случае если вложение не должно существовать без модели, его нужно удалить непосредственно перед удалением модели. Если удалить запись о вложении в таблице `attachments`, файл не будет удален. Очищать вложения нужно через функцию `delete()` модели `Attachment`. В этом случае произойдет проверка на существование других ссылок на файл и если их нет, то файл удалится. Это легко можно сделать используя [отношения](https://laravel.com/docs/master/eloquent-relationships) и [обсервер](https://laravel.com/docs/master/eloquent#observers).

Вернемся к примеру с `hero` из ["Управление вложенными файлами"](/ru/docs/quickstart-files)

```php
// app/Post.php

use Orchid\Attachment\Models\Attachment;

public function hero()
{
    return $this->hasOne(Attachment::class, 'id', 'hero')->withDefault();
}
```

При обращении к отношению как к функции `$post->hero()`, оно вернет экземпляр класса `Illuminate\Database\Eloquent\Builder` у которого тоже есть функция `delete()`, однако она выполняет sql запрос. При обращении к отношению как к свойству `$post->hero`, оно вернет экземпляр модели. В данном случае модели `Attachment`, которая нам и нужна.

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
    //load attachment as collection and not query attachment()
    $post->attachment()->each->delete();
}
```

> **Примечание.** Опытный Laravel разработчик  увидит, что здесь есть `N+1` проблема. Это сделано намеренно чтобы иметь доступ системе для удаления файла (база данных не сделает это за нас).


Подписываем модель на наш обсервер в `AppServiceProvider`

```php
public function boot()
{
    ...
    
    Post::observe(PostObserver::class);
}
```

## Конфигурация по умолчанию


По умолчанию каждый загружаемый файл следует стратегии, описанной в `config/platform.php`:

```php
/*
|--------------------------------------------------------------------------
| Default configuration for attachments.
|--------------------------------------------------------------------------
|
| Strategy properties for the file and storage used.
|
*/

'attachment' => [
    'disk'      => 'public',
    'generator' => \Orchid\Attachment\Engines\Generator::class,
],
```

- **disk** - имя хранилища, используемое для хранения файлов. Все настройки которого должны быть определены в `/config/filesystems.php`.

- **generator** - класс, который определяет, как будут называться загружаемые файлы и в каких каталогах они будут находиться, а также как избежать их дублирования.

## Подписка на событие загрузки

Orchid позволяет вам подписываться на события, которые срабатывают при загрузке файла. Эта функция позволяет выполнять дополнительные задачи, такие как сжатие видео, оптимизация изображений или другие операции по обработке файлов.

Для подписки на событие вы можете использовать [механизм прослушивания событий Laravel](https://laravel.com/docs/11.x/events#defining-listeners). В приведенном ниже примере анонимная функция регистрируется для прослушивания события `UploadFileEvent`:

```php
use Orchid\Platform\Events\UploadFileEvent;
use Illuminate\Support\Facades\Event;

/**
 * Bootstrap any application services.
 */
public function boot(): void
{
    Event::listen(function (UploadFileEvent $event) {
        // Ваша логика здесь для обработки события
        // $event->attachment
        // $event->time
    });
}
```

Когда событие `UploadFileEvent` срабатывает, вызывается анонимная функция, зарегистрированная с помощью `Event::listen`. Внутри этой функции вы можете определить свою логику для обработки события, такую как обработка загруженного файла, выполнение проверок или запуск дополнительных действий.
