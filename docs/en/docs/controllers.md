---
title: Controllers
description: Use of controllers in the application
---


There is usually no need to create custom controllers to do anything outside the package's scope since you can place [your views on the screen](/en/docs/custom-template/#views), no matter how complex they are.

But if, for example, you already have a realization of the admin panel and you already have a lot of your controllers, then it is not at all necessary to rewrite the finished code. By following the steps below, you will understand how the controllers in the package work. Ultimately, this will save transition time and allow you to upgrade in small steps.


To create a new controller, you must run the command `make:controller`:

```php
php artisan make:controller CustomOrchidController
```

In the `app/Http/Controllers` directory, a new class will be created, change it:

```php
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

The `index` method returns the application template, in which we will visualize the entire package style:

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

The created controller must be declared in the route file, for example, in `routes/platform`,
so that common rules apply to it, such as authorization.

```php
Route::get('custom', [\App\Http\Controllers\CustomOrchidController::class, 'index']);
```
