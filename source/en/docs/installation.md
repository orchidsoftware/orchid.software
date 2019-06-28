---
title: Platform installation
description: This getting started guide will help you get started using ORCHID.
extends: _layouts.documentation.en
section: main
---


Before you can use the platform, you will need to install it. This guide will help you perform a simple installation to start a project.


## Create project

Being a package for the framework, you must first install it. This can be done using the Composer dependency management tool by running the 'composer create-project' command in your terminal:

```php
$ composer create-project laravel/laravel orchid-project "5.8.*" --prefer-dist
```

> **You don’t have Composer?** It’s easy to install by following the instructions on the [download page](https://getcomposer.org/download/).


This will create a new `orchid-project` directory, load the dependencies into it, and generate the main directories and files that you will need to get started.
In other words, install your new framework project.

**Do not forget**
- Set “chmod -R o + w” rights to the `storage` and` bootstrap/cache` directories
- Edit the `.env` file

## Add dependency

Go to the created project directory and run the command:
```php
$ composer require orchid/platform
```

> **Note.** If you installed Laravel otherwise, you may need to generate a key
using the command `php artisan key: generate`

## Platform installation

> ** Note. ** You also need to create a new database and update the `.env` file with credentials and add the URL of your application to the variable` APP_URL`.

Run the installation process by running the command:

```php
php artisan orchid:install
```

## Create user

To create a user with maximum permissions for the current moment, you need to execute the command
username, email and password:

```php
php artisan orchid:admin admin admin@admin.com password
```

## Start local server

To run the project, you can use the built-in server:
```php
php artisan serve
```

Open a browser and go to `http://localhost:8000/dashboard`. If everything works, you will see the control panel login page. Later, when you are done, stop the server by pressing `Ctrl + C` in the terminal being used.

> **Note.** If the runtime used is configured for a different domain (for example, orchid.loc),
  then the admin panel will not be available, you need to specify it in the configuration file `config/platform.php`
  or in `.env`. This allows you to make the admin panel available on another domain or subdomain, such as `platform.example.com`. 
 
## Static Resource Publishing

By default, static files (css / js) are distributed through application routes, this is the best balance between configuration and change tracking, but you can specify to use web servers for distribution, you need to execute a command that creates a symbolic link in a public directory (Please use it only if your web server is having difficulty):

 ```php
php artisan orchid:link
```
 
> **Problems encountered during installation?** It is possible that someone already had this problem https://github.com/orchidsoftware/platform/issues. If not, you can send a message or ask for [help](https://github.com/orchidsoftware/platform/issues/new).

## What to do next?

Depending on how new you are, you can try a step-by-step example of working with the package on the [“Quick Start” page](/en/docs/quickstart) or simply dive into [documentation](/en/docs/screens).