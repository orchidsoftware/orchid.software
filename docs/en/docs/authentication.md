---
title: Authentication
description: Changing the Laravel Orchid login form.
---


## Guard


When your application needs to provide different types of users, e.g. customers and sellers who have their authentication portals,
then the package will support you. You can use a configuration file to configure Orchid to work with a specific type. 
To do this, change the value of `guard` in the file `config/platform.php`:

```php
'guard' => 'sellers',
```

Note that `sellers` must already be available in Laravel's [authentication guards list](https://github.com/laravel/laravel/blob/9.x/config/auth.php).


## Personalization

User authorization issues are outside the scope of the package. Because the needs can be completely different, from using email or the user's phone.
Using one-time passwords and sending them by email, etc.

You can write your authorization controllers following the [Laravel documentation](https://laravel.com/docs/authentication), but before you do that,
it's highly advisable to disable the orchid login page. To do this, go to the `config/platform.php` configuration file and set the value for `auth`:

```php
'auth' => false,
```

This will completely remove the availability of the built-in authorization routes and you can write your own.    


> **Note.**  By default, the package has only the simplest login form with only email and password fields. 
If you need features like recovery, registration, and 2FA with a one-time password algorithm based on time, consider using the [Fortify theme](https://github.com/orchidsoftware/fortify),
 which relies entirely on [Laravel Fortify](https://laravel.com/docs/fortify).
