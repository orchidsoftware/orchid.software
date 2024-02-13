---
title: Attachments
description: Learn how to use Laravel Orchid's Attachments feature to manage and attach files to your application's database. Improve your app's user experience and organization with this powerful tool.
---

## Attachments


Attachments are files of various formats and extensions that are related to a specific record. They can be attached to any model in your application by adding the `Attachable` trait to the model and using the `attachment()` relationship.

For example, to attach files to a `Hostel` model:


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

To retrieve the attachments for a particular hostel, you can use the `attachment()` relationship:

```php
$item = Hostel::find(42);
$item->attachment()->get();
```


## Uploading a File via HTTP

To upload a file via HTTP, you can use the `File` class and the `load()` method. Here's an example of a controller method that handles file uploads:


```php
use Orchid\Attachment\File;

public function upload(Request $request)
{
    $file = new File($request->file('photo'));
    $attachment = $file->load();

    return response()->json($attachment);
}
```

This will automatically upload the file to the default repository (usually `public`) and create an entry in the database.

To retrieve the URL of an attachment, you can use the `url()` method:

```php
$image = $item->attachment()->first();

// Get the URL of the file
$image->url();
```

> **Note.** The `url()` method will first check for the path existence, and then get the URL. When using external storage like `s3`, this will make two calls. To improve performance you can use the [caching adapter](https://laravel.com/docs/filesystem#driver-prerequisites) recommended by `Laravel` to improve performance. You can also simply override this method and adjust to your needs.


## Uploading a File via the Console

Sometimes the necessary files are already on the server, and you can use the following code to upload them to the desired storage:

```php
use Illuminate\Http\UploadedFile;
use Orchid\Attachment\File;

$file = new UploadedFile($path, $originalName);

$attachment = (new File($file))->load();
```

## Duplicate Uploaded Files

To prevent unnecessary duplication and save resources, Laravel Orchid uses a hashing algorithm to check for existing files before uploading a new attachment. If a file with the same hash already exists in storage, a link to the existing file is created in the database instead of uploading a duplicate copy. This allows for efficient storage and management of attachments.

The file will only be deleted from storage when all links to it are destroyed. This means that if multiple records are associated with the same attachment, the file will not be deleted until all records are deleted or the attachment is removed from all of them.

This feature not only improves the performance and reduces the storage space, but also eliminates the chance of having multiple copies of the same file in the storage.


### Allowing Duplicate Files


While the hashing algorithm in Laravel Orchid is designed to prevent the duplication of files, in some cases, you may want to keep duplicate files and generate different links to request different physical files. To do this, you can use the `allowDuplicates()` method.

```php
use Orchid\Attachment\File;

public function upload(Request $request)
{
    $file = new File($request->file('photo'));
    $attachment = $file->allowDuplicates()->load();

    return response()->json()
}   
```

Keep in mind that allowing duplicate files may increase storage usage and affect your application's performance. Therefore, it should be used with caution and only when necessary.

## Customizing the Upload Path


By default, Laravel Orchid uses a default upload path for all files of `Y/m/d`, for example: `2022/06/11`. This path is used to organize and structure the uploaded files in the storage. However, you may want to customize the path to suit your specific needs.

You can change the default path by using the `path(string $path)` method:

```php
use Orchid\Attachment\File;

public function upload(Request $request)
{
    $path = "photos"
    $file = new File($request->file('photo'));
    $attachment = $file->path($path)->load();

    return response()->json()
}
```

In this example, the `path()` method is used to set the path to `photos` before loading the file. This will change the default path and all files will be uploaded to the `photos` folder.

You can also use dynamic parameters like `path('photos/'.$user->id)` or `path('photos/'.$file->name)` to create specific folders for each user or file type.


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

> **Note.** An experienced Laravel developer will see that there is an `N+1` problem here. It is intentionally done to access the filesystem to delete a file (The database won't do it for us). 


Subscribe example model to the observer in `AppServiceProvider`

```php
public function boot()
{
    ...
    
    Post::observe(PostObserver::class);
}
```



Occasionally, users may upload image files without properly establishing a relationship with them. These models and files may end up remaining in the system indefinitely, taking up valuable storage space. To address this issue, you can create a console command that clears out any unassociated image files on a set schedule. For example, you might schedule the command to run once a week or once a month, depending on the frequency of uploads and the amount of storage space available.

```php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Orchid\Attachment\Models\Attachment;

class AttachmentClear extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'attachment:clear';

    /**
     * The console command description.
     */
    protected $description = 'Remove dont relation attachment';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $unrelatedAttachments = Attachment::doesntHave('relationships')
            ->whereDate('created_at', '<', now()->subDays(2))
            ->get();

        $unrelatedAttachments->each->delete();

        return Command::SUCCESS;
    }
}
```


## Default Configuration

When you upload files using Laravel Orchid, the package uses a default configuration that is defined in the `config/platform.php` file. This configuration specifies the disk and generator that will be used to handle the files.


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

- **disk** -  The name of the storage disk that will be used to store the files. The disk should be defined in the `/config/filesystems.php` file.

- **generator** - The generator class that defines how the files will be named, where they will be located in the storage, and how to avoid duplicating them. By default, Orchid uses the `\Orchid\Attachment\Engines\Generator` class, which uses a hash of the file's contents to avoid duplicating files.

You can modify these settings to suit your needs, for example, you can change the disk and generator to customize the way files are handled and stored.

## Optimizing Images

Optimizing images can be an important step in improving the performance and user experience of your application. However, it is important to be mindful of how and when images are optimized. Modifying the original images can lead to a loss of quality, especially if the images are modified multiple times with different resolutions or quality settings.

One way to optimize images on demand is to use a third-party package such as [https://github.com/Intervention/imagecache](https://github.com/Intervention/imagecache) or its alternatives. This approach allows you to optimize images only when necessary and keep the original images in their original quality, which can be useful in situations where the image requirements change over time or if you want to keep the original image for other purposes.


## Event Subscription


Laravel Orchid allows you to subscribe to events that are triggered when a file is uploaded. This allows you to perform additional tasks such as video compression, image optimization, or other types of file processing.

To subscribe to an event, you can use the standard event subscription tools provided by Laravel. In the example below, a listener class `UploadListener` is registered to listen for the `UploadFileEvent`:

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

When the `UploadFileEvent` is triggered, the `handle` method of the `UploadListener` class will be called. The method will receive an object of the `UploadFileEvent` class, which contains information about the attachment and the time of the upload.

```php
namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Orchid\Platform\Events\UploadFileEvent;

class UploadListener implements ShouldQueue
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
