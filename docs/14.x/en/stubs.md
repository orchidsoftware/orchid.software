---
title: Stubs
description: Customize the stubs used by Orchid to generate various classes.
---

When creating new classes in Orchid, the system will use default stubs that are already included within Orchid. However,
you may wish to customize these stubs for your project to apply common modifications automatically.

To publish the stubs used by Orchid to generate various classes, run the following command:

```shell
php artisan orchid:stubs
```

When running this Artisan command in your terminal, Orchid will copy all of its stub files into the `./stubs/orchid`
directory, where they can be customized.

If you don't wish to customize a particular stub, you can delete it, and Orchid will continue using the default version
of the stub that exists within the system.
