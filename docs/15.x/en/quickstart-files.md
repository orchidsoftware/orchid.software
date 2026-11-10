---
title: Manage File Attachments
description: Laravel File Manager
---

This guide is a continuation of the tutorial ["Data Management"](/en/docs/quickstart-crud), in which we will analyze the
work with ["Attached files"](/en/docs/attachments).

Let's go back to the previously created `Post` model and add a new column `hero`, in which we will store information
about the main image in our blog post:

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('hero')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('hero');
        });
    }
};
```

Add to the model for automatic recording:

```php
// app/Models/Post.php

protected $fillable = [
    'title',
    'description',
    'body',
    'author',
    'hero',
];
// ..
```

To write data to a new column, you need to add a suitable field to our create/edit screen, take `Cropper` to crop the
image:

```php
use Orchid\Screen\Layouts\Rows;

// app/Orchid/Screens/PostEditScreen.php

public function layout(): array
{
    return [
        Rows::make([
            Input::make('post.title')
                ->title('Title')
                ->placeholder('Attractive but mysterious title'),

            Cropper::make('post.hero')
                ->title('Large web banner image, generally in the front and center')
                ->width(1000)
                ->height(500),

            TextArea::make('post.description')
                ->title('Description')
                ->rows(3)
                ->maxlength(200)
                ->placeholder('Brief description for preview'),

            Select::make('post.author')->lazy()
                ->title('Author')
                ->fromModel(User::class, 'name'),

            Quill::make('post.body')
                ->title('Main text'),

        ]),
    ];
}
```

> **Note.** If during the file upload, you did not see your image in the end result, please check the
> `upload_max_filesize` and `post_max_size settings`, you may need to increase these values.

For such a field, the width and height were additionally indicated to ensure the proportions are displayed to the user.
After saving the record with the image, the full `url` address to the image will be written to the database column, for
example:

```text
http://localhost:8000/storage/2019/08/02/0f92ef693c26f3c1dbe2e3792abac9254ee98310.png
```

> **Note.** The link to the image is formed from the `url` address specified in your configuration file, that for local
> development through the built-in web server, a port indication is required.

This is the easiest entry, but what if you decide to use `https` or change the domain? To do this, it is better to use a
relative notation:

```php
Cropper::make('post.hero')
    ->targetRelativeUrl(),
```

Another option for writing is to use [relationships](https://laravel.com/docs/master/eloquent-relationships), for this
the `Cropper` field will record the number of the downloaded file:

```php
Cropper::make('post.hero')
    ->targetId(),
```

> **Note.** In order for your database to be homogeneous, use one of the proposed options.

Let us dwell on the records of the number, but first, delete all existing records.

Most often, some files are combined, for example, for display in whole groups, the `Attach` field is suitable for this.

```php
use Orchid\Screen\Layouts\Rows;

public function layout(): array
{
    return [
        Rows::make([
            Input::make('post.title')
                ->title('Title')
                ->placeholder('Attractive but mysterious title'),

            Cropper::make('post.hero')
                ->targetId()
                ->title('Large web banner image, generally in the front and center')
                ->width(1000)
                ->height(500),

            TextArea::make('post.description')
                ->title('Description')
                ->rows(3)
                ->maxlength(200)
                ->placeholder('Brief description for preview'),

            Select::make('post.author')->lazy()
                ->title('Author')
                ->fromModel(User::class, 'name'),

            Quill::make('post.body')
                ->title('Main text'),

            Attach::make('post.attachments')
                ->title('All files'),

        ]),
    ];
}
```

The field will differ from the previous ones because the data does not apply explicitly to the `Post` model, but will be
loaded and saved due to the connection, for this we must indicate the `Attachable` trait:

```php
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource, Attachable;
    // ...
}
```

But also describe the synchronization of dependent records by relations in our screen:

```php
public function createOrUpdate(Request $request)
{
    $this->post->fill($request->input('post'))->save();

    $this->post->attachments()->syncWithoutDetaching(
        $request->input('post.attachments', [])
    );

    Alert::info('You have successfully created a post.');

    return redirect()->route('orchid.post.list');
}
```

After saving, the connection with our record will be established in the table `attachmentable`:

```text
attachmentable_type  attachmentable_id  attachment_id
App\Models\Post      3                  5b3fcd1d-3d6b-4a74-bad4-2e17ef5d8814
App\Models\Post      3                  74b79d2b-972c-4cb3-a9ba-1d09fb8369e0
```

But when the record is accessed again, the field will be empty. This happens because `query` does not know about the
additional records on our model. We will fix this by adding a download:

```php
public function query(Post $post): array
{
    $post->load('attachments');

    return [
        'post' => $post,
    ];
}
```

Now our attached files are downloaded and synchronized. For more details, see the [Form Elements](/en/docs/field) and
[Attached Files](/en/docs/attachments) sections.
