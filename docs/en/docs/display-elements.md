---
title: Display elements
description: Learn how to use Laravel Orchid's display elements to enhance the appearance and functionality of your application's frontend. With customizable templates, card, and more, you can take your app to the next level.
---

## Cards

Cards are used to pack a small amount of content. Usually they contain a title, a short paragraph and control buttons.

![Cards](/img/layouts/cards.png)

Cards accept only objects that implement the interface `Cardable`.

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

### Using custom templates

The card allows you to combine any display in the `description` method,

```php
public function description(): string
{
    return view('template')->render();
}
```

> **Note.** Any value returned in it will be displayed as is.

### Action

Cards support the indication of actions, as well as the `commandBar`, for this you need to add the second argument:

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

### Use with presenter

> In this example, [presenters](/en/docs/presenters) are used, we strongly recommend that you familiarize yourself with them.
 
Instead of creating a separate class, it is recommended to use representatives for `Eloquent` models, for example:

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

You can record a presenter:
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

Then the usage record in the screen will be short:

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



## Persona

A person is used to visualize an avatar and describe a person.

![persona](/img/layouts/persona.png)

`Persona` accepts a set of objects that implement the `Personable` interface.

> This example uses [presenters](/en/docs/presenters), recommend that you familiarize yourself with them.
 
Instead of creating a separate class, it is recommended to use representatives for `Eloquent` models, for example:

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

You can record a representative:

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

Use on the screen will be as follows:

```php
use Orchid\Screen\Layouts\Persona;

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
        new Persona('employee'),
    ];
}
```


## Facepile

Shows a list of avatars in horizontal view. Each circle represents a person. Use this `layout` when displaying shared access to a specific view, file or task.

![facepile](/img/layouts/facepile.png)

`Facepile` accepts a set of objects that implement the `Personable` interface.
 
> This example uses [presenters](/en/docs/presenters), it is recommended that you familiarize yourself with them.
 
 
Instead of creating a separate class, it is recommended to use representatives for `Eloquent` models, for example:

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

You can record a presenter:

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

Use on the screen will be as follows:

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
