---
title: Quick Response Time 
description:
section: site.hig.
---


A speedy interface promotes a sense of control and ease of use. Slow performance is frustrating, leads to errors, and increases the likelihood that users will seek technical support rather than attempting to solve the issue themselves.

## Defining "Fast" and "Slow"

The definition of "fast" and "slow" is context-dependent. In urgent situations, seconds may seem longer than normal. However, here is a general guideline:

- A response time of 100 milliseconds is perceived as immediate, and is the expected response for interface elements such as hover, mouse movement, or clicks.
- A delay of 1 second is noticeable, but it does not interrupt the user's flow. A page or list loading in 1 second is acceptable, but a 1-second lag between a click and a menu opening is considered slow.
- Processes lasting longer than 1 second must be optimized.

## Avoiding a Long Response

The speed of a desktop application depends solely on the power of your computer, but the responsiveness of web applications is also affected by server performance and the quality of your Internet connection. Here are some tips to help improve the speed and performance of your web application:

- **Optimize Database Queries**: Minimize the use of complex database queries and ensure the use of proper indexes.
- **Caching**: Use caching techniques such as opcode caching and data caching to store frequently used data and reduce the number of database queries.
- **Preloading Cheat**: Load only the portion of the content needed for the first display of the page and the most likely user actions at once. For example, if there is a lot of information on the screen, consider splitting it into several screens with a common TabMenu. This allows for a more optimized experience and can improve the overall speed of your web application.
- **Caching on the Browser Side**: Cache data and re-download it only if there are changes. This allows for instant switching between downloaded pages. For example, use the Http header Etag.
- **Data Preparation**: Generate responses to "heavy" requests on the server in advance. For example, update the aggregate tables of the database on schedule.
- **Background Processing**: If a long response is unavoidable, do not block the user. Instead, run the operation in the background and notify the user that they will be notified on the system and by email when the operation is complete.

By following these tips, you can help ensure a faster and more optimized experience for your users.
