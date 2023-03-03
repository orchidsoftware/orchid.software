---
title: Navigation
description:
section: site.hig.
---


## Sidebar Menu

Menus are a crucial component of the graphical user interface, serving as the primary means of navigation for the project. They provide users with a clear understanding of their current location and enable them to explore other areas of the app. Menus also indicate the user's current profile. To ensure maximum usability, the menu should always be open and not collapsible since few icons are universally recognized by users.


![✅ This image shows an illustrative example of ...](https://orchid.software/img/hig/navigation-menu.png)



Here are some recommendations for using menus effectively:

- Arrange the list in a way that is most useful for your app's users. The most relevant items should be placed as high as possible.
- While vertical menus can accommodate an unlimited number of items, it's best to keep them to a minimum for ease of navigation. For instance, aim for no more than 16 items.
- The active menu item should remain highlighted when a user navigates to a child screen. For example, if a user goes to edit their profile, the "User Management" item should still be active.


## Breadcrumb

```php
TODO: 

To tell you that bread crumbs are always needed. The exception is the home page
```


## Command Bar

Command Bar is a horizontal button bar with hierarchical drop-down menus. Menu items can either trigger an action or open a dropdown menu.

Usage recommendations:

- Use icons sparingly. Most actions are difficult to reliably represent with icons, and the benefit of icons in addition to text should be weighed against the additional visual noise this creates.
- Menu items in dropdown menus should always have text labels.
- Icon-only menu buttons should be primarily used for extremely common recurring actions with highly standardized, universally understood icons (for example, a cross for close).
- Command Bar is not an input field!

## Hidden vs Disabled

Hiding an unavailable action entirely is often preferable to a disabled button, as this reduces UI clutter. However, in certain situations this can be problematic:

- If the user expects a button to be present, such as at the end of a form, hiding the button can cause confusion, even if the form clearly indicates the presence of one or more invalid fields.
- As a hidden button doesn’t occupy any space in the UI, toggling its visibility can cause unwanted changes in the layout of other elements.
