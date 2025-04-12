---
title: Управление вложенными файлами
description: Laravel File Manager
---

Это руководство продолжение учебника ["Управление данными"](/ru/docs/quickstart-crud),
в котором мы будем разбирать работу с ["Вложенными файлами"](/ru/docs/attachments).

Вернемся к ранее созданной модели `Post` и добавим новую колонку `hero`,
в которой будем хранить информацию о главном изображении в нашей записи блога:

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
}
```

Добавим в модель для автоматической записи:

```php
// app/Models/Post.php

protected $fillable = [
    'title',
    'description',
    'body',
    'author',
    'hero'
];
//..
```

Для записи данных в новую колонку, необходимо добавить подходящее поле в наш экран создания/редактирования.
Используем `Cropper`, чтобы обрезать изображение:

```php
// app/Orchid/Screens/PostEditScreen.php

public function layout(): array
{
    return [
        Layout::rows([
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

            Relation::make('post.author')
                ->title('Author')
                ->fromModel(User::class, 'name'),

            Quill::make('post.body')
                ->title('Main text'),

        ])
    ];
}
```

> **Примечание.** Если в ходе загрузки файла, вы не увидели свое изображение в конечном результате,
пожалуйста проверьте настройки `upload_max_filesize` и `post_max_size`, возможно требуется увеличить эти значения.

Для такого поля были дополнительно указаны ширина и высота, чтобы быть уверенным, что пропорции отображаются пользователю.
После сохранения записи с изображением, в колонку базы данных будет записан полный `url` адрес до изображения, например:

```php
http://localhost:8000/storage/2019/08/02/0f92ef...e98310.png
```

> **Примечание.** Ссылка на изображение формируется из `url` адреса указанного в вашем файле конфигурации,
при локальной разработке через встроенный веб-сервер требуется указание порта.

Это самая простая запись, но что, если вы решите использовать `https` или сменить домен?
Для этого лучше использовать относительную запись:

```php
Cropper::make('post.hero')
    ->targetRelativeUrl(),
```

Еще один вариант записи - использовать [отношения](https://laravel.com/docs/master/eloquent-relationships), для этого
поле `Cropper` будет записывать номер загруженного файла:

```php
Cropper::make('post.hero')
    ->targetId(),
```

> **Примечание.** Для того чтобы ваша база данных была однородна, используйте один из предложенных вариантов.

Остановимся на записи номера, но для начала удалите все уже существующие записи.

Чаще всего некоторые файлы объединяют, например, для показа целыми группами. Для этого подойдет поле `Upload`.

```php
public function layout(): array
{
    return [
        Layout::rows([
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

            Relation::make('post.author')
                ->title('Author')
                ->fromModel(User::class, 'name'),

            Quill::make('post.body')
                ->title('Main text'),

            Upload::make('post.attachments')
                ->title('All files')

        ])
    ];
}
```

Поле будет отличаться от предыдущих тем, что данные не относятся явно к модели `Post`, а будут загружаться и сохраняться благодаря связи.
Для этого мы должны указать трейт `Attachable`:

```php
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource, Attachable;
    //...
}
```

Так же необходимо описать синхронизацию зависимых записей по отношениям в нашем экране:

```php
public function createOrUpdate(Post $post, Request $request)
{
    $post->fill($request->get('post'))->save();

    $post->attachments()->syncWithoutDetaching(
        $request->input('post.attachments', [])
    );

    Alert::info('You have successfully created a post.');

    return redirect()->route('platform.post.list');
}
```

После сохранения, связь с нашей записью будет установлена в таблице `attachmentable`:

```php
id  attachmentable_type  attachmentable_id  attachment_id
1 App\Post          3                 101
2 App\Post          3                 102
3 App\Post          3                 103
4 App\Post          3                 104
```

Но при новом обращении к редактированию записи, поле будет пустым. Это из-за того, что `query` не знает о дополнительных записях к нашей модели. Исправим это добавив загрузку:

```php
public function query(Post $post): array
{
    $post->load('attachments');

    return [
        'post' => $post
    ];
}
```

Теперь наши вложенные файлы загружаются и синхронизируются.
Более подробная информация содержится в разделах ["Элементы формы"](/ru/docs/field) и ["Вложенные файлы"](/ru/docs/attachments).
