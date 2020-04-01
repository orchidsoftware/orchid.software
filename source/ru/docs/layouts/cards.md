---
title: Карточки
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Карточки используются для упаковки небольшого количества контента. Обычно содержат заголовок, короткий абзац и кнопки управления. 

> В этом примере используется [представители](/ru/docs/presenters), настоятельно рекомендуеться ознакомится с ними.


![Cards](https://orchid.software/assets/img/layouts/cards.png)

Карточки принимают только обьекты которые реализуют интерфейс `Cardable`.

```php
use Orchid\Screen\Contracts\Cardable;
use Orchid\Screen\Layouts\Card;

/**
 * Query data.
 *
 * @return array
 */
public function query(): array
{
    return [
        'card'        => new class implements Cardable {
            /**
             * @return string
             */
            public function title(): string
            {
                return 'Title of a longer featured blog post';
            }

            /**
             * @return string
             */
            public function descriptions(): string
            {
                return 'This is a wider card with supporting text below as a natural lead-in to additional content. 
                        This content is a little bit longer. This is a wider card with supporting text below as 
                        a natural lead-in to additional content. This content is a little bit longer. 
                        This is a wider card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.';
            }

            /**
             * @return string
             */
            public function image(): ?string
            {
                return 'https://picsum.photos/600/300';
            }

            /**
             * @return mixed
             */
            public function color(): ?Color
            {
                return Color::INFO();
            }
        },
    ];
}

/**
 * Views.
 *
 * @return array
 * @throws \Throwable
 *
 */
public function layout(): array
{
    return [
        new Card('card', [
            Button::make('Example Button')
                ->method('example')
                ->icon('icon-bag'),
        ]),
    ];
}
```
