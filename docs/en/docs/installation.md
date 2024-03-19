---
title: Installation
description: Learn how to install and set up Laravel Orchid in your project with our comprehensive installation guide. Step-by-step instructions and helpful tips make it easy to get started with Orchid.
---


Before you can use the Laravel Orchid, you need to install it. This guide should help you perform a simple installation to start the project.

## Create a New Laravel Project

> **Note.** If you already have Laravel installation, you can skip this step.

Being a package for the framework, you must first install Laravel. This can be done using the Composer dependency management tool by running the `composer create-project` command in your terminal:

```php
composer create-project laravel/laravel orchid-project "11.*" --prefer-dist
```

Or if you would prefer Laravel Installer:

```php
composer global require laravel/installer

laravel new orchid-project
```

For more information on how to install Laravel, follow [Official Laravel Installation Guide](https://laravel.com/docs/installation).

> **Don’t you have Composer?** It’s easy to install by following the instructions on the [download page](https://getcomposer.org/download/).

It will create a new `orchid-project` directory, load the dependencies, and generate the leading directories and files you need to get started.
In other words, install your new framework project.


**Do not forget**

- Set “chmod -R o+w” rights to the `storage` and `bootstrap/cache` directories
- Edit the `.env` file

> **Note.** If you just installed Laravel, you may need to generate a key with command `php artisan key:generate`

## Add Dependency

Go to the created project directory and run the command:
```php
composer require orchid/platform
```

> **Note.** You also need to create a new database, update the `.env` file with credentials, and add your application's URL to the variable `APP_URL`.


## Package Installation

> **Note:** During the installation process, the package will overwrite the `app/Models/User` model. However, it is important to note that replacing the model is not mandatory. You have the flexibility to customize the model according to your preferences. The package automatically applies certain configurations, such as `hidden` and `casts`, to the Eloquent model.

Run the installation process by running the command:

```php
php artisan orchid:install
```

## Create an Admin User

To create a user with maximum permissions, you can run the following command with a username, email, and password:

```php
php artisan orchid:admin admin admin@admin.com password
```


## Start the Development Server

If you haven't installed a server (Nginx, Apache, etc.) to run the project, you can use the built-in server:

```php
php artisan serve
```

Open a browser and go to `http://localhost:8000/admin`. If everything works, you will see the control panel login page. Later you can stop the server by pressing `Ctrl + C` in the terminal.

> **Note.** Suppose your runtime uses a different domain (e.g., orchid.loc). In that case, the admin panel may not be available. You need to specify your domain in the configuration file `config/platform.php` or `.env` file. It allows you to make the admin panel available on another domain or subdomain, such as `platform.example.com`.


## Updating

While in the project directory, use `Composer` to update the package:

```php
composer update orchid/platform --with-dependencies
```

> **Note.** You can also update all your dependencies listed in the `composer.json` file by running `composer update`.


After updating to a new release, you should be sure to update JavaScript and CSS assets using `orchid:publish` and clear any cached views with `view:clear`. It will ensure the newly-updated version is using the latest versions.

```bash
php artisan orchid:publish
php artisan view:clear
```

## Keeping Assets Updated

To make sure that your assets are promptly updated whenever a new version is downloaded, you can easily add a Composer hook to your project's `composer.json` file.
This will automatically publish the latest assets for you:

```json
"scripts": {
    "post-update-cmd": [
      "@php artisan orchid:publish --ansi"
  ]
}
```

Once you have added this hook, you can rest assured that your assets will always be up-to-date and functioning properly.
And if you ever want to verify that the assets are indeed current, you can simply use the `artisan` console command to check:

```php
php artisan about
```

This command will provide you with an importance of information, including some of the details about the package itself.
It's  ensuring that your environment is correctly configured and running as expected.


> **Problems encountered during installation?** It is possible that someone already had this problem https://github.com/orchidsoftware/platform/issues. If not, you can send a message or ask for [help](https://github.com/orchidsoftware/platform/issues/new).



## What to Do Next?

A newly installed package already has several screens that show various input fields, masks, states, as well as some interface layout. You can try them out or go directly to the step by step examples of working with the package on the [“Quick Start” page](/en/docs/quickstart) or read the [documentation](/en/docs/screens).
