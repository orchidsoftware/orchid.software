---
title: Settings
description: Settings this is key-value storage
extends: _layouts.documentation
section: main
---

The simplest persistent data store using a key to access a value.
To add a new value to the repository you need to use:

```php
use Orchid\Support\Facades\Setting;

Setting::set($key, $value);
```

The transferred value will be converted to JSON, and upon receipt, decoding will occur, this allows you to place not only simple types, but also arrays in the storage.

To get the value:
```php
/**
* @param string|array $key
* @param string|null $default
*/
Setting::get($key, $default);
// or using the helper function
setting($key, $default);
```

By default, each item cached before it is changed, in cases if you need to get a value not from the cache, you need to use the getNoCache method.

```php
Setting::getNoCache($key, $default = null);
```

> **Note.** When transferring keys as an array, subsequent updates of values will not automatically flush the cache.

To delete a value:

```php
/**
* @param string|array $key
* @param string|null $default
*/
Setting::forget($key);
```

Please note that you can get or delete several values from the repository at once, for this you need to pass an array with the names of the keys as the first argument.
