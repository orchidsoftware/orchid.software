---
title: How to show the admin panel on the home page?
extends: _layouts.page
section: main
---

The path to the Orchid application is set by changing a parameter in the configuration file located at the following path: `config/platform.php`.

By default, the application is located at `/admin`, but you can change this in the following block:

```php
/*
|------------------------------------------------------------------
| Route Prefixes
|------------------------------------------------------------------
|
| This prefix method can be used for the prefix of each
| route in the administration panel. Feel free to
| change this path to anything you like.
|
| Example: '/', '/admin', '/panel'
|
*/

'prefix' => env('DASHBOARD_PREFIX', '/admin'),
```

Change this address to your liking. For example, `/` - will mean no prefix, but make sure there are no other declared routes with the same parameter.

Please note that after updating the configuration files, you may need to clear the application cache using the artisan commands:

```php
php artisan config:clear
php artisan route:clear
```
