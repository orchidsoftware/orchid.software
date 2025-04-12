---
title: Directory Structure
description: Discover the flexible directory structure of the Orchid package and unlock your creative potential. Customize your application's organization and embrace a tailored approach. Learn more about default directories and how to create your unique custom directories to align with your specific application needs
---

The default structure is intended to provide universal applications. But you are free to organize your application however you like.
Laravel and Orchid imposes almost no restrictions on where any given class is located - as long as Composer can autoload the class.


## Default Directories

Upon installing the Orchid package, you will find the following directories within your application's `app` directory:


```bash
app
└── Orchid
    ├── Filters
    ├── Layouts
    ├── Presenters
    ├── Screens
    └── PlatformProvider.php
```

In this structure, the Orchid directory serves as the core of package, containing several subdirectories:

  - `Filters`: Store your custom filters in this directory. Filters allow you to modify and refine your data before presentation or storage. They act as gatekeepers, ensuring data integrity and enhancing the quality of your application's output.


  - `Layouts`: Craft layout files in this directory to define the structure, appearance, and organization of your application's pages. Layouts promote consistency and maintainability in presenting the visual elements of your web application.


  - `Presenters`: Here, you can create presenter classes that transform raw data into a suitable format for display. Presenters promote code reusability and encapsulate data processing logic, resulting in cleaner and more expressive code.


  - `Screens`: This directory contains files that define the user interface and functionality of individual pages, serving as the building blocks of your application. Using screens enables a modular and component-based development approach.


  - `PlatformProvider.php`: This essential file acts as a service provider, seamlessly integrating the Orchid package with your Laravel application. It serves as a bridge that allows configuration and extension of the Orchid package's functionalities within your Laravel application.

## Custom Directories

The Orchid package encourages developers to embrace their creativity and add custom directories as needed.
For example, you can enrich your application by including a directory like `Fields` within the `app/Orchid` directory.
This flexibility allows you to tailor the structure to align with the specific requirements of your application. 
Feel free to unleash your creativity and create directories that resonate with your application's unique needs.
