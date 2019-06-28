---
title: Attachments
description: Attachments are files related to the record.
extends: _layouts.documentation.en
section: main
---
Files of various formats and extensions related to the recording are attachments

Attachments can be attached to any model via links, for this you need to add a trait:

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

In fact, you already have a route for downloading files (unless, of course, access to it is allowed)

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

This will automatically upload your file to the default repository (`public`) and create an entry in the database.

```php
$image = $item->attachment()->first();

// Get the URL of the file
$image->url();
```


## Reload

Thanks to the hash, attachments are not downloaded again, instead a link is created in the database to the required physical file,
allowing efficient use of resources. The file will be deleted only when all links are destroyed.


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
