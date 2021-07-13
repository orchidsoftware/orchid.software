---
title: Attachments
description: Attachments are files related to the record.
extends: _layouts.documentation
section: main
---

Files of various formats and extensions related to the recording are attachments. Them can be attached to any model via links. For this, you need to add a trait:

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

After that we can add and receive its attachments, for example:

```php
$item = Hostel::find(42);
$item->attachment()->get();
```


## Upload example

You already have a route for downloading files (unless, of course, access to it is allowed)

An example of a controller method:


```php
use Orchid\Attachment\File;

public function upload(Request $request)
{
    $file = new File($request->file('photo'));
    $attachment = $file->load();

    return response()->json()
}
```

It will automatically upload your file to the default repository (`public`) and create an entry in the database.

```php
$image = $item->attachment()->first();

// Get the URL of the file
$image->url();
```

> **Note.** The `url()` method will first check for the path existence, and then get the URL. When using external storage like `s3`, this will make two calls. To improve performance you can use the [caching adapter](https://laravel.com/docs/filesystem#driver-prerequisites) recommended by `Laravel` to improve performance. You can also simply override this method and adjust to your needs.

## Reload File

Thanks to the hash, attachments are not downloaded again; instead, a link is created in the database to the required physical file,
allowing efficient use of resources. The file will be deleted only when all links are destroyed.

## Remove

Attachments won't be removed after model removal automatically. In case when your attachments can't exist without a model, you should remove them on model `deleting` events manually. If you delete a row from the `attachments` table, the file won't be deleted. To clear your attachments, you need to use `delete()` function on the `Attachment` model. In that case, an additional check will proceed. If there no link to the file - it will be deleted. You can do it using [relationships](https://laravel.com/docs/master/eloquent-relationships) and [observers](https://laravel.com/docs/master/eloquent#observers).

Let's come back to our example with `hero` relation from ["Manage file attachments"](/en/docs/quickstart-files)

```php
// app/Post.php

use Orchid\Attachment\Models\Attachment;

public function hero()
{
    return $this->hasOne(Attachment::class, 'id', 'hero')->withDefault();
}
```

If you call your relation like function `$post->hero()` it will return `Illuminate\Database\Eloquent\Builder` class, that also has `delete()` function. But, it will execute sql query. If you call your relation like attribute `$post->hero` it will return model class. `Attachment` model class.

```php
$post->hero()->delete();
```

> **Note.** You should build your relation using `withDefault()` function to avoid the null pointer exception.

Let's generate [observer](https://laravel.com/docs/master/eloquent#observers) for our example model.

```bash
php artisan make:observer PostObserver
```

In PostObserver we create `deleting` function

```php
public function deleting(Post $post)
{
    $post->hero()->delete();
}
```

When you have multiple attachments, you should use `attachment` relation from the `Attachable` trait.

```php
public function deleting(Post $post)
{
    //load attachment as collection and not query attachment()
    $post->attachment->each->delete();
}
```

Subscribe example model to the observer in `AppServiceProvider`

```php
public function boot()
{
    ...
    
    Post::observe(PostObserver::class);
}
```

## Subscribe to download

Different file processing options may require additional processing, such as video compression,
This is possible thanks to an event that you can subscribe to using standard tools and perform a task in the background:

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

Each subscription will receive an object `UploadFileEvent`:

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
