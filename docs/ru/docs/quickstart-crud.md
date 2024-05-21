---
title: Управление данными
description: Laravel CRUD
---

Это руководство представляет минимальный набор для создания и редактирования моделей с помощью платформы. В текущем примере мы создадим страницы администрирования для блога.

> **Примечание.** Этот пример является важной частью учебного пособия, но если вашему приложению требуется простой CRUD, рассмотрите возможность использования для этого [специального пакета](https://github.com/orchidsoftware/crud).

На этом этапе желательно, чтобы вы уже познакомились с основами концепции [экранов](https://orchid.software/ru/docs/screens) и просмотрели "[Быстрый старт для начинающих](https://orchid.software/ru/docs/quickstart)".

Для начала нам необходимо создать новую таблицу. Для этого выполним команду:

```php
php artisan make:migration create_posts_table
```

В директории `database/migrations` будет создан новый файл миграции, добавим в него описание требуемых колонок.

```php
// `****_**_**_create_posts_table.php

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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
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

Для применения новой схемы к подключенной базе данных выполним:

```php
php artisan migrate
```

После успешного создания таблицы, добавим новую `Eloquent` модель, для этого выполним:

```php
php artisan make:model Post
```

В директории `app` будет создан новый файл `Post.php`, опишем поля как доступные для заполнения:

```php
// app/Post.php

namespace App;

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

> **Примечание.** Модель имеет трейт `AsSource`, для удобного обращения через dot нотацию.

Теперь мы готовы к настоящему использованию платформы.

[В предыдущем пособии](https://orchid.software/ru/docs/quickstart) мы уже создавали наш первый экран для отображения постов, но теперь нам необходимо как отображать записи, так и редактировать их. Поэтому добавим два новых экрана на каждое действие, поочередно выполнив команды:

```php
php artisan orchid:screen PostEditScreen
php artisan orchid:screen PostListScreen
```

> **Примечание.** Создание двух и более экранов для обеспечения CRUD не обязательно, но используется для удобства.

Зарегистрируем новые экраны в маршрутном листе приложения:

```php
// routes/platform.php

use App\Orchid\Screens\PostEditScreen;
use App\Orchid\Screens\PostListScreen;

Route::screen('post/{post?}', PostEditScreen::class)
    ->name('platform.post.edit');

Route::screen('posts', PostListScreen::class)
    ->name('platform.post.list');
```

Теперь экраны доступны для просмотра по адресу `/admin/post` и `/admin/posts`.
Полученные экраны на текущий момент не имеют, ни данных, ни действий. Отредактируем `PostEditScreen` для просмотра, добавив название, описание и требуемые поля:

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
     * @var Post
     */
    public $post;

    /**
     * Query data.
     *
     * @param Post $post
     *
     * @return array
     */
    public function query(Post $post): array
    {
        return [
            'post' => $post
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->post->exists ? 'Edit post' : 'Creating a new post';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Blog posts";
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
                ->canSee(!$this->post->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->post->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->post->exists),
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

        Alert::info('You have successfully created a post.');

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

Теперь мы можем создавать, редактировать и удалять записи. Но не просматривать в виде списка, изменим это!

Во всех предыдущих определениях слоёв использовалась только короткая запись вида `Layout:rows()`, но для отображения сложной или объемной информации желательно создавать отдельные классы.

Добавим новый класс `Layout`, выполнив команду:

```php
php artisan orchid:table PostListLayout
```

Укажем какие данные мы ходим видеть:

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

Свойство `target` указывает ключ, который будет источником для нашей таблицы на экране.

> **Примечание.** Формирование `HTML` непосредственно в классе необходимо только для примера и является плохой практикой. Пожалуйста, используйте `Blade` шаблоны.

Определив слой таблицы, вернемся к экрану просмотра, изменим его:

```php
namespace App\Orchid\Screens;

use App\Orchid\Layouts\PostListLayout;
use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PostListScreen extends Screen
{
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
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Blog post';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All blog posts";
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

Теперь наш набор для управления (создание, просмотр, редактирование и удаление записи) блогом готов. Не забудьте позаботиться об удобстве навигации из предыдущего материала, добавив пункты меню и хлебные крошки.


