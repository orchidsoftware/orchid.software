---
title: Icons
description: Learn how to use and implement SVG icons in your Laravel Orchid projects with the detailed documentation on the "SVG Icons" page. Discover best practices and troubleshooting tips for adding custom SVG icons to your application.
---

The package comes with a set of icons that can be found on the [Bootstrap Icons](https://icons.getbootstrap.com/). 
These icons are prefixed with `bs.*` which is used as a prefix to identify the icons in your code.

> If you're looking for a list of icons for previous versions, please visit the [Orchid Icon Pack page](/en/docs/orchid-icons).

## How to Use Icons

You can easily add icons to elements like buttons, links, or menus in your application. Here’s a simple example to help you get started:

```php
use Orchid\Screen\Actions\Menu;

Menu::make('Settings')
    ->icon('bs.gear') // Use the 'bs.' prefix for Bootstrap Icons
    ->route('platform.settings');
```

In this example, the icon `bs.gear` will show up next to the "Settings" link.

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
    // other icon configurations
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


## Using Blade Component

Icons can be easily integrated into your views using Blade components. Follow these steps to seamlessly incorporate icons in your views:

```blade
<x-orchid-icon path="fa.home" />
```
The code above renders the icon component with the specified icon path.

You can also apply additional attributes to your icon component:

```blade
<x-orchid-icon 
    path="fa.home" 
    class="icon-big" 
    width="2em" 
    height="2em" />
```

You can also use the `Blade Icon Component` outside of the admin panel by [using the Blade component](https://github.com/orchidsoftware/blade-icons).

## Server-side Rendering with Templates

In our application, we rely solely on server-side rendering, which means we don't specifically prepare icons for JavaScript control. However, it is still possible to use existing icons within JavaScript by utilizing the `<template>` tag.

To illustrate this, you can include the following code on your page:

```html
<template id="product-row">
  <tr>
    <td>{name}</td>
    <td>
      <x-orchid-icon path="minus" class="icon-minus" />
    </td>
  </tr>
</template>
```

In the corresponding JavaScript code, you can use the template to create a DOM element with the desired content. Here's an example:

```javascript
let template = document.querySelector('#product-row');

let row = template.content.querySelector('tr').cloneNode(true);

row.innerHTML = row.innerHTML.replace(/{name}/gi, "Alexandr");
```

By substituting the `{name}` placeholder with the actual content, you can dynamically generate the desired element. You can then insert this element into your page wherever you need it.
