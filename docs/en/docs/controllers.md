---
title: Controllers
description: Learn how to use Laravel Orchid to create custom controllers for your administration-style applications. Explore best practices for organizing and managing your controllers for optimal performance and scalability.
---


There is usually no need to create custom controllers to do anything outside the package's scope since you can place [your views on the screen](/en/docs/custom-template/#views), no matter how complex they are.

But if, for example, you already have an implementation of the admin panel and you already have many of your controllers, then rewriting the working code is not at all necessary. By following the steps below, you will understand how to show them in the Orchid interface. Ultimately, this will shorten the transition time and allow you to upgrade in small increments.

To create a new controller, use the `make:controller` Artisan command:

```php
php artisan make:controller OrchidController
```

This will generate a new class in the `app/Http/Controllers` directory. You can then modify the class as needed:

```php
namespace App\Http\Controllers;

use Illuminate\View\View;

class OrchidController extends Controller
{
    public function index(): View
    {
        return view('custom');
    }
}

```

The `index` method of your controller should return a view template, which will be rendered using the Orchid package's style. Here is an example of a view template:

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

To make the controller accessible through the Orchid interface, you need to declare a route for it in the route file (e.g. `routes/platform`). This will ensure that common rules such as authorization apply to the controller.

Here is an example of how to declare a route for the `OrchidController`:

```php
use App\Http\Controllers\OrchidController;

Route::get('custom', [OrchidController::class, 'index']);
```

You can now access your custom controller by visiting the custom route in your Orchid app.
