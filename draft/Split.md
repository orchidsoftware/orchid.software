
# Split Layout

The Split layout is a type of layout that allows you to divide the screen into two customizable sections. 
This layout is particularly useful when you want to display two separate pieces of information side-by-side.

Orchid provides a shortcut method for creating a Split layout with two views using the `Layout::split()` method. 
To create a Split layout, simply pass an array of two Layout objects as the first parameter to the `split()` method. 
You can also set the ratio of the two sections using the optional `ratio()` method as the second parameter.

Here's an example of how to create a Split layout with a `40/60` ratio:

```php
Layout::split([
Layout::view('first-view'),
Layout::view('second-view'),
])->ratio('40/60');
```

## Customizing the Ratio

By default, the Split layout divides the screen with a `50/50` ratio. However, you can easily customize this ratio using the `ratio()` method. 
This method takes a string argument that specifies the desired ratio. Here are the valid ratios:

- 20/80
- 30/70
- 40/60
- 50/50
- 60/40
- 70/30
- 80/20

For example, to create a `Split` layout with a `40/60` ratio:

```php
Layout::split([
    Layout::view('first-view'),
    Layout::view('second-view'),
])->ratio('40/60'),
```




## Reversing the Order on Mobile

By default, the order of the two sections in a `Split` layout is fixed. 
However, you can reverse the order of the sections on mobile devices by calling the `reverseOnPhone()` method. Here's an example:

```php
Layout::split([
    Layout::view('first-view'),
    Layout::view('second-view'),
])->ratio('40/60'),
```

This will create a `Split` layout with a `40/60` ratio, and the order of the sections will be reversed on mobile devices.
