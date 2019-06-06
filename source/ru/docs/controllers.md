---
title: Контроллеры
description: Использование контроллеров в приложении
extends: _layouts.documentation.ru
section: main
---


При разработке могут возникать различные ситуации в том числе необходимость встраивать контроллеры в работу пакета. 

## Пример
Для создания нового контроллера необходимо выполнить команду `make:controller`:

```php
php artisan make:controller CustomOrchidController
```

В директории `app/Http/Controllers` будет создан новый класс, изменим его:

```php
<?php

namespace App\Http\Controllers;

class CustomOrchidController extends Controller
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

Созданный контроллер необходимо так же обьявить в файле маршрута, например в `routes/platform`,
что бы на него распространялись общие правила, такие как авторизация.

```php
Route::get('custom', [\App\Http\Controllers\CustomOrchidController::class, 'index']);
```
