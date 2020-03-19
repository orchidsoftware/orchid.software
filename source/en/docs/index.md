---
title: Documentation
description: 
extends: _layouts.documentation.en
section: main
---

## Introduction

**ORCHID** is an open source tool (MIT license) to speed up development and create applications in the style of administration. It abstracts common business application templates so that developers can easily implement beautiful and elegant interfaces with little effort.

Some features:

- **Form Builder** - no need to describe HTML fields of the same type every time.
- **Screens** - a good balance between CRUD generation and manual writing.
- **Fields** - over 40 types.
- **Permissions** - offers convenient management in development and support.
- Menus, graphics, settings, notifications, etc.


Delivered as a Laravel package and interacted with other components. It can act as a basis for back-office based applications, administration panels, or as a content management system.

> **Note!** The manual contains information on using the package, but does not explain the use of the framework. It is strongly recommended you read the [Laravel documentation](https://laravel.com/docs/).


## What is the difference between other packages?

The Laravel ecosystem is rich in various admin panels. Maybe,
You already solve your problems using Nova, Voyager, BackPack, QuickAdminPanel or the like,
and here you were led by a desire to find out if the platform will simplify and improve your work.
We hope to answer this question.

All previous packages are designed to simplify CRUD database operations and
 they can be divided into several methods:

- **Scaffolding** - scaffolding method, consists in the generation of physical files
according to specified specifications, thereby being the fastest at the initial stage of application development.
As a rule, after generation, developers delete such packages, since they are not able to update
files with manual changes for updated criteria.

- **Visual programming** - a method in which the developer drags or selects pre-prepared
objects thus build the application, instead of writing program code. This view is based on the assumption that most programs are simple procedural
sequences. However, once a program becomes more than a pretty trivial example,
its complexity will soon afflict the novice programmer. Beginners find it very difficult to reason about a large codebase and bogged down in attempts to create stable and efficient large-scale software.

- **One file** - a method that invites the developer to describe all the basic actions in one single file (Resource, Section, CrudController),
which binds to the Eloquent model. This is another very good solution, but if we try to go beyond the scope of a CRUD application, then
libraries concentrated in such a paradigm will not help us, because we do not work with that single class.


Unlike scaffolding, this package will be useful at any stage of development, and not just at the beginning, remaining fast for development due to a ready-made set of components.
It does not provide visual programming, which means you need to write code on the keyboard, and not click with the mouse.
And instead of one, the main class, provides many small components for encapsulation and reuse.

## Why is rapid development?

A classic web application is a subsystem with a common three-tier architecture, which comprises:

- **Presentation level** - a graphical interface presented to the user (browser), including scripts, styles, and other resources.

- **The level of applied logic** - in our cases, this framework is the link where most business logic concentrated, work with the database (Eloquent), sending resources and various processing.

- **Level of resource management** - provides we implement data storage using database management systems (MySQL, PostgreSQL, Microsoft SQL Server, SQLite).

 
![Architecture](https://orchid.software/assets/img/scheme/architecture.jpg)

Reducing development time directly related to the distribution of responsibilities between each of the levels. This is especially noticeable when it is necessary to create auxiliary code, while it takes most of the really useful work over by the application layer.

As various examples of opposing duties can be cited:
- Generation of `HTML` with the `Blade` template engine or the `Vue` framework.
- Using ORM or stored procedures.

Depending on the choice of decisions, responsibilities will be allocated, where each decision has both advantages and disadvantages.

In the same way, the platform endows the application layer with new responsibilities for managing the mapping and bridging of data.

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

## How to get a platform?

The platform freely distributed via the Internet, [source codes](https://github.com/orchidsoftware/platform) and [release information](https://github.com/orchidsoftware/platform/releases) published on GitHub. The [installation guide](/en/docs/installation/) contains detailed instructions.

> To suggest improvements to this tutorial, [create a new issue](https://github.com/orchidsoftware/orchid.software/issues).
If you have questions or find a documentation error, please show the chapter and accompanying the text to show an error.

