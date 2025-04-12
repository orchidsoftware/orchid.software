---
title: Контроллеры
description: Использование контроллеров в приложении
---


Обычно нет необходимости создавать собственные контроллеры, чтобы делать что-либо за рамками пакета, поскольку вы можете размещать [ свои представления на экране](/ru/docs/custom-template/#views), независимо от того, насколько они сложны.

Но если, например, у вас уже есть реализация админ-панели и у вас уже есть много своих контроллеров, то переписывать рабочий код совсем не обязательно. Выполнив шаги ниже, вы поймете, как отображать их в интерфейсе Orchid. В конечном итоге это сократит время перехода и позволит вам обновляться небольшими шагами.



Для создания нового контроллера необходимо выполнить команду `make:controller`:

```php
php artisan make:controller OrchidController
```

В директории `app/Http/Controllers` будет создан новый класс, изменим его:

```php
namespace App\Http\Controllers;

class OrchidController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('custom');
    }
}

```

Метод `index` возвращает шаблон приложения, именно в нём мы будем визуализировать всю стилистику пакета:

```php
@extends('platform::dashboard')

@section('title','title')
@section('description', 'description')

@section('navbar')
    <div class="text-center">
        Navbar
    </div>
@stop

@section('content')
    <div class="text-center mt-5 mb-5">
        <h1>Content</h1>
    </div>
@stop
```

Созданный контроллер необходимо объявить в файле маршрута, например, в `routes/platform`,
чтобы на него распространялись общие правила, такие как авторизация.

```php
use App\Http\Controllers\OrchidController;

Route::get('custom', [OrchidController::class, 'index']);
```
