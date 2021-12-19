---
title: Представители
description: Представитель (Presenter) - это класс, который оборачивает другой объект с целью добавления в него функционала.
---

Представитель (Presenter) - это класс, который оборачивает объект с целью добавления в него функционала. 

Допустим у нас есть модель клиента:
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

Прежде чем экземпляр этого класса будет обёрнут в представителя, необходимо создать его:

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

После этого мы можем использовать его следующим образом:

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

> **Заметьте**, что представитель получает свойства `firstName` и `lastName` у модели, потому что этих свойств у него нет.

Обычно нет необходимости создавать и передавать представителя каждый раз отдельно, поэтому укажем это создание в модели:

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

> **Примечание.** Многие функции платформы ожидают представителя в методе `presenter`, но вам необязательно использовать именно его.


Теперь его использование становится проще:

```php
use App\Client;

$client = Client::findOrFail(1)->presenter()->fullName();
```

Если необходимо получить список представителей, лучшим вариантом будет использование методов коллекций, например:

```php
use App\Client;

$clients = Client::limit(10)->get()->map->presenter();

foreach($clients as $client)
{
    $client->fullName();
}
```

Использование представителей для моделей - распространённая практика автоматического отображения данных для `Layouts`.
