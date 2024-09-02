---
title: Modal Dialog
description: Learn how to use modal dialog in your Laravel Orchid projects with our comprehensive documentation. Get tips on creating dynamic modals, passing data to modals, and customizing modal behavior.
---


Emulation of a modal dialog box that appears on top of the main page content in response to user actions.


## Description of Work

A modal window appears on top of the page, dimming it. This helps to focus the user's attention on specific actions without losing the overall context. It is important to note that modal windows should not be used for large forms.

![This image shows an illustrative modal window.](/img/layouts/modals.png)


## When to Use

Modal windows are best used for secondary content that is only needed in certain situations. This content may include settings, creating new documents, filling out small forms. For example, clicking on a link may open a modal window to enter an address.

## Using

Modal windows can be implemented using a short syntax by calling a static method, which eliminates the need to create a separate class. The following example demonstrates how to create a modal window:

```php
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Toast;

/**
 * Button commands.
 *
 * @return \Orchid\Screen\Action[]
 */
public function commandBar(): array
{
    return [
        ModalToggle::make('Launch demo modal')
            ->modal('exampleModal')
            ->method('action')
            ->icon('full-screen'),
    ];
}

/**
 * Views.
 *
 * @return string[]|\Orchid\Screen\Layout[]
 */
public function layout(): array
{
    return [
        Layout::modal('exampleModal', [
            Layout::rows([]),
        ]),
    ];
}

/**
 * The action that will take place when
 * the form of the modal window is submitted
 */
public function action(): void
{
    Toast::info('Hello, world! This is a toast message.');
}
```


It is important to note that when adding a modal window, it should be added at the top level of the array returned by the `layout()` method. It should not be added inside of another layout such as `Tabs`.


## Title

To set the title of the modal window, the `title` method can be used:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->title('Window title');
```

## Window Size

Depending on the contents of the window, it may be necessary to resize it. This can be done by specifying the `size` method:


```php
use Orchid\Screen\Layouts\Modal;

Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->size(Modal::SIZE_LG);
```

## Button Names

A modal window has two actions:

- Color button - the default action, saves the work done or confirms the previously called command.
- Cancel button - closes the window without saving the entered data.


You can set your own names for them:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->applyButton('Send')
    ->closeButton('Close');
```

## Disabling Buttons

To disable each button has its own method:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->withoutApplyButton()
    ->withoutCloseButton();
```


## Position

The modal window can be displayed, not only in the center of the screen, but also on the right side:

```php
use Orchid\Screen\Layouts\Modal;

Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->type(Modal::TYPE_RIGHT);
```

## Opening

Sometimes you may need to open a modal window right after the page is displayed. To do this, you can use the `->open` method:

```php
use Orchid\Screen\Layouts\Modal;

Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->open();
```

## Disabling AJAX Processing

By default, the result of the window action will be displayed to the user on the screen, but this approach may not be suitable if you need to perform complex processing or download a file.
To disable response processing, you need to add a call to the `rawClick` method:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->rawClick();
```

## Deferred Data Loading

When working with a dataset, there is no need to create a modal window for each value. Instead, you can use deferred loading.
This will replace the `query` screen data when opening the window and display
new content.

In order to declare a modal window asynchronous, you must call the `deferred` method passing in the argument the method name that should be used instead of `query`:

```php
Layout::modal('deferredModal', Layout::rows([
    Input::make('welcome')
]))->deferred('loadDataOnOpen'),
```

Here is an example of a method for deferred loading:

```php
/**
 * This method is called to fetch data and is used to update the modal content
 * when the modal is opened, without a full page reload.
 */
public function asyncGetData(string $welcome): array
{
    return [
        'welcome' => $welcome,
    ];
}
```

When triggering the modal window, you can pass values directly:

```php
use Orchid\Screen\Actions\ModalToggle;

ModalToggle::make('Open asynchronous modal')
    ->method('methodForModal')
    ->modalTitle('Customizable Title')
    ->modal('deferredModal', [
        'welcome' => 'Hello world!',
    ]),
```

<!--

> **Please note**, when using your own templates, the content of the window uses dynamic data that is not in the initial loading. To eliminate possible errors, it is necessary to check for the existence of variables. In the `Blade` template engine, this might look like: `{{$variable ?? ''}}`.

-->
