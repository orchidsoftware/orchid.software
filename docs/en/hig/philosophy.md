---
title: Design Philosophy
description:
section: site.hig.
---


Orchid prioritizes simplicity and user experience, ensuring key functions of the application are easily accessible through consistent and intuitive navigation and workspace. The platform offers a consistent interaction language and visual design, providing a seamless experience for tasks such as fulfilling sales orders, reviewing KPIs, or managing vacation requests.

Designed for adaptability, Orchid can be used effectively on both mobile devices and desktop computers. The app provides complete information without any clipping, ensuring a seamless transition between devices and a consistent user experience.


Orchid prioritizes simplicity by limiting the addition of extraneous features. It's crucial to recognize that each new feature carries a cost, including:

* Slower app performance and increased resource consumption
* A cluttered interface that becomes more difficult to use
* Diversion of time and effort away from refining existing features
* Increased code complexity, leading to a higher risk of bugs
* Additional translation and localization work


By focusing on a streamlined, intuitive user experience, Orchid helps you work more efficiently and effectively.


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


