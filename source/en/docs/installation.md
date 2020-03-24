---
title: Platform installation
description: This getting started guide will help you get started using ORCHID.
extends: _layouts.documentation
section: main
---


Before you can use the platform you need install it. This guide should help you perform a simple installation to start the project.


## Create project

> **Note.** If you already have Laravel installation you can skip this step.

Being a package for the framework you must first install Laravel. This can be done using the Composer dependency management tool by running the `composer create-project` command in your terminal:

```php
$ composer create-project laravel/laravel orchid-project "7.*" --prefer-dist
```

For more information how to install Laravel follow [Official Laravel Installation Guide](https://laravel.com/docs/installation).

> **You don’t have Composer?** It’s easy to install by following the instructions on the [download page](https://getcomposer.org/download/).

This will create a new `orchid-project` directory, load the dependencies and generate the main directories and files that you will need to get started.
In other words, install your new framework project.

**Do not forget**
- Set “chmod -R o + w” rights to the `storage` and `bootstrap/cache` directories
- Edit the `.env` file

## Add dependency

Go to the created project directory and run the command:
```php
$ composer require orchid/platform
```

> **Note.** If you just installed Laravel you may need generate a key with command `php artisan key:generate`

## Platform installation

> ** Note. ** You also need to create a new database and update the `.env` file with credentials and add the URL of your application to the variable `APP_URL`.

Run the installation process by running the command:

```php
php artisan orchid:install
```

## Create user

To create a user with maximum permissions you can run the following command with a username, email and password:

```php
php artisan orchid:admin admin admin@admin.com password
```


## Start local server

If you haven't installed server (nginx, apache, etc) to run the project you can use the built-in server:
```php
php artisan serve
```

Open a browser and go to `http://localhost:8000/dashboard`. If everything works you will see the control panel login page. Later you can stop the server by pressing `Ctrl + C` in the terminal.

> **Note.** If your runtime uses a different domain (eg. orchid.loc)
  the admin panel may not be available, and you need to specify your domain in the configuration file `config/platform.php`
  or in `.env` file. This allows you to make the admin panel available on another domain or subdomain, such as `platform.example.com`. 
 
## Publishing resources

By default, static files (css/js) are delivering through application routes: this is the best balance between a configuration and change tracking, but you can specify to use web servers for distribution, you need to execute a command that creates a symbolic link in a public directory (Please use it only if your web server is having troubles):

 ```php
php artisan orchid:link
```
 
> **Problems encountered during installation?** It is possible that someone already had this problem https://github.com/orchidsoftware/platform/issues. If not, you can send a message or ask for [help](https://github.com/orchidsoftware/platform/issues/new).

## What to do next?

Now you can try the step-by-step example of working with the package on the [“Quick Start” page](/en/docs/quickstart) or read the [documentation](/en/docs/screens).
