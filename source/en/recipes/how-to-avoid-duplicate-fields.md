---
title: Do not repeat the definition of fields.
description: You don't have to declare all fields every time
extends: _layouts.page
section: main
---

Sometimes I get tired of specifying many fields to fill, especially when the same fields are repeated. [Collections](https://laravel.com/docs/collections) can come to our aid.


Let's try to consider an example:

```php
namespace App\Orchid\Layouts\User;

use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;

class ClientEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('client.name')
                ->type('text')
                ->required()
                ->title('Name')
                ->placeholder('Name'),

            Input::make('client.email')
                ->type('email')
                ->required()
                ->title('Email')
                ->placeholder('Email'),
        ];
    }
}
```


The method for defining fields must return a list of them, and so on every time. Why don't we define it just once, by analogy with the model?

```php
namespace App\Models;

use Orchid\Screen\Fields\Input;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public static function fields()
    {
        return collect([
            'name' => Input::make('client.name')
                ->type('text')
                ->required()
                ->title('Name')
                ->placeholder('Name'),
                
            'email' => Input::make('client.email')
                ->type('email')
                ->required()
                ->title('Email')
                ->placeholder('Email'),
        ]);
    }
}
```


We have created a static method that will return us a collection of our fields, but this will help us with the addition of keys. In cases where we need to display only a part of the properties, we will use the collections' capabilities.

All available fields:

```php
namespace App\Orchid\Layouts\User;

use App\Models\Client;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;

class ClientEditLayout extends Rows
{
    public function fields(): array
    {
        return Client::fields()->all();
    }
}
```


Return only the specified ones:

```php
namespace App\Orchid\Layouts\User;

use App\Models\Client;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;

class ClientEditLayout extends Rows
{
    public function fields(): array
    {
        return Client::fields()->only([
          'email',
        ])->toArray();
    }
}
```


Return everything except the specified ones:


```php
namespace App\Orchid\Layouts\User;

use App\Models\Client;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;

class ClientEditLayout extends Rows
{
    public function fields(): array
    {
        return Client::fields()->except([
          'email',
        ])->toArray();
    }
}
```


And so on, such simple examples may not duplicate field descriptions every time it is required.
