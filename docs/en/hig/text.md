---
title: Writing Style
description:
section: site.hig.
---

## Creating a Consistent User Experience

Maintaining a consistent style and language throughout the user interface is crucial when developing a product.
Just as sticking to a style guide is essential in documentation, it also plays an equally important role in the app itself.

Consistency in style and language is vital for establishing a unified and professional user experience.
Users should perceive every interaction within the app as aligned with their expectations and reflective of the brand's identity.

To achieve this, it is recommended to refer to reputable industry resources like the [Microsoft Style Guide](https://docs.microsoft.com/en-us/style-guide/) and Google Material Design. These style guides offer valuable insights from experienced writers and designers, allowing you to leverage their expertise and save time in the process.

For instance, the Microsoft Style Guide suggests capitalizing only the first word of headings and titles to maintain a clean and modern aesthetic.
Similarly, Google Material Design emphasizes the importance of using concise and clear language that aligns with user expectations.

Now that you have knowledge about the style guides that tech writers follow, the question arises: how can you apply these recommendations effectively?
Reading the entire Microsoft Manual of Style or any other style guide cover to cover, memorizing useful recommendations,
and taking notes can be quite time-consuming. With the Microsoft Manual of Style alone spanning nearly 500 pages, this approach can seem overwhelming.
Even experienced tech writers, who may have key recommendations memorized, can still make mistakes or overlook issues during the editing process because, after all, we are all human.

> Fortunately, there are tools available to automate the process of checking texts against the recommendations provided in style guides such as Microsoft and Google. The [Vale](https://vale.sh/) linter is one such tool that assists in verifying compliance with style guide recommendations.

<!--
## Writing Style

```php
// Coming Soon
```
-->

## Localization

- **Make it translatable.** Always, always make your text translatable using the built-in methods. It can't be translated if you don't make it translatable. Include punctuation in translatable strings.

- **Avoid culture-specific references.** Remember that users of another language are going to be using your app. Specific metaphors or references will likely be lost on or downright confusing to other those users. Instead, use universal text.
