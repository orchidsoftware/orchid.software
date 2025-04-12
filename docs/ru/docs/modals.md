---
title: Модальные окна
---

Эмуляция модального диалогового окна,  появляющегося поверх основного содержимого страницы  в ответ на действия пользователя.

![Modals](/img/layouts/modals.png)

## Описание работы

Модальное окно появляется поверх страницы, затемняя ее. Это помогает сфокусировать внимание пользователя на конкретных действиях, не теряя при этом общий контекст.

> **Примечание.** Не используйте модальные окна для больших форм.

## Когда использовать

В модальное окно нужно выносить второстепенное содержимое страниц, которое требуется только в некоторых случаях. Как правило, это настройки, создание новых документов, заполнение небольших форм, пошаговый мастер. Например, для ввода адреса — при клике по ссылке открывается модальное окно.

## Использование

Модальные окна поддерживают короткий синтаксис через вызов статического метода, что не требует создания отдельного класса:

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

> **Обратите внимание.** Добавление модального окна необходимо делать в верхний уровень возвращаемого методом `layout()` массива. Например, не стоит делать вот так:

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

## Параметры

### Заголовок

Для установки заголовка используется метод `title`:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->title('Заголовок окна');
```

### Размер окна

В зависимости от содержимого окна, может потребоваться изменить его размер, это можно сделать указав метод `size`:

```php
use Orchid\Screen\Layouts\Modal;

Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->size(Modal::SIZE_LG);
```

### Имена кнопок

Модальное окно имеет два действия:

- Цветная кнопка — действие по умолчанию, сохраняет проделанную работу или подтверждает вызванную ранее команду.
- Кнопка отмены — закрывает окно без сохранения введенных данных.

Вы можете установить собственные названия для них:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->applyButton('Отправить')
    ->closeButton('Закрыть');
```

### Отключение кнопок

Для отключения каждой кнопки имеется собственный метод:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->withoutApplyButton()
    ->withoutCloseButton();
```

### Расположение

Модальное окно можно отображать не только по центру экрана, но и по правой стороне:

```php
use Orchid\Screen\Layouts\Modal;

Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->type(Modal::TYPE_RIGHT);
```

### Открытие

Иногда вам может понадобиться открыть модальное окно сразу после отображения страницы. Для этого можно использовать метод `->open`:

```php
use Orchid\Screen\Layouts\Modal;

Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->open();
```

### Отключение AJAX-обработки

По умолчанию результат выполнения действия окна будет выведен пользователю на экран, но такой подход может не подойти, если необходимо выполнить сложную обработку или скачать файл.
Чтобы отключить обработку ответа, необходимо добавить вызов метода `rawClick`:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->rawClick();
```

## Асинхронная загрузка данных

При работе с набором данных, нет необходимости создавать модальное окно для каждого значения. Вместо этого, можно воспользоваться асинхронной загрузкой.
Это позволит подменить данные экрана `query` при открытии окна и отобразить
новое содержимое.

Для того чтобы объявить модальное окно асинхронным, необходимо вызвать метод `async`, передав в качестве аргумента имя метода, который должен использоваться вместо `query`:

```php
Layout::modal('asyncModal', [
    ExampleRow::class,
])->async('asyncGetData');
```

Все асинхронные методы экрана начинаются с префикса `async`:

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

При вызове такого модального окна, вы можете передавать значения c помощью метода `asyncParameters`, например:

```php
use Orchid\Screen\Actions\ModalToggle;

ModalToggle::make('Open async modal')
    ->modal('asyncModal')
    ->modalTitle('Dynamics title')
    ->method('methodForModal')
    ->asyncParameters('Hello world!');
```

> **Обратите внимание**, при использовании собственных шаблонов в содержимом окна используются динамические данные, которых нет в первоначальной загрузке. Для исключения возможных ошибок необходимо делать проверку на существование переменных. В шаблонизаторе `Blade` это может выглядеть как: `{{ $variable ?? '' }}`.
