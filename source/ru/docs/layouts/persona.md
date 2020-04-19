---
title: Персона
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Персона используются для визуализации аватара и описания человека.

![persona](/assets/img/layouts/persona.png)

`Persona` принимает набор обьектов которые реализуют интерфейс `Personable`.

> В этом примере используется [представители](/ru/docs/presenters), настоятельно рекомендуеться ознакомится с ними.
 
Вместо создания отдельного класса рекомендуется использоватье представителей для `Eloquent` моделей, например:

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
