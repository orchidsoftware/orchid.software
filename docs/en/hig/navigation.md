---
title: Navigation
description:
section: site.hig.
---


## Command Bar

Command Bar is a horizontal button bar with hierarchical drop-down menus. Menu items can either trigger an action, open a menu, or work as a toggle.

Usage recommendations:

- Use icons sparingly. Most actions are difficult to reliably represent with icons, and the benefit of icons in addition to text should be weighed against the additional visual noise this creates.
- Menu items in dropdown menus should always have text labels.
- Icon-only menu buttons should be primarily used for extremely common recurring actions with highly standardized, universally understood icons (for example, a cross for close).
- Command Bar is not an input field!

## Hidden vs Disabled

Hiding an unavailable action entirely is often preferable to a disabled button, as this reduces UI clutter. However, in certain situations this can be problematic:

- If the user expects a button to be present, such as at the end of a form, hiding the button can cause confusion, even if the form clearly indicates the presence of one or more invalid fields.
- As a hidden button doesn’t occupy any space in the UI, toggling its visibility can cause unwanted changes in the layout of other elements.
