---
title: Using fields in a table
description:
extends: _layouts.page
section: main
---

...

```php
use App\Models\User;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\CheckBox;


TD::make('id')->render(function (User $user){
    return CheckBox::make('users[]')
            ->value($user->id)
            ->placeholder($user->name)
            ->checked(false);
});
```

...
