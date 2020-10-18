---
title: Facepile
extends: _layouts.documentation
section: main
lang: en
---

Shows a list of avatars in horizontal view. Each circle represents a person. Use this `layout` when displaying shared access to a specific view, file or task.

![facepile](/assets/img/layouts/facepile.png)

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
