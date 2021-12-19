---
title: Icons
description:
---

## Custom Icons

Let's say we want to include an icon from the popular Font Awesome. To do this, select a suitable storage directory, for example, create a new `icons` directory and a `fontawesome` subdirectory:

```bash
resources
  - css 
  - icons
      -- fontawesome 
  - js
  - lang
  - views
```

Load the appropriate icons into the new directory, for example, this [notebook icon](https://github.com/FortAwesome/Font-Awesome/blob/ce084cb3463f15fd6b001eb70622d00a0e43c56c/svgs/solid/address-book.svg). Then we will indicate to the package the directory in which we need to search for our images, for this we will edit the configuration file `config/platform.php`:


```php
'icons' => [
    'fa' => resource_path('icons/fontawesome')
],
```

All we have done here is declare the prefix by which we will refer to fa and the directory where the files are located.
To display in the components of the package, you only need to pass the prefix + name, for example, the definition of the icon in the menu will look like this:

```php
Menu::make('Example of custom icons')
    ->icon('fa.address-book')
    ->url(#);
```

You can also use the icons outside of the admin panel [using the Blade component](https://github.com/orchidsoftware/blade-icons).
