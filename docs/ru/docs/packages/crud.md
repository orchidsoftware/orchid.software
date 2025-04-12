---
title: Laravel Orchid CRUD
---

## Введение

Laravel Orchid предоставляет уникальный опыт написания приложений. Тем не менее, иногда необходимо выполнить простой CRUD, тогда это может показаться излишним. 
Поэтому мы создали новый пакет, предназначенный для разработчиков, которые хотят быстро создать пользовательский интерфейс для моделей Eloquent с такими функциями, как создание, чтение, обновление и удаление.

Весь процесс можно описать одним файлом. А когда вам нужно больше возможностей, вы можете легко переключиться на использование платформы. Все поля, фильтры и признаки совместимы.

## Установка

> В руководстве предполагается, что у вас уже есть копия [Laravel](https://laravel.com/docs/installation) с [Orchid](https://orchid.software/en/docs/installation/)

Вы можете установить пакет с помощью Сomposer. Выполните команду:

```php
$ composer require orchid/crud
```

Это обновит `composer.json` и установит пакет в каталог `vendor/`.

## Определение ресурсов

Ресурсы хранятся в каталоге `app/Orchid/Resources`  вашего приложения. Вы можете сгенерировать новый ресурс с помощью Artisan команды `orchid:resource`:

```bash
php artisan orchid:resource PostResource
```

Наиболее фундаментальным свойством ресурса является его свойство `model`. 
Это свойство сообщает генератору, какой модели Eloquent соответствует ресурс:

```php
use App\Models\Post;

/**
 * The model the resource corresponds to.
 *
 * @var string
 */
public static $model = Post::class;
```

Эти классы полностью статичны. У них вообще нет состояния из-за их декларативного характера. 
Они только говорят, что делать и хранят никаких данных. Поэтому, если Вы добавляете пользовательские методы, убедитесь, что они статические.

Только что созданные ресурсы ничего не содержат. Не волнуйтесь. Скоро мы добавим больше полей в наш ресурс.


## Регистрация ресурсов

Все ресурсы в каталоге `app/Orchid/Resources` будут автоматически зарегистрированы по умолчанию.
Вам не нужно регистрировать их вручную. Но если это требуется, например, при создании дополнительного пакета, то лучшим способом будет:
```php
use App\Orchid\Resources\UserResource;
use Illuminate\Support\ServiceProvider;
use Orchid\Crud\Arbitrator;

class CrudServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Arbitrator $arbitrator)
    {
        $arbitrator->resources([
            UserResource::class,
        ]);
    }
}
```

## Расширение модели

Многие функции платформы Orchid зависят от настройки модели. Вы можете добавлять или удалять трейты в зависимости от ваших целей. Но мы предполагаем, что вы установили их для своей модели:

```php
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource, Filterable, Attachable;
}
````


## Определение полей

Каждый ресурс содержит метод `fields`. Этот метод возвращает массив полей, которые обычно расширяют класс `Orchid\Screen\Field` класс. Чтобы добавить поле к ресурсу, мы можем добавить его в метод `fields` ресурса. Как правило, поля могут быть созданы с использованием их статического метода `make`. Этот метод принимает несколько аргументов; однако обычно вам нужно передать только имя поля.


```php
use Orchid\Screen\Fields\Input;

/**
 * Get the fields displayed by the resource.
 *
 * @return array
 */
public function fields(): array
{
    return [
        Input::make('title')
            ->title('Title')
            ->placeholder('Enter title here'),
    ];
}
```
В пакете для генерации CRUD можно использовать поля платформы Orchid. Просмотрите [все доступные поля на сайте документации](https://orchid.software/ru/docs/field/).


## Определение столбцов

Каждый ресурс содержит метод `сolumns`. Чтобы добавить столбец к ресурсу, мы можем добавить его в метод`column`. Как правило, столбцы могут быть созданы с использованием их статического метода `make`. 

```php
use Orchid\Screen\TD;

/**
 * Get the columns displayed by the resource.
 *
 * @return TD[]
 */
public function columns(): array
{
    return [
        TD::make('id'),
        TD::make('title'),
    ];
}
```
Пакет генерации CRUD полностью основан на табличном слое. Подробнее об этом можно [прочитать на странице документации](https://orchid.software/ru/docs/table/).

## Определение легенды

Каждый ресурс содержит метод `legend`. Он определяет, как модель будет выглядеть при просмотре. 
Чтобы добавить к ресурсу, мы можем добавить его в метод ресурса `legend` method. 
Как правило, столбцы могут быть созданы с использованием их статического метода `make`. 

```php
use Orchid\Screen\Sight;

/**
 * Get the sights displayed by the resource.
 *
 * @return Sight[]
 */
public function legend(): array
{
    return [
        Sight::make('id'),
        Sight::make('title'),
    ];
}
```
Пакет генерации CRUD полностью основан на слое легенды. Подробнее об этом можно [прочитать на странице документации](https://orchid.software/en/docs/legend).

## Определение правил

Каждый ресурс содержит `rules` метод.  При отправке формы создания или обновления данные могут быть проверены с помощью правилл описанных в методе `rules`:

``` php
/**
 * Get the validation rules that apply to save/update.
 *
 * @return array
 */
public function rules(Model $model): array
{
    return [
        'slug' => [
            'required',
            Rule::unique(self::$model, 'slug')->ignore($model),
        ],
    ];
}
```

Вы можете узнать больше на [странице validation](https://laravel.com/docs/validation#available-validation-rules).


## Определение фильтров

Каждый ресурс содержит метод `filters`. Ожидается, что будет возвращен список имен классов, которые должны быть отображены и, при необходимости, заменены для просматриваемой модели.

``` php
/**
 * Get the filters available for the resource.
 *
 * @return array
 */
public function filters(): array
{
    return [];
}
```

Для создания нового фильтра используйте команду:

```bash
php artisan orchid:filter QueryFilter
```

В результате чего будет создан фильтр класса в папке `app/Http/Filters`. Чтобы использовать фильтры на собственном ресурсе, вам необходимо:

```php
public function filters(): array
{
    return [
        QueryFilter::class
    ];
}
```


Мы предлагаем несколько готовых фильтров:

- `Orchid\Crud\Filters\DefaultSorted` - Настройка сортировки столбцов по умолчанию
- `Orchid\Crud\Filters\WithTrashed` - Для отображения удаленных записей


```php
public function filters(): array
{
    return [
        new DefaultSorted('id', 'desc'),
    ];
}
```

Подробнее можно узнать на [странице фильтрации](https://orchid.software/ru/docs/filters/#klassiceskii-filtr) Orchid.

## Навигация

Если вы не хотите, чтобы ресурс отображался в навигации, вы можете переопределить метод `displayInNavigation` своего класса ресурсов:

```php
/**
 * Get the resource should be displayed in the navigation
 *
 * @return bool
 */
public static function displayInNavigation(): bool
{
    return false;
}
```


## Нетерпеливая загрузка

Предположим, вам регулярно требуется доступ к отношениям ресурса в ваших полях. В этом случае может быть хорошей идеей добавить отношение к свойству `with` вашего ресурса. 
Это свойство предписывает всегда загружать перечисленные отношения при извлечении ресурса.

```php
 /**
 * Get relationships that should be eager loaded when performing an index query.
 *
 * @return array
 */
public function with(): array
{
    return ['user'];
}
```

## Пагинация

Чтобы определить, сколько результатов должно отображаться на странице, используйте метод `perPage`:

```php
/**
 * Get the number of models to return per page
 *
 * @return int
 */
public static function perPage(): int
{
    return 30;
}
```


## События Ресурса

У каждого ресурса есть два метода, которые выполняют обработку, `onSave` и `onDelete`. 
Каждый из них запускается при выполнении соответствующего события, и вы можете изменить или дополнить логику:

``` php
use Orchid\Crud\ResourceRequest;
use Illuminate\Database\Eloquent\Model;

/**
 * Action to create and update the model
 *
 * @param ResourceRequest $request
 * @param Model           $model
 */
public function onSave(ResourceRequest $request, Model $model)
{
    $model->forceFill($request->all())->save();
}

/**
 * Action to delete a model
 *
 * @param Model $model
 *
 * @throws Exception
 */
public function onDelete(Model $model)
{
    $model->delete();
}
```


## Разрешения ресурсов

Каждый ресурс содержит метод `permission`, который должен возвращать строковый ключ, необходимый пользователю для доступа к этому ресурсу. 
По умолчанию все ресурсы доступны каждому пользователю.

```php
/**
 * Get the permission key for the resource.
 *
 * @return string|null
 */
public static function permission(): ?string
{
    return null;
}
```

Для каждого зарегистрированного ресурса, в котором метод возвращает ненулевое значение, создается новое разрешение.
```php
/**
 * Get the permission key for the resource.
 *
 * @return string|null
 */
public static function permission(): ?string
{
    return 'private-post-resource';
}
```

Для того что бы дать пользователю мандат (права) необходимо нажать на вкладку `пользователи` в левом меню, перейти к конкретному пользователю. На странице пользователя будет раздел где можно назначить ему роль или права. После этого ресурс будет отображен в меню

## Действия

Действия могут быть сгенерированы с помощью команды  Artisan `orchid:action`:

```bash
php artisan orchid:action CustomAction
```

По умолчанию все действия помещаются в каталог `app/Orchid/Actions`. Действие обязательно состоит из двух методов. Метод `button` определяет имя, значок, диалоговое окно и т. д. И `handler`, который напрямую обрабатывает действие с моделями.

```php
namespace App\Orchid\Actions;

use Illuminate\Support\Collection;
use Orchid\Crud\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class CustomAction extends Action
{
    /**
     * The button of the action.
     *
     * @return Button
     */
    public function button(): Button
    {
        return Button::make('Run Custom Action')->icon('fire');
    }

    /**
     * Perform the action on the given models.
     *
     * @param \Illuminate\Support\Collection $models
     */
    public function handle(Collection $models)
    {
        $models->each(function () {
            // action
        });

        Toast::message('It worked!');
    }
}
```

В рамках метода `handle` можно выполнять любые задачи, необходимые для завершения действия.

> Метод handle всегда получает `Collection` моделей, даже если действие выполняется только для одной модели.


После того как вы определили действие, вы готовы прикрепить его к ресурсу. Каждый ресурс содержит метод действий. Чтобы прикрепить действие к ресурсу, необходимо добавить его в массив действий, возвращаемых этим методом:


```php
/**
 * Get the actions available for the resource.
 *
 * @return array
 */
public function actions(): array
{
    return [
        CustomAction::class,
    ];
}
```


## Политики

Чтобы ограничить, какие пользователи могут просматривать, создавать, обновлять или удалять ресурсы, используются [политики авторизации](https://laravel.com/docs/authorization#creating-policies) Laravel. Политики — это простые классы PHP, которые организуют логику авторизации для конкретной модели или ресурса. Например, если ваше приложение является блогом, у вас может быть модель `Post`  и соответствующий класс `PostPolicy`.

Если CRUD обнаружит, что политика была зарегистрирована для модели, он автоматически проверит соответствующие методы авторизации этой политики перед выполнением соответствующих действий, таких как:

- viewAny
- view
- create
- update
- delete
- restore
- forceDelete

Никаких дополнительных настроек не требуется! Так, например, чтобы определить, каким пользователям разрешено обновлять модель `Post` вам необходимо определить метод `update` в для соответствующем классе политики модели:

```php
namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the post.
     *
     * @param  User  $user
     * @param  Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return true;
    }
}
```


> Если политика существует, но в ней отсутствует определенный метод действия, пользователю не будет разрешено выполнять это действие. Итак, если вы определили политику, не забудьте определить все соответствующие методы.


Если вы не хотите, чтобы политика влияла на пользователей генерации CRUD, вы можете разрешить все действия в рамках данной политики. Для этого определите метод `before` метод в политике. Он будет выполнен перед любыми другими методами политики что позволит вам авторизовать действие до фактического вызова предполагаемого метода политики.

```php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->hasAccess('private-post-resource')) {
            return true;
        }
    }
}
```


## Предотвращение конфликтов (Traffic Cop)

Если эта опция активна, модель будет проверена на наличие последних изменений, если она была обновлена ​​после открытия формы редактирования. Будет выброшена ошибка проверки. Функция Traffic Cop по умолчанию отключена.

```php
/**
 * Indicates whether should check for modifications
 * between viewing and updating a resource.
 *
 * @return  bool
*/
public static function trafficCop(): bool
{
    return false;
}
```

## Описание

Для отображения дополнительного описания на каждой странице ресурса используйте `description`:

```php
/**
 * Get the descriptions for the screen.
 *
 * @return null|string
 */
