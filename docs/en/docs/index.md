---
title: Documentation
description: Learn about Laravel Orchid, the open-source package for accelerating the development of administration-style applications. Explore the documentation for features like permission management, notifications, attachments, form builder, charts, configuration, controllers, custom templates, display elements, form elements, Eloquent filters, global search with Scout, layers for grouping, and using icons and SVG icons in your project.
---

## Introduction to Laravel Orchid

**Laravel Orchid** is an open-source package (MIT license) for accelerating the development and creation of administration-style applications. It abstracts typical business application templates so developers can quickly implement beautiful and elegant interfaces with little effort.

Some features:

- **Form builder** - no need to describe HTML fields of the same type each time.
- **Screen** - a comfortable balance between CRUD generation and tedious coding.
- **Fields** - over 40 varieties.
- **Permissions** - offers convenient management in development and support.
- Menus, charts, notifications, etc.


Because it is delivered as a Laravel package, it interacts well with other components and can serve as a base for applications like a content management system.


> Note: This documentation covers the use of the Laravel Orchid package, but does not provide an introduction to the Laravel framework. If you are new to Laravel, it is recommended that you first read through the [Laravel documentation](https://laravel.com/docs/).


## What Orchid is not

However, it is important to note that Laravel Orchid is not a "turnkey" solution. It is not intended to be a simple, plug-and-play platform that can be used by anyone with little or no programming experience. Instead, it is designed for developers who have a strong understanding of programming concepts and are comfortable working with complex systems.

## Looking for something simpler?


If you're looking for an easy way to create simple applications with minimal code, Laravel Orchid's **CRUD** feature may be right for you. It provides a straightforward syntax that allows you to build basic applications with little effort. To get started, check out the [CRUD section](https://orchid.software/en/docs/packages/crud/#introduction).


## Migrating to Laravel Orchid


If you already have an admin panel based on `Blade` templates, you don't have to rewrite everything at once to use Laravel Orchid. You can gradually transition to using Orchid by [connecting old controllers](https://orchid.software/en/docs/controllers) and incorporating Orchid's features into your existing application.


## What is the difference between other packages?

The Laravel ecosystem is rich with different admin panels.
You may have already solved your problems with Nova, Voyager, BackPack, QuickAdminPanel or similar.
In doing so, you were guided by the desire to find out if the platform can simplify and improve your work.
We hope that we can answer this question.

All the previous packages were developed to simplify the work with the CRUD database, and they can be divided into several methods:

- **Scaffolding** - The scaffolding method consists in creating physical files according to certain specifications, and thus it's the fastest at the initial stage of application development. As a rule, developers delete such packages after they age, as they cannot update the files with manual changes for updated criteria.

- **Visual programming** - is a method where the developer drags or selects prepared objects and thus creates the application instead of writing program code. This view is based on the assumption that most programs are simple procedural flows. However, once a program becomes more than a fairly trivial example, its complexity will soon trouble the inexperienced programmer.

- **One class** - a method that invites the developer to describe all necessary actions in a class bound to the Eloquent model. But let's assume that we're trying to go beyond the scope of a CRUD application. In this case, libraries concentrated in such a paradigm won't help us because we're not working with this class.

Laravel Orchid takes a different approach. It is designed to be helpful at any stage of development, not just at the beginning, and it can grow with your application as it becomes more complex. It doesn't rely on visual programming, so you'll need to write code with a keyboard rather than drag and drop objects. And instead of a single class, it provides a range of small, reusable components that can be combined in various ways to build a wide range of applications.


## What is rapid development?

A classic web application is a subsystem with a common three-tier architecture, which comprises:

- **Presentation level** - a graphical interface presented to the user (browser), including scripts, styles, and other resources.

- **The level of applied logic** - in our cases, this framework is the link where most business logic is concentrated, works with the database (Eloquent), sending resources, and various processing.

- **Level of resource management** - We implement data storage using database management systems (MySQL, PostgreSQL, Microsoft SQL Server, SQLite).

 
![Architecture](/img/scheme/architecture.jpg)

It reduces development time, which is directly related to the distribution of responsibilities between levels. This is especially noticeable when it's necessary to create auxiliary code. At the same time, most of the useful work is done by the application layer.

As various examples of conflicting tasks can be cited:
- Generation of "HTML" using the "Blade" template engine or the "Vue" framework.
- Use of ORM or stored procedures.

Depending on the choice of decisions, responsibilities are assigned, each decision having both advantages and disadvantages.

Similarly, the platform assigns new responsibilities to the application layer for managing the mapping and bridging of data.

```php
Classic          |   Orchid
├── Route        |   ├── Route   
├── Model        |   ├── Model 
├── Controller   |   └── Screen
└── View         |
    ├── HTML     |
    ├── CSS      |
    └── JS       |
```


## How to get a Orchid?

Laravel Orchid is freely distributed via the Internet, [source codes](https://github.com/orchidsoftware/platform), and [release information](https://github.com/orchidsoftware/platform/releases) published on GitHub. The [installation guide](/en/docs/installation/) contains detailed instructions.

> To suggest improvements to this tutorial, [create a new issue](https://github.com/orchidsoftware/orchid.software/issues).
If you have questions or find a documentation error, please show the chapter and accompanying the text to indicate an error.


## Is something wrong?

If our documentation is missing something, please feel free to contribute!
You can click on the **Suggest Edits** link on the top right side of any documentation page.
