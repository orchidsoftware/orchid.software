---
title: Documentation
description: 
extends: _layouts.documentation.en
section: main
---

## Welcome

This guide contains reference information for creating business applications using the platform, while
does not explain framework documentation. If you are already familiar with it, go on to read the following chapters, otherwise
I recommend reading the “Laravel” documentation from beginning to end on [laravel.com](http://laravel.com).

> To suggest improvements to this tutorial, [create a new issue](https://github.com/orchidsoftware/orchid.software/issues).
If you have questions or find a documentation error, please indicate the chapter and accompanying text to indicate an error.

## Introduction

** ORCHID ** is a tool of accelerated development open source (MIT license ), to create applications in the style of administration. It abstracts common business application templates so that developers can easily implement beautiful and elegant interfaces with little effort.

Some features:

- **Form Builder** - no need to describe HTML fields of the same type every time.
- **Screens** - a good balance between CRUD generation and manual writing.
- **Permissions** - offers convenient management in development and support.
- Menus, graphics, settings, notifications, etc. now.


Delivered as a Laravel package and interacts with other components. It can act as a basis for backoffice-based applications, administration panels, or as a content management system.

## Why is rapid development?

A classic web application is a subsystem with a common three-tier architecture, which consists of:

- **Presentation level** - a graphical interface presented to the user (browser), including javascript scripts, styles and resources.

- **The level of applied logic** - in our cases, this framework is the link where most business logic is concentrated, work with the database (Eloquent), sending resources and various processing.

- **Level of resource management** - provides data storage, as a rule, is implemented by means of database management systems (MySQL, PostgreSQL, Microsoft SQL Server, SQLite).

 
![Architecture](https://orchid.software/assets/img/scheme/architecture.jpg)

Reducing development time is directly related to the distribution of responsibilities between each of the levels. This is especially noticeable when it is necessary to create auxiliary code, while most of the really useful work is taken over by the application layer.

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

The platform is freely distributed via the Internet, [source codes](https://github.com/orchidsoftware/platform) and [release information](https://github.com/orchidsoftware/platform/releases) published on GitHub. The [installation guide](/en/docs/installation/) contains detailed instructions.