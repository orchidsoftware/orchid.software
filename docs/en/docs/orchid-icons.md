---
title: Orchid Icon Pack
description: 
---


> If you're looking for a section on how to work with icons, please [visit this page](/en/docs/icons).

Starting from version 14, the Orchid Icon Pack has been replaced with a new set from Bootstrap. While replacing all icons in existing applications may present a challenge, 
users still have the option to continue using the icons from Orchid. 

To do this, simply add the following line to your `composer.json` file:

```bash
"orchid/icons": "^2.0",
```

And then specify in your configuration file:

```php
'icons' => [
    // ...
    'orc' => \Orchid\IconPack\Path::getFolder(),
],
```

By doing this, you will continue to use the set of icons from Orchid, which has not been updated for some time due to a lack of a designer.
