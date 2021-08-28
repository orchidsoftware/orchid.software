---
title: Data management
description: Laravel CRUD
extends: _layouts.documentation
section: main
---


This guide provides a minimal set for creating and editing models using the platform. In the current example, we will create admin pages for the blog.

> **Note.** This tutorial is an important part of the tutorial, but if your application needs a simple CRUD, consider [using a dedicated package for this](https://github.com/orchidsoftware/crud).

At this stage, it is advisable that you already familiarize yourself with the basics of the concept of [screens](https://orchid.software/en/docs/screens) and watch "[Quick start for beginners](https://orchid.software/en/docs/quickstart) ".

First, we need to create a new table. To do this, execute the command:

```php
php artisan make:migration create_posts_table
```

A new migration file will be created in the `database/migrations` directory, we will add a description of the required columns to it.

```php
// `****_**_**_create_posts_table.php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->text('body');
            $table->bigInteger('author');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
```

To apply the new scheme to the connected database, we will do:

```php
php artisan migrate
```

After successfully creating the table, add a new `Eloquent` model, to do this:

```php
php artisan make:model Post
```

In the `app` directory, a new file `Post.php` will be created, we will describe the fields as available for filling:

```php
// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'body',
        'author'
    ];
}
```

> **Note.** The model has the `AsSource` trait, for convenient handling via dot notation.


Now we are ready for the real use of the platform.

[In the previous tutorial](https://orchid.software/en/docs/quickstart) we already created our first screen for sending email messages, but now we need to both display the records and edit them, so we’ll add two new screens for each action, alternately executing the commands:

```php
php artisan orchid:screen PostEditScreen
php artisan orchid:screen PostListScreen
```

> **Note:** Creating two or more screens to provide CRUD is optional, but is used for convenience.

Register new screens in the application route list:

```php
// routes/platform.php

use App\Orchid\Screens\PostEditScreen;
use App\Orchid\Screens\PostListScreen;

Route::screen('post/{post?}', PostEditScreen::class)
    ->name('platform.post.edit');
    
Route::screen('posts', PostListScreen::class)
    ->name('platform.post.list');
```

Now the screens are available for viewing at the address `/admin/post` and `/admin/posts`.
The resulting screens currently have no data, no actions, edit the `PostEditScreen` for viewing by adding the name, description and required fields:

```php
namespace App\Orchid\Screens;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class PostEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new post';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Blog posts';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Post $post
     *
     * @return array
     */
    public function query(Post $post): array
    {
        $this->exists = $post->exists;

        if($this->exists){
            $this->name = 'Edit post';
        }

        return [
            'post' => $post
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create post')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('post.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('post.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Relation::make('post.author')
                    ->title('Author')
                    ->fromModel(User::class, 'name'),

                Quill::make('post.body')
                    ->title('Main text'),

            ])
        ];
    }

    /**
     * @param Post    $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Post $post, Request $request)
    {
        $post->fill($request->get('post'))->save();

        Alert::info('You have successfully created an post.');

        return redirect()->route('platform.post.list');
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Post $post)
    {
        $post->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.post.list');
    }
}
```


Now we can create, edit, and delete records. But do not browse as a list. Change it!

In all previous layer definitions, only a short record of the form `Layout:rows()` was used, but to display complex or voluminous information, it is desirable to create separate classes.

Add a new `Layout` class by running the command:

```php
php artisan orchid:table PostListLayout
```

We indicate what data we want to see:

```php
namespace App\Orchid\Layouts;

use App\Models\Post;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class PostListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'posts';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('title', 'Title')
                ->render(function (Post $post) {
                    return Link::make($post->title)
                        ->route('platform.post.edit', $post);
                }),

            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
```

The `target` property indicates the key will be the source for our table on the screen.

> **Note.** Generating `HTML` directly in the class is an example only and is bad practice. Please use the `Blade` templates.

Having defined the table layer, we return to the view screen, change it:

```php
namespace App\Orchid\Screens;

use App\Orchid\Layouts\PostListLayout;
use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PostListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Blog post';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All blog posts';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'posts' => Post::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.post.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            PostListLayout::class
        ];
    }
}
```

Now we are a set for managing (creating, viewing, editing, and deleting entries) a blog, do not forget to take care of the convenience of navigation from the previous material by adding menu items and breadcrumbs.
