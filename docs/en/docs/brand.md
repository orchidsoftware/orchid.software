---
title: Branding
description: Learn how to customize the look and feel of your Laravel Orchid application with the Branding documentation page. Discover how to set your own logo, choose custom colors, and more to make your application truly your own.
---

There are times when you want the visual style of the platform to match your brand.
After installation, two settings are provided that are located in `config/platform.php`:

```php
'template' => [
    'header' => null,
    'footer' => null,
],
```

To change the page header or footer, you must specify your own `blade` templates.


## Change Logo and Name

Create a new directory in the `brand` template section and the` header.blade.php` file.
Then the full path will look like `/resources/views/brand/header.blade.php`.

```php
resources          
└── views
    └── brand
        └── header.blade.php
```

 
Make changes to the file just created:

```php
@push('head')
    <link
        href="/favicon.ico"
        id="favicon"
        rel="icon"
    >
@endpush

<div class="h2 d-flex align-items-center">
    @auth
        <x-orchid-icon path="bs.house" class="d-inline d-xl-none"/>
    @endauth

    <p class="my-0 {{ auth()->check() ? 'd-none d-xl-block' : '' }}">
        {{ config('app.name') }}
    </p>
</div>
```
 
In order for the created template to be used instead of the standard one, you must specify it in the configuration file,
just as if passing an argument in the `view('brand.header')` helper:

  
```php
'template' => [
    'header' => 'brand.header',
    'footer' => null,
],
```

> **Note.** The configuration file may be cached, and the changes will not take effect until the `php artisan config:clear` command is executed


In the same way, we can change the bottom of the page, again create a new file `/resources/views/brand/footer.blade.php` with the following contents:


```php
<p class="small m-n">
    © Copyright {{date('Y')}} 
    <a href="{{ config('app.url') }}" target="_blank">
        {{ config('app.name') }}
    </a>
</p>
```

Also making changes to the configuration file:

```php
'template' => [
    'header' => 'brand.header',
    'footer' => 'brand.footer',
],
```

> **Note**. If you want the text or images to be different for the login and panel pages, you can use [Authentication Directives](https://laravel.com/docs/blade#authentication-directives).
