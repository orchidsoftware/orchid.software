---
title: Providing Feedback
description:
section: site.hig.
---


User notifications typically consist of one or two simple sentences and do not require a header. Often, people add unnecessary headlines such as "Dear users," "Important announcement," "Attention!" or "Convincing request!" However, using such headlines may indicate that the content is irrelevant to users.

To make the most of the user's attention, it's important to avoid extraneous information and get straight to the point.

There are several ways to provide feedback in Orchid app, depending on the nature and severity of that feedback:

## Toasts

Toasts are popup banners that display a message and are always temporary and user-dismissible.
They are used to providing context-specific messages in the context of using a screen, often in response to a user action.
Because they are transient, they are best suited to communicating individual events rather than ongoing states.

//...


## Alerts

Alerts can be a useful tool for communicating persistent states that users should not miss, such as indicating that the application is in debug mode or that the user's account is being moderated and is not yet fully accessible. Additionally, in some cases, alerts can provide supplementary information about important locations or content items. By drawing attention to these critical pieces of information, alerts can help ensure that users are aware of important updates and changes.

However, it's important to keep in mind that alerts can take up valuable space and can be distracting. If the state you want to communicate is not critical or can be conveyed through a less disruptive Toast, you may want to consider alternative ways to communicate the information in question.

//...

## Message Dialogs

//...

## Notifications

Notifications in the admin panel are different from others. They are not deleted after being viewed and can be sent to users even when they are offline. They are an excellent way to inform, for example, for a task manager application to notify an employee about a new task.

## Badges

//...
