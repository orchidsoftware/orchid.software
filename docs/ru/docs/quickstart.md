---
title: Быстрый старт для начинающих
description: Краткое руководство представляет собой базовое введение в инфраструктуру Orchid
---



<div class="d-none d-md-flex text-center text-md-start align-items-center gap-4 bg-dark text-white px-5 py-4 mb-4 rounded-3 position-relative">

    <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"></path>
    </svg>

    <div class="flex-grow-1 text-center text-lg-start pe-md-3">
        <div class="opacity-50">Любите видеоуроки?</div>
        <div style="line-height: 1.4;">Тогда обязательно посмотрите наши бесплатные видеоуроки на YouTube</div>
    </div>

    <a href="https://www.youtube.com/playlist?list=PLM-y77GFP_D0ZtrNGXorSjlcO8KsFrcgJ" target="_blank" class="btn btn-outline-primary stretched-link">Смотреть</a>
</div>

Это краткое руководство представляет собой базовое введение в инфраструктуру и включает в себя информацию
об экранах и элементах формы. 
Чтобы отобрать базовый набор функций, мы создадим простую утилиту по отправке сообщений по электронной почте.

На этом этапе предполагается, что Вы уже [установили фреймворк и платформу](/ru/docs/installation), создали базу данных и запустили веб-сервер.


> Прежде чем мы начнем, настоятельно рекомендуем вам не копировать и не вставлять код. Ввод каждого раздела вручную поможет вам попрактиковаться и запомнить материал.

Для начала необходимо создать [экран](/ru/docs/screens) для отображения формы отправки, с помощью команды:

```bash
php artisan orchid:screen EmailSenderScreen
```

В директории `app/Orchid/Screens` будет создан новый файл `EmailSenderScreen.php` :

```php
namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class EmailSenderScreen extends Screen
{
     /**
       * Метод, определяющий все входные данные экрана. 
       * Именно в нём должны вызываться запросы к базе данных,
       * api или любые другие (не обязательно явно),
       * результатом которого должен быть массив, 
       * обращение к которым будут использоваться его ключи.
       */
    public function query(): array
    {
        return [];
    }

    /**
     * Имя отображается на экране пользователя и в заголовках
     */
    public function name(): ?string
    {
        return "EmailSenderScreen";
    }

    /**
     * Описание отображается на экране пользователя и в заголовках
     */
    public function description(): ?string
    {
        return "EmailSenderScreen";
    }
    
     /**
       * Определяет управляющие кнопки и события,
       * которые должны будут произойти по нажатию
       */
    public function commandBar(): array
    {
        return [];
    }

    /**
      * Набор отображений 
      * строк, таблиц, графиков,
      * модальных окон и их комбинации.
      */
    public function layout(): array
    {
        return [];
    }
}
```

Главным отличием экрана от контроллера является определённая заранее структура, которая обслуживает 
только одну страницу, определяя данные и события.

Как и контроллер, экран нужно регистрировать в файле маршрутов. 
Определим его в файле для панели администрирования `routes/platform.php`:

```php
use App\Orchid\Screens\EmailSenderScreen;

Route::screen('email', EmailSenderScreen::class)->name('platform.email');
```

После того, как мы зарегистрировали новый маршрут, можно перейти в браузере по адресу `/admin/email`. 
Сейчас здесь пока пустой экран. Наполним его элементами.

Добавим название и описание:

```php
/**
 * The name is displayed on the user's screen and in the headers
 */
public function name(): ?string
{
    return "Email sender";
}

/**
 * The description is displayed on the user's screen under the heading
 */
public function description(): ?string
{
    return "Tool that sends ad-hoc email messages.";
}
```

Для того, чтобы отобразить поля для ввода, мы опишем их в методе `Layouts`:

