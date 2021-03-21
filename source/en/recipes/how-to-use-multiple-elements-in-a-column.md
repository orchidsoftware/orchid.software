---
title: How to use multiple elements in a single column
description: 
extends: _layouts.page
section: main
---


Sometimes you want to show more elements in a single column, for example more buttons.

For this you can use a `Group`, which also had a `render()`-method.

```php
TD::make('options', trans('admin.options') )
    ->render( function(Project $project) {
        return
            Group::make([
                Link::make(__('admin.crud.show'))
                ->icon('magnifier')
                ->route('platform.projects.show', $project->id),

                Link::make(__('admin.crud.edit'))
                ->icon('pencil')
                ->route('platform.projects.edit', $project->id)
            ])->render();
    }),
```
