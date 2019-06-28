---
title: Quick start for beginners
description: The Quick Start Guide is a basic introduction to the Orchid infrastructure.
extends: _layouts.documentation.en
section: main
---

This quick start guide provides a basic introduction to the infrastructure and includes information.
about screens and form elements.
To select the basic set of functions, we will create a simple utility for sending emails.

At this stage it is necessary that you have already [installed the framework and the platform](/en/docs/installation), created the database and started the web server.

First you need to create [screen](/en/docs/screens) to display the submission form, using the command:

```bash
php artisan orchid:screen EmailSenderScreen
```

A new file `EmailSenderScreen.php` will be created in the `app/Orchid/Screens` directory:

```php
namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class EmailSenderScreen extends Screen
{
    /**
     * Name and description properties are responsible for
     * what name will be displayed
     * on user screen and in headlines.
     */
    public $name = 'EmailSenderScreen';
    public $description = 'EmailSenderScreen';

    /**
     * Method that defines all screen input data
     * it is in it that database queries should be called,
     * api or any others (not necessarily explicit),
     * the result of which should be an array,
     * appeal to which his keys will be used.
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Identifies control buttons and events.
     * which will have to happen by pressing
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Set of mappings
     * rows, tables, graphs,
     * modal windows and their combinations
     * /
    public function layout(): array
    {
        return [];
    }
}
```

The main difference of the screen from the controller is the structure defined in advance, which serves
only one page defining data and events.

Like the controller, the screen needs to be registered in the route file,
Define it in the file for the admin panel `routes/platform.php`:

```php
use App\Orchid\Screens\EmailSenderScreen;

$this->router->screen('email', EmailSenderScreen::class)->name('platform.email');
```

After we have registered a new route, you can go to the browser at `/dashboard/email`,
to look at the empty screen, fill it with the elements.

Add a name and description:

```php
/**
 * Display header name.
 *
 * @var string
 */
public $name = 'Email sender';

/**
 * Display header description.
 *
 * @var string
 */
public $description = 'Tool that sends ad-hoc email messages.';
```

In order to display the input fields, we describe them in the `Layouts` method:

```php
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

        ])->with(70)
    ];
}
```

Now our page has some elements, but does not produce any action.
to define them you need to create a new public method and specify a link to it in `commandBar`:

```php
namespace App\Orchid\Screens;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class EmailSenderScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Email sender';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Tool that sends ad-hoc email messages.';

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
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::name('Send Message')
                ->icon('icon-paper-plane')
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

            ])->with(70)
        ];
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        Mail::raw($request->get('content'), function (Message $message) use ($request) {

            $message->subject($request->get('subject'));

            foreach ($request->get('users') as $email) {
                $message->to($email);
            }
        });


        Alert::info('Your email message has been sent successfully.');
        return back();
    }
}
```

After that we have the ability to send email messages to addresses.

> Note that by default the `smtp` driver is enabled for sending mail,
You can change it in the `.env` file to` log` for verification.

Since our utility is mixed up, we can dream up and imagine that our boss asked us to put the title of our messages like “Campaign news for July”, but be able to change it. To do this, add the key to the `query` method with the name of our element:

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

Now the field with the name `subject` automatically fits the value from the result.

All this time, to display the screen, it was necessary to specify an explicit page in the browser, add a new item to the menu, for this
in the composer file at `app/Orchid/Composers/MainMenuComposer.php` we add the declaration:

```php
$this->dashboard->menu
    ->add(Menu::MAIN,
        ItemMenu::label('Email sender')
            ->icon('icon-envelope-letter')
            ->route('platform.email')
            ->title('Tools')
    );
```

Now our utility is displayed in the left menu and is active when visiting.
Navigation can be carried out not only through transitions from the menu, but also through bread crumbs,
to add them to our screen you need to add a new ad in the `routes/breadcrumbs.php` by route name

```php
Breadcrumbs::for('platform.email', function ($trail) {
    $trail->parent('platform.index');
    $trail->push('Email sender');
});
```


Congratulations, you should now understand how the platform works! This is a very simple example, but the development process will be identical in many aspects. Now we recommend to go to the [Screens](/en/docs/screens) section in order to learn more about the possibilities that are in your hands.
