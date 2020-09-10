---
title: Табы
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Табы группируют контент и помогают в навигации. Полезны, когда вы хотите переключаться между скрытием и отображением большого количества контента:

![Tabs](/assets/img/layouts/tabs.png)

Табы поддерживают короткий синтаксис через вызов статического метода, 
что не требует создания отдельного класса:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::tabs([
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

Обратите внимание, что вы можете указывать в качестве значений и строчное имя класса:

```php
public function layout(): array
{
    return [
        Layout::tabs([
            'Personal Information' => PersonalInformationRow::class,
            'Billing Address'      => BillingAddressRow::class,
        ]),
    ];
}
```
