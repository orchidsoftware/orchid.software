---
title: Аккордеон
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Аккордеоны полезны, когда вы хотите переключаться между скрытием и отображением большого количества контента:

![Accordion](https://orchid.software/assets/img/layouts/accordion.png)

Что бы использовать аккордеон необходимо указать слой, передав ему массив:

```php
use Orchid\Screen\Layout;

public function layout(): array
{
    return [
        Layout::accordion([
            'Personal Information' => [
                Layout::rows([
                    Input::make('user.name')
                        ->type('text')
                        ->required()
                        ->title('Name')
                        ->placeholder('Name'),

                    Input::make('user.email')
                        ->type('email')
                        ->required()
                        ->title('Email')
                        ->placeholder('Email'),
                ]),
            ],
            'Billing Address'      => [
                Layout::rows([
                    Input::make('address')
                        ->type('text')
                        ->required()
                        ->title('Адрес доставки')
                        ->placeholder('Ул. Ленина дом 14 оф.162'),
                ]),
            ],
        ]),
    ];
}
```

Ключи будут использованы в качестве заголовков.
