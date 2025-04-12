---
title: Presenters
description: Learn how to use Laravel Orchid's Presenters to format your data for display on your application's views. With Presenters, you can easily customize the appearance of your data, making your application's user interface more consistent and user-friendly.
---

Presenters are classes that wrap objects and provide additional functionality to them. 
In Orchid, presenters are used to format and present data consistently and help keep the views clean and organized. 
You can move all of the formatting and presentation logic into the presenter class, which maintains separation of concerns.


## Creating A Presenter

In this example, let’s say we have a "Customer" model:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstName',
        'lastName'
    ];
}
```
Before an instance of this class is wrapped in a representative, you must create it:

```php
namespace App\Presenters;

use Orchid\Support\Presenter;

class CustomerPresenter extends Presenter
{
    public function fullName(): string
    {
        return sprintf('%s %s',
            $this->entity->firstName,
            $this->entity->lastName
        );
    }
}
```

After that, we can use it as follows:

```php
use App\Customer;
use App\Presenters\CustomerPresenter;

$customer = new Customer([
    'fistName' => 'Alexandr',
    'lastName' => 'Chernyaev'
]);
    
$presenter = new CustomerPresenter($customer);

$presenter->fullName();
```

> **Note** that the representative receives the `firstName` and `lastName` properties of the model because it does not have these properties.

Usually, there is no need to create and transfer a representative each time separately, for this, we indicate this creation in the model:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\CustomerPresenter;

class Customer extends Model
{
    protected $fillable = [
        'firstName',
        'lastName'
    ];
    
    public function presenter(): CustomerPresenter
    {
        return new CustomerPresenter($this);
    }
}
```

> **Note.** Many platform functions expect a representative in the `presenter` method.


Now its use is becoming easier:

```php
use App\Customer;

$customer = Customer::findOrFail(1)->presenter()->fullName();
```

## Using Presenters with Collections

If you want to get a list of presenters, use collection methods, for example:

```php
use App\Customer;

$customers = Customer::limit(10)->get()->map->presenter();

foreach($customers as $customer)
{
    $customer->fullName();
}
```

Using representatives for models is a common practice of automatically displaying data for `Layouts`.
