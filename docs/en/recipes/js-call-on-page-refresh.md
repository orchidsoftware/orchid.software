---
title: JS call on page refresh
description:
extends: _layouts.page
section: main
---


Since Orchid emulates the work of SPA using hotwire.dev, classic calls like this won't work:

```js
document.addEventListener("load", () => {
    console.log('Page load');
});
```

It will be executed only once and will not be called again during transitions. To avoid this, you need to use Turbo events:

```js
document.addEventListener("turbo:load", () => {
    console.log('Page load');
})
```

You can find out more details on the website [turbo.hotwire.dev](https://turbo.hotwire.dev).
