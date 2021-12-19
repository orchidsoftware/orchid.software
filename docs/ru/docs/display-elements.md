---
title: Макеты отображения
extends: _layouts.documentation
---

## Карточки

Карточки используются для упаковки небольшого количества контента. Обычно содержат заголовок, короткий абзац и кнопки управления.

![Cards](/img/layouts/cards.png)

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

Карточки поддерживают указание действий, так же как и `commandBar`. Для этого необходимо добавить второй аргумент:

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

> В этом примере используется [представители](/ru/docs/presenters), настоятельно рекомендуется ознакомиться с ними.

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




## Персона

Персона используется для визуализации аватара и описания человека.

![persona](/img/layouts/persona.png)

`Persona` принимает набор Объектов, которые реализуют интерфейс `Personable`.

> В этом примере используется [представители](/ru/docs/presenters), настоятельно рекомендуется ознакомиться с ними.

Вместо создания отдельного класса рекомендуется использовать представителей для `Eloquent` моделей, например:

```php
namespace App;

use App\Presenters\EmployeePresenter;
use Illuminate\Database\Eloquent\Client;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'position',
    ];

    public function presenter(): EmployeePresenter
    {
        return new EmployeePresenter($this);
    }
}
```

Можно записать представителя:

```php
namespace App\Presenters;

use Orchid\Screen\Contracts\Personable;
use Orchid\Support\Presenter;

class EmployeePresenter extends Presenter implements Personable
{

    public function title(): string
    {
        return $this->entity->name;
    }

    public function subTitle(): string
    {
        return $this->entity->position;
    }

    public function url(): string
    {
        return route('platform.systems.users.edit', $this->entity);
    }

    public function image(): ?string
    {
        return $this->entity->avatar;
    }
}
```

Использование в экране будет следующим:

```php
use Orchid\Screen\Layouts\Facepile;

/**
 * Query data.
 *
 * @return array
 */
public function query(): array
{
    return [
        'employee' => Employee::find(1)->presenter(),
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
        new Facepile('employee'),
    ];
}
```




## Facepile

Показывает список аватаров в горизонтальном виде. Каждый круг представляет человека. Используйте этот `layout` при отображении совместного доступа к определённому представлению, файлу или задаче.

![facepile](/img/layouts/facepile.png)

`Facepile` принимает набор Объектов, которые реализуют интерфейс `Personable`.

> В этом примере используется [представители](/ru/docs/presenters), настоятельно рекомендуется ознакомиться с ними.

Вместо создания отдельного класса рекомендуется использовать представителей для `Eloquent` моделей, например:

```php
namespace App;

use App\Presenters\EmployeePresenter;
use Illuminate\Database\Eloquent\Client;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'position',
    ];

    public function presenter(): EmployeePresenter
    {
        return new EmployeePresenter($this);
    }
}
```

Можно записать представителя:

```php
namespace App\Presenters;

use Orchid\Screen\Contracts\Personable;
use Orchid\Support\Presenter;

class EmployeePresenter extends Presenter implements Personable
{

    public function title(): string
    {
        return $this->entity->name;
    }

    public function subTitle(): string
    {
        return $this->entity->position;
    }

    public function url(): string
    {
        return route('platform.systems.users.edit', $this->entity);
    }

    public function image(): ?string
    {
        return $this->entity->avatar;
    }
}
```

Использование в экране будет следующим:

```php
use Orchid\Screen\Layouts\Facepile;

/**
 * Query data.
 *
 * @return array
 */
public function query(): array
{
    return [
        'avatars' => Employee::limit(8)->get()->map->presenter(),
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
        new Facepile('avatars'),
    ];
}
```
