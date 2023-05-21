---
title: Icons
description: Learn how to use and implement SVG icons in your Laravel Orchid projects with the detailed documentation on the "SVG Icons" page. Discover best practices and troubleshooting tips for adding custom SVG icons to your application.
---

The package comes with a set of icons that can be found on the [Bootstrap Icons](https://icons.getbootstrap.com/). 
These icons are prefixed with `bs.*` which is used as a prefix to identify the icons in your code.


## Custom Icons

In order to include an icon from a popular icon set such as Font Awesome, you can create a new directory for storing the icons. For example, you can create a new `icons` directory and a `fontawesome` subdirectory in your `resources` folder:

```bash
resources
  - css 
  - icons
      -- fontawesome 
  - js
  - lang
  - views
```

Once you have created the new directory, you can download the appropriate icons and place them in the new directory. For example, you can download the [notebook icon](https://github.com/FortAwesome/Font-Awesome/blob/ce084cb3463f15fd6b001eb70622d00a0e43c56c/svgs/solid/address-book.svg) and place it in the `fontawesome` subdirectory.


Next, you need to configure the package to search for icons in the new directory. You can do this by editing the `config/platform.php` configuration file:


```php
'icons' => [
    // ...
    'fa' => resource_path('icons/fontawesome')
],
```

In the example above, we have declared the prefix "fa" and the directory where the icons are located.

In order to display the icons in the package's components, you only need to pass the prefix and the icon's name. For example, the icon definition in a menu would look like this:

```php
Menu::make('Example of custom icons')
    ->icon('fa.address-book')
    ->url('https://orchid.software');
```

You can also use the icons outside of the admin panel by [using the Blade component](https://github.com/orchidsoftware/blade-icons).
