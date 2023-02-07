---
title: Design Philosophy
description:
section: site.hig.
---


Orchid prioritizes simplicity and user experience, ensuring key functions of the application are easily accessible through consistent and intuitive navigation and workspace. The platform offers a consistent interaction language and visual design, providing a seamless experience for tasks such as fulfilling sales orders, reviewing KPIs, or managing vacation requests.

Designed for adaptability, Orchid can be used effectively on both mobile devices and desktop computers. The app provides complete information without any clipping, ensuring a seamless transition between devices and a consistent user experience.

## Avoid Feature Bloat

It's often very tempting to continue adding more and more features into your app. 
However, it is important to recognize that every new feature has a price. Specifically, every time you add a new feature:

* Your app gets slower, consumes more resources
* Your app's interface becomes more cluttered and thus harder to use.
* More time is spent implementing this new feature, rather than perfecting an old feature.
* More code can often mean a greater possibility for bugs.
* More features means more work on translations, etc.


## Build for the "Out of the box" experience


Providing settings can be a way to make sure an app is accessible to a wider set of people with unique needs,
but it can also be an easy way out of making design decisions about an app's behavior. 
Just like with problems of feature bloat, settings mean more code, more bugs, more testing,
more documentation, and more complexity. Before adding a new setting, ask if this setting is about
passing off a decision or if it's necessary to make your app more accessible to different types of people.
Don't ask the people using your app to make engineering or design decisions. Settings should cater to competing needs.

> Before adding a new setting, ask if this setting is about passing off a decision or if it's necessary 
to make your app more accessible to different types of people.

Build for the "Out of the box" experience. Most people will not change your app's settings from the defaults.


