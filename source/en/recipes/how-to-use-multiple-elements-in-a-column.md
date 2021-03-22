---
title: How to use multiple elements in a single column
description: 
extends: _layouts.page
section: main
---


Sometimes you want to show more elements in a single column, for example more buttons.

For this you can use a `Group`:

```php
TD::make()->render(function(Project $project) {
  return Group::make([
      Link::make('Show')
        ->icon('magnifier')
        ->route('platform.projects.show', $project->id),

      Link::make('Edit')
        ->icon('pencil')
        ->route('platform.projects.edit', $project->id)
    ]);
});
```
