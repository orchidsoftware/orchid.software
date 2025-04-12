---
title: Authentication
description: Modify the login form, configure user portals, and personalize the authentication process effortlessly. 
---


## Guard

Orchid provides support for different types of users (e.g. customers and sellers) who have their own authentication portals. To configure Orchid to work with a specific type of user, you can change the value of the `guard` option in the `config/platform.php` configuration file:

```php
'guard' => 'sellers',
```

Keep in mind that the value of `guard` must be one of the authentication guards listed in Laravel's [authentication configuration](https://github.com/laravel/laravel/blob/9.x/config/auth.php).

## Customizing the Authentication Process

The package does not provide any specific implementation of user authentication. The needs of different applications can vary significantly, from using email or phone numbers for authentication to sending one-time passwords by email.

To customize the authentication process, you can write your own controllers following the guidelines in the [Laravel documentation](https://laravel.com/docs/authentication). Before doing so, it is recommended to disable the built-in login page provided by Orchid. To do this, set the auth option in the config/platform.php configuration file to `false`:

```php
'auth' => false,
```

This will remove the availability of the built-in authorization routes and allow you to write your own

> **Note:** The built-in login page provided by Orchid has only the most basic functionality, with email and password fields. If you need more advanced features such as password recovery, registration, and 2FA with time-based one-time password algorithms, consider using the [Fortify theme](https://github.com/orchidsoftware/fortify), which is based on [Laravel Fortify](https://laravel.com/docs/fortify).
