---
title: Presenters
description: The presenter is a class that wraps an object in order to add functionality to it.
---

The presenter is a class that wraps an object in order to add functionality to it.

Let's say we have a "Client" model:
```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
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

class ClientPresenter extends Presenter
{
    public function fullName(): string
    {
        return $this->entity->firstName . ' ' . $this->entity->lastName;
    }
}
```

After that, we can use it as follows:

```php
use App\Client;
use App\Presenters\ClientPresenter;

$client = new Client([
        'fistName' => 'Alexandr',
        'lastName' => 'Chernyaev'
    ]);
    
$presenter = new ClientPresenter($client);

$presenter->fullName();
```

> **Note** that the representative receives the `firstName` and `lastName` properties of the model because it does not have these properties.

Usually, there is no need to create and transfer a representative each time separately, for this, we indicate this creation in the model:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\ClientPresenter;

class Client extends Model
{
    protected $fillable = [
        'firstName',
        'lastName'
    ];
    
    public function presenter(): ClientPresenter
    {
        return new ClientPresenter($this);
    }
}
```

> **Note.** Many platform functions expect a representative in the `presenter` method.


Now its use is becoming easier:

```php
use App\Client;

$client = Client::findOrFail(1)->presenter()->fullName();
```

If you need to get a list of representatives, the best option would be to use collection methods, for example:

```php
use App\Client;

$clients = Client::limit(10)->get()->map->presenter();

foreach($clients as $client)
{
    $client->fullName();
}
```
Using representatives for models is a common practice of automatically displaying data for `Layouts`.
