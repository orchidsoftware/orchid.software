---
title: Design Philosophy
description: 
---

# Design Philosophy

# Concision

Always work to make your web app instantly understandable. The main function of your app should be immediately apparent.
You can do this in a number of ways, but one of the best ways is by sticking to a principle of concision.

## Avoid Feature Bloat

It's often very tempting to continue adding more and more features into your app. 
However, it is important to recognize that every new feature has a price. Specifically, every time you add a new feature:

* Your app gets slower, consumes more resources
* Your app's interface becomes more cluttered and thus harder to use.
* More time is spent implementing this new feature, rather than perfecting an old feature.
* More code can often mean a greater possibility for bugs.
* More features means more work on translations, etc.

## Adopt a Modular Approach
Keep in mind that Orchid is a package for Laravel, and therefore it's advisable to create smaller packages that complement each other. 
This helps to eliminate duplication of functionality and makes these features accessible to other applications.

For instance, a popular use case is to implement backups, and many users prefer to utilize 
the package [spatie/laravel-backup](https://github.com/spatie/laravel-backup). However, you can take it a step further by building 
a package that includes a preconfigured route and a backup screen.


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


# Adaptable

//...

