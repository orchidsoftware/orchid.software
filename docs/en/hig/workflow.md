---
title: User Workflow
description: Bringing a line of business application in line with modern expectations.
section: site.hig.
---


Visible design is a large part of the user experience, but so is the user's workflow, or how they interact with an app.
In this section, we cover a few important steps of a typical workflow:

## Confirmation of Action

When you use your mobile phone, you expect all the information you enter to be immediately saved and applied.

This approach works great with individual things that only affect you. But if instead of setting the time,
you were to switch the date of the press release, that would be terrible, because you could make a mistake.
The situation is especially aggravated when the same object is opened for editing by multiple users at once.

So we expect that saving information on demand requires an explicit acknowledgement, such as clicking on a button.

## Destructive of Action

Asking for user confirmation before executing a destructive action, such as deleting data, is a crucial aspect of user-centered design.
This practice helps to:

- **Prevent accidental data loss**: By requiring confirmation, users are given an opportunity to review their action and prevent
loss of data due to miss-clicks or accidental triggers.

- **Increase user control**: Asking for confirmation empowers users by giving them the final say in the deletion process.
This increases their sense of control over their data and enhances the overall user experience.

- **Build trust**: Systems that incorporate confirmation prompts are viewed as more trustworthy and reliable by users.
Confirmation prompts help to avoid frustration and dissatisfaction caused by unintended actions.

Incorporating confirmation prompts into a design helps to create a more secure and user-friendly experience.

## Welcoming the User

If there is no content to show the user, provide actions they can act upon.
Let them create a document, import a CSV, or whatever makes sense in the context of the app.

## Leveraging Existing Resources

In app development, strive to leverage existing resources and components from Orchid.
This will not only save time and effort, but also ensure a seamless migration to newer versions.
However, don't compromise the integrity and functionality of the application in the process of reusing resources.
Do not force it though. If it doesn’t fit, it doesn’t fit.

## Adopt a Modular Approach

Keep in mind that Orchid is a package for Laravel, and therefore it's advisable to create smaller packages that complement each other.
This helps to eliminate duplication of functionality and makes these features accessible to other applications.

For instance, a popular use case is to implement backups, and many users prefer to utilize
the package [spatie/laravel-backup](https://github.com/spatie/laravel-backup). However, you can take it a step further by building
a package that includes a preconfigured route and a backup screen.
