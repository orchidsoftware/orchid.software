---
title: Карточки
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Карточки используются для упаковки небольшого количества контента. Обычно содержат заголовок, короткий абзац и кнопки управления. 

![Cards](/assets/img/layouts/cards.png)

Карточки принимают только Объекты, которые реализуют интерфейс `Cardable`.

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

            public function title(): string
            {
                return 'Title of a longer featured blog post';
            }

            public function description(): string
            {
                return 'This is a wider card with supporting text below as a natural lead-in to additional content. 
                        This content is a little bit longer. This is a wider card with supporting text below as 
                        a natural lead-in to additional content. This content is a little bit longer. 
                        This is a wider card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.';
            }

            public function image(): ?string
            {
                return 'https://picsum.photos/600/300';
            }

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
        new Card('card'),
    ];
}
```

## Использование собственных шаблонов

Карточка позволяет комбинировать любое отображение в методе `description`,

```php
public function description(): string
{
    return view('template')->render();
}
```

> **Примечание.** Любое значение, вернувшееся в нём, будет отображено как есть.

## Указание действий

Карточки поддерживают указание действий, так же как и `commandBar`, для этого необходимо добавить второй аргумент:

```php
public function layout(): array
{
    return [
        new Card('card', [
            Button::make('Example Button')
                ->method('example')
                ->icon('bag'),
        ]),
    ];
}
```

## Использование с представителями

> В этом примере используется [представители](/ru/docs/presenters), настоятельно рекомендуеться ознакомится с ними.
 
Вместо создания отдельного класса рекомендуется использовать представителей для `Eloquent` моделей, например:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'descriptions',
        'image',
        'amount',
    ];

    public function presenter(): ProductPresenter
    {
        return new ProductPresenter($this);
    }
}
```

Можно записать представителя:
```php
namespace App\Presenters;

use Orchid\Screen\Contracts\Cardable;
use Orchid\Support\Presenter;

class ProductPresenter extends Presenter implements Cardable
{
    public function title(): string
    {
        return $this->entity->title;
    }

    public function description(): string
    {
        return $this->entity->description;
    }

    public function image(): ?string
    {
        return $this->entity->image;
    }

    public function color(): ?Color
    {
        return $this->entity->amount > 0
            ? Color::SUCCESS()
            : Color::DANGER();
    }
}
```

Тогда запись использования в экране будет краткой:


```php
use Orchid\Screen\Layouts\Card;

/**
 * Query data.
 *
 * @return array
 */
public function query(): array
{
    return [
        'product' => Product::findOrFail(1)->presenter(),
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
        new Card('product'),
    ];
}
```
