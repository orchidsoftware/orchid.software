---
title: Управление вложенными файлами
description: Laravel File Manager
extends: _layouts.documentation.ru
section: main
---

Это руководство предолжение учебника ["Управление данными"](/ru/docs/quickstart-crud), 
в котором мы будем разбирать работу с ["Вложенными файлами"](/ru/docs/attachments).

Вернемся к ранее созданой модели `Post` и добавим новую колонку `hero`, 
в которой будем хранить информацию о главном изображении в нашей записи блога:

```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHeroColumnForPostTable extends Migration
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
// app/Post.php

protected $fillable = [
    'title',
    'description',
    'body',
    'author',
    'hero'
];
//..
```

Для записи данных в новую колонку, необходимо добавить подходящее поле в наш экран создания/редактирования, 
возьмем `Cropper` позволяющий обрезать изображение:

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

        ])->with(75)
    ];
}
```

> **Примечание.** Если в ходе загрузки файла, вы не увидели свое изображение в конечном результате, 
пожалуйста проверьте настройки `upload_max_filesize` и `post_max_size`, возможно требуется увеличить эти значения.


> **Примечание.** Cсылка на изображение формируется из `url` адреса указанного в вашем файле конфигурации, 
что при локальной разработки через встроенный веб-сервер требуется указание порта.


Для такого поля дополнительно указали ширину и высоту, для возможности быть уверенными в том, 
что пропорции отображены пользователю. После сохранения записи с изображением в колонку базы данных будет записан полный `url`
адрес до изображения, например:

```
http://localhost:8000/storage/2019/08/02/0f92ef693c26f3c1dbe2e3792abac9254ee98310.png
```

Это самая простая запись, но что если вы решите использовать `https` или сменить домен? 
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

> **Примечание.** Для того, что бы ваша база данных была однородна используйте один из предложенных вариантов.

Остановимся на записи номера, но для начало удалите все уже существующие записи.
Для того, что бы отображать картинку вне пакета необходимо установить связь в нашей модели: 

```php
// app/Post.php

use Orchid\Attachment\Models\Attachment;

public function hero()
{
    return $this->hasOne(Attachment::class, 'id', 'hero');
}
```

После этого, мы можем обращаться и загружать наш обьект `Attachment`, например:

```php
$url = \App\Post::find(3) 
    ->hero() 
    ->first() 
    ->url(); 
```
