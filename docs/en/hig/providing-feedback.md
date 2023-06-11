---
title: Providing Feedback
description:
section: site.hig.
---


User notifications typically consist of one or two simple sentences and do not require a header. It is common for people to add unnecessary headlines such as "Dear users", "Important announcement", "Attention!" or "Convincing request!" However, using such headlines may suggest that the content is not relevant to users.

To maximize the user's attention, it's important to avoid including extraneous information and get straight to the point. The most effective feedback tends to match the significance of the information with the way it's delivered. In the Orchid app, there are various ways to provide feedback, depending on the nature and severity of the feedback.

## Alerts

Alerts can be a useful tool for communicating persistent states that users should not miss, such as indicating that the application is in debug mode or that the user's account is being moderated and is not yet fully accessible. Additionally, in some cases, alerts can provide supplementary information about important locations or content items. By drawing attention to these critical pieces of information, alerts can help ensure that users are aware of important updates and changes.

However, it's important to keep in mind that alerts can take up valuable space and can be distracting. If the state you want to communicate is not critical, consider using a less disruptive Toast.

![An important message that the user should not miss.](https://orchid.software/img/hig/alert-example.png)

## Toasts

Toasts are popup banners that display a message and are always temporary and user-dismissable.
They are best used for providing context-specific messages in response to a user action. 
Because they are transient, they are most effective for communicating individual events rather than ongoing states.

![A toast that responds to a trivial user action.](https://orchid.software/img/hig/toast-example.png)


## Notifications

Notifications in app are different from other types of feedback. They are not deleted after being viewed and can be sent to users even when they are offline. They are an excellent way to inform, for example, for a task manager application to notify an employee about a new task.


![Individual messages for employees to reaction to.](https://orchid.software/img/hig/notification-example.png)


## Badges

Badges are small graphical elements that can display important information, such as the number of items in a user's cart, the number of unread messages, or the number of new updates available. They can also be used to draw attention to a new feature that has been added to the app.

It's important to use badges sparingly, since they cannot be hidden by the user. Avoid using more than two badges at a time, as too many badges can be distracting and overwhelming for the user. Be selective and only use badges to highlight the most important information or features that the user needs to be aware of.

![Badges are an excellent method of communicating the existence of ongoing tasks, and can also be used for a variety of other purposes.](https://orchid.software/img/hig/badge-example.png)

