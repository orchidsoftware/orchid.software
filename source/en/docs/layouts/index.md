---
title: Screen layouts
description: Displaying the appearance of user interface elements in the application is of great importance
extends: _layouts.documentation
section: main
lang: en
menu: layouts
---
Displaying the appearance of user interface elements in the application is of great importance, makes the application
easier to use and helps users to intuitively display screen elements to perform their tasks.

Separation of logic and presentation is one of the design principles with ORCHID.
One of the elements of the presentation are "Layouts" (layouts), which can be displayed in various variations.
If you try to explain briefly, it turns out that this is a `view` on steroids.

## Layout approach

In most cases, we use the same type of elements to form a page, for example, imagine a block that displays the name, signature and profile avatar:

```php
<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
	<span class="thumb-sm avatar m-r-xs">
        <img src="/avatar/maria.jpg" class="bg-light" alt="Maria">
    </span>
    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
        <h6 class="mb-0">Maria</h6>
        <p class="text-muted mb-1">maria@exaple.com</p>
    </div>
</div>
```

A simple display of a block with a profile can appear on dozens of pages, and if they are copied, then maintaining their appearance can take a lot of time, so various reuse options are being worked out. This is called a component approach, regardless of the delivery method and level of responsibility, it is practiced both in `Blade` and in `React/Vue/Angular`.

It is precisely such components that the platform layers consist of, the only difference is that it is necessary to operate with the classes, creating which you explicitly determine that the accepted parameter `avatar` will be inserted in the <img> tag, without having to edit the source code every time.