```php
use App\Models\User;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;


/**
 * Views.
 *
 * @return Layout[]
 */
public function layout(): array
{
    return [
        Layout::rows([
            Input::make('subject')
                ->title('Subject')
                ->required()
                ->placeholder('Message subject line')
                ->help('Enter the subject line for your message'),

            Relation::make('users.')
                ->title('Recipients')
                ->multiple()
                ->required()
                ->placeholder('Email addresses')
                ->help('Enter the users that you would like to send this message to.')
                ->fromModel(User::class,'name','email'),

            Quill::make('content')
                ->title('Content')
                ->required()
                ->placeholder('Insert text here ...')
                ->help('Add the content for the message that you would like to send.')

        ])
    ];
}
```

Теперь наша страница имеет некоторые элементы, но не производит действий. 
Чтобы определить их, необходимо создать новый публичный метод и указать ссылку на него в `commandBar`:


```php
namespace App\Orchid\Screens;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class EmailSenderScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return "Email sender";
    }
    
    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Tool that sends ad-hoc email messages.";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Send Message')
                ->icon('paper-plane')
                ->method('sendMessage')
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
                Input::make('subject')
                    ->title('Subject')
                    ->required()
                    ->placeholder('Message subject line')
                    ->help('Enter the subject line for your message'),

                Relation::make('users.')
                    ->title('Recipients')
                    ->multiple()
                    ->required()
                    ->placeholder('Email addresses')
                    ->help('Enter the users that you would like to send this message to.')
                    ->fromModel(User::class,'name','email'),

                Quill::make('content')
                    ->title('Content')
                    ->required()
                    ->placeholder('Insert text here ...')
                    ->help('Add the content for the message that you would like to send.')

            ])
        ];
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'subject' => 'required|min:6|max:50',
            'users'   => 'required',
            'content' => 'required|min:10'
        ]);

        Mail::raw($request->get('content'), function (Message $message) use ($request) {
            $message->from('sample@email.com');
            $message->subject($request->get('subject'));

            foreach ($request->get('users') as $email) {
                $message->to($email);
            }
        });


        Alert::info('Your email message has been sent successfully.');
    }
}
```

После этого мы имеем возможность отправлять email сообщения на указанные в созданной форме адреса.

> **Обратите внимание**: по умолчанию включен `smtp` драйвер для отправки почты. 
Вы можете изменить его в `.env` файле на `log` для проверки.

Так как наша утилита вымышленная, мы можем пофантазировать и представить, что наш босс попросил ставить заголовок наших сообщений вида: "Новости компании за июль", но иметь возможность менять его. Для этого добавим ключ в метод `query` с именем нашего элемента:

```php
/**
 * Query data.
 *
 * @return array
 */
public function query(): array
{
    return [
        'subject' => date('F').' Campaign News',
    ];
}
```

Теперь в поле с именем `subject` автоматически подставлено значение из результата.

Все это время для отображения экрана нам приходилось вручную указывать в браузере адрес нашей страницы. Добавим новый пункт в меню, для чего
в файле по адресу `app/Orchid/PlatformProvider.php` добавим объявление:

```php
use Orchid\Screen\Actions\Menu;

/**
 * @return ItemMenu[]
 */
public function registerMainMenu(): array
{
    return [
        // Другие пункты меню...
    
        Menu::make('Email sender')
            ->icon('envelope-letter')
            ->route('platform.email')
            ->title('Tools')
    ];
}
```

Теперь наша утилита отображается в левом меню и активна при посещении. 
Навигация может осуществляться не только посредством переходов из меню, но и через хлебные крошки. 
Чтобы добавить их к нашему экрану, нужно дописать свой маршрут с `->breadcrumbs(...)` в `routes/platform.php`:

```php
use App\Orchid\Screens\EmailSenderScreen;
use Tabuna\Breadcrumbs\Trail;

Route::screen('email', EmailSenderScreen::class)
    ->name('platform.email')
    ->breadcrumbs(function (Trail $trail){
        return $trail
                ->parent('platform.index')
                ->push('Email sender');
    });
```


Поздравляем! Теперь Вы должны понимать, как работает платформа! Это очень простой пример, но процесс разработки будет идентичен во многих аспектах. Теперь рекомендуем перейти к разделу ["Экраны"](/ru/docs/screens), чтобы узнать больше о возможностях, которые находятся у Вас в руках.
