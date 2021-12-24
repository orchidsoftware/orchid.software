---
title: Modal windows
description: Emulation of a modal dialog box that appears on top of the main page content in response to user actions.
---

Emulation of a modal dialog box that appears on top of the main page content in response to user actions.

![Modals](/img/layouts/modals.png)

## Description of work

A modal window appears on top of the page, dimming it. This helps to focus the user's attention on specific actions without losing the overall context.


> **Note:** Do not use modal windows for large forms.


## When to use

In the modal window you need to make the secondary content of the pages, which is required only in some cases. As a rule, these are settings, creating new documents, filling out small forms, a step-by-step wizard. For example, to enter an address, a click on a link opens a modal window.


## Using

Modal windows support short syntax by calling a static method, which does not require creating a separate class:

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

> **Please note**, adding a modal window must be done at the top level of the array returned by the `layout()` method. For example, you should not do like this:

```php
public function layouts(): array
{
    return [
        Layout::tabs([
            'Name' => Layout::modal('exampleModal', [Layout::rows([])]),
        ]),
    ];
}
```

## Title

To set the title, use the `title` method:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->title('Window title');
```

## Window size

Depending on the contents of the window, you may need to resize it, this can be done by specifying the `size` method:

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

## Asynchronous data loading

When working with a dataset, there is no need to create a modal window for each value. Instead, you can use asynchronous loading.
This will replace the `query` screen data when opening the window and display
new content.

In order to declare a modal window asynchronous, you must call the `async` method passing in the argument the method name that should be used instead of `query`:

```php
Layout::modal('asyncModal', [
    ExampleRow::class,
])->async('asyncGetData');
```

All asynchronous screen methods start with the `async` prefix:

```php
/**
 * @return array
 */
public function asyncGetData(string $welcome): array
{
    return [
        'welcome' => $welcome,
    ];
}
```

When calling such a modal window, you can pass values using the `asyncParameters` method, for example:

```php
use Orchid\Screen\Actions\ModalToggle;

ModalToggle::make('Open async modal')
    ->modal('asyncModal')
    ->modalTitle('Dynamics title')
    ->method('methodForModal')
    ->asyncParameters('Hello world!');
```


> **Please note**, when using your own templates, the content of the window uses dynamic data that is not in the initial loading. To eliminate possible errors, it is necessary to check for the existence of variables. In the `Blade` template engine, this might look like: `{{$variable ?? ''}}`.