public static function description(): ?string
{
    return null;
}
```

## Breadcrumbs

На каждой странице ресурса есть хлебные крошки. Вы можете отслеживать сообщения, используя следующие методы:

```php
/**
 * Get the text for the list breadcrumbs.
 *
 * @return string
 */
public static function listBreadcrumbsMessage(): string
{
    return static::label();
}

/**
 * Get the text for the create breadcrumbs.
 *
 * @return string
 */
public static function createBreadcrumbsMessage(): string
{
    return __('New :resource', ['resource' => static::singularLabel()]);
}

/**
 * Get the text for the edit breadcrumbs.
 *
 * @return string
 */
public static function editBreadcrumbsMessage(): string
{
    return __('Edit :resource', ['resource' => static::singularLabel()]);
}
```

## Локализация

Имена ресурсов могут быть локализованы путем переопределения методов  `label` и `singularLabel` в классах ресурсов:

``` php
/**
 * Get the displayable label of the resource.
 *
 * @return string
 */
public static function label()
{
    return __('Posts');
}

/**
 * Get the displayable singular label of the resource.
 *
 * @return string
 */
public static function singularLabel()
{
    return __('Post');
}
```

Кнопки действий и уведомления тоже можно перевести, например:


```php
/**
 * Get the text for the create resource button.
 *
 * @return string|null
 */
public static function createButtonLabel(): string
{
    return __('Create :resource', ['resource' => static::singularLabel()]);
}

/**
 * Get the text for the create resource toast.
 *
 * @return string
 */
public static function createToastMessage(): string
{
    return __('The :resource was created!', ['resource' => static::singularLabel()]);
}
```

Вы можете узнать больше на странице [Laravel localization](https://laravel.com/docs/localization).
