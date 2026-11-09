---
title: Presenters
description: Format model values with a presenter and declare it through UsePresenter.
---

A presenter formats an object's values for display. Put display logic in a class that extends
`Orchid\Presenter\Presenter`. The wrapped object is available as `$this->entity`.

## Create a presenter

Generate a presenter with `php artisan orchid:presenter CustomerPresenter`, then define the values your views need:

```php
namespace App\Orchid\Presenters;

use Orchid\Presenter\Presenter;

class CustomerPresenter extends Presenter
{
    public function fullName(): string
    {
        return $this->entity->first_name.' '.$this->entity->last_name;
    }
}
```

## Assign the presenter to a model

Add `Presentable` and declare the presenter with `UsePresenter`:

```php
namespace App\Models;

use App\Orchid\Presenters\CustomerPresenter;
use Illuminate\Database\Eloquent\Model;
use Orchid\Presenter\Presentable;
use Orchid\Presenter\UsePresenter;

#[UsePresenter(CustomerPresenter::class)]
class Customer extends Model
{
    use Presentable;
}
```

The model and its descendants use this presenter unless a child declares its own `UsePresenter` attribute.

```php
$customer = Customer::findOrFail(1);
$presenter = $customer->presenter();

$presenter->fullName();
$presenter->fullName;
$presenter->email;
```

Property access calls a same-named presenter method first, then reads the wrapped object's property.
The base presenter does not forward arbitrary method calls to the model.

## Choose a presenter for one call

```php
$presenter = $customer->presenter(CompactCustomerPresenter::class);
```

This override applies to that call. It does not change the model's default presenter.
Without a class attribute or an explicit override, `presenter()` throws a `RuntimeException`.

## Present a collection

```php
$customers = Customer::query()->limit(10)->get()->map->presenter();
```

You can also wrap any object directly with `new CustomerPresenter($object)`.
For global search, implement the [search presenter contract](/en/docs/global-search).

## Upgrade from 14.x

Change imports from `Orchid\Support\Presenter` to `Orchid\Presenter\Presenter`.
Replace a model's presenter factory method with `Presentable` and `UsePresenter`.
Review presenters that relied on forwarding model method calls or old contracts.
