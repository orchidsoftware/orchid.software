---
title: Persona
extends: _layouts.documentation
section: main
lang: en
---

A person is used to visualize an avatar and describe a person.

![persona](/assets/img/layouts/persona.png)

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
