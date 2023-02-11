---
title: Presentation Table 
description: 
section: site.hig.
---


<!--
Designing an effective table can be challenging, especially when dealing with a large number of columns or limited space. Let's take a list of products as an example and explore some best practices for table design.

![image](https://user-images.githubusercontent.com/5102591/217396116-b9e87ea5-aaf7-4d3f-8b11-35aba770afc5.png)



- Simplify the columns: Before attempting to resize the table, consider merging columns that are not necessary. For instance, the image and unique identifier columns can be combined to create more space.
- Merge similar information: In the same example, the name and description columns can be merged to provide more information in a smaller space.
- Use filters for complex information: The category column can show the final value, but the whole chain of categories can be specified in filters instead.
- Emphasize important information: The status of the product is important information that should be easily noticeable. Adding an icon that accurately represents the status and highlighting it in gray if the item is missing will improve the visual component of the table.
- Format prices: Proper formatting of prices will improve the overall readability of the table.
- Determine optimal column width: Determine the optimal width for each column to create a visually balanced table.



![image](https://user-images.githubusercontent.com/5102591/217396151-b3983087-24cf-4de4-9f8d-1788721d2cb7.png)


By following these steps, a cluttered table with cramped elements can be transformed into a clear and visually appealing display.
-->





Tables are not usually winners of a UI beauty contest — they are a utilitarian part of our designs.
To take advantage of their functionality and maintain their aesthetic appearance, follow the recommendations described on this page.


## Text Hierarchy (Find Records)

When searching for records that meet specific criteria, users may be looking for a specific item with known details or multiple items that fit certain criteria. They may filter, sort, use a search feature, or scan the table visually to find what they need. The method chosen will depend on the specifics of the data table and the user's expectations of what will be the easiest way to find what they're looking for.

To design for this task, keep a few things in mind:

- Make the first column a human-readable record identifier rather than an automatically generated ID. This makes it easier for users to find the record they're interested in.

- Order the columns based on their importance to the user, with related columns next to each other. This prevents the need to move back and forth between distant columns to view relevant data.

- Place the filter as close to the table as possible.

Creating text hierarchy is important in table design to ensure a clear and organized presentation of data. The size and weight of the text in each cell should reflect its level of importance, with the largest and boldest text being the most significant and the smallest and lightest text being the least important. This hierarchy guides the user's eye through the table and helps them understand the data in an organized manner.


## Compare Data

Tables are most effective when they allow easy comparison of data, whether between records or columns. 
This comparison helps detect relationships between variables or simply understand typical values.

However, there are two common challenges that users face when comparing data in complex, large tables:

- Understanding which cell belongs to which record due to the overwhelming volume of data on the screen.
- Comparing columns that are far away from each other, requiring tedious scrolling and memorization of data.

To enhance the process of data comparison, Orchid offers the option to dynamically enable or disable the display of columns. This makes it easier to focus on the most important data and avoid being overwhelmed by irrelevant information. When using this feature, it's advisable to exercise caution and only hide columns that are less crucial to your comparison goals.


## Accessing Single Record

A frequent task in tables is accessing or modifying the data in a single record. To make this task more efficient, it's important to present the single record in a way that is easy to read and edit.

In Orchid, the recommended approach is to display the record in a modal window. This approach provides a clear and organized display of the record's data, making it easier to view or edit.

## Alignment Principles

It is recommended to follow a consistent alignment strategy throughout your interface to create a visually harmonious and easy-to-read design. In general, text should be left-aligned and numbers should be right-aligned. This standard alignment approach helps guide the reader's eye and enhances readability.

While there may be situations that warrant deviating from this rule, it is best to reserve center-aligned text for specific design elements, such as headlines and subheadings. The irregular left and right margins created by center-aligned text can be disruptive to the reader's eye and make it difficult to scan through information efficiently.


## Maximizing Cell Content

Unlike an Excel (And other) spreadsheet, a web-based table allows for seamless filtering and organization of information, so adding as much information to each cell as possible is not a problem. Additionally, the information can be divided into several columns at any time if needed, making it easy to adjust the layout to meet the user's needs.

Maximizing the information in each cell can greatly enhance the overall functionality and user experience of a table.


## Row Limitations

It is recommended to limit the number of rows displayed in a table to a single screen view. Exceeding this limit can negatively impact the performance of the table and hinder the user's ability to understand the data being presented. This is because long tables often result in the loss of the table headers, which provide crucial context and information about the data being displayed. To ensure an optimal user experience, aim to keep the number of rows in a table within a single screen view.
