---
title: Form Elements
description: Learn how to use Orchid's form elements to create custom forms and user inputs in your Laravel administration application. Improve the user experience and streamline data collection with Orchid's intuitive form builder.
---


Fields are used to generate the output of the fill and edit form template. Form elements are the building blocks of a user interface, and they allow you to create different parts of the interface and provide interaction with the user. In this section, we will cover of the most common form elements and their usage.


> Feel free to add your fields, for example, to use the convenient editor for you or any components.


## Introduction to Input

Input is one of the most versatile form elements. It allows you to create text fields, as well as other types of input such as number, email, password, etc. Here is an example of creating a simple text input field:

![This image shows a simple text input box. It is a common user interface element that allows users to enter text or other data into a web form. ](/img/fields/input.png)
 
Example:
```php
use Orchid\Screen\Fields\Input;

Input::make('name');
``` 


### Designing Input Interfaces

Empty and expressionless input fields can confuse the user, but you can help by specifying a title. The title should be a short and descriptive label that clearly communicates the purpose of the field. Here is an example of how to add a title to an input field:

```php
Input::make('name')
    ->title('First name');
```

If you need to provide additional context or instructions for the field, you can use the `help` method to add a hint or brief description. The hint should be a short and concise message that helps the user understand the purpose or format of the field. Here is an example of how to add a hint to an input field:

```php
Input::make('name')
    ->help('What is your name?');
```

If the field requires a more detailed explanation or guidance, you can use the `popover` method to add a tooltip that will be displayed as a pop-up when the user hovers over the field. The tooltip should provide additional information or instructions that help the user complete the field correctly. Here is an example of how to add a tooltip to an input field:

```php
Input::make('name')
    ->popover('Tooltip - hint that user opens himself.');
```

By default, form elements are displayed in a horizontal layout, with the label and input field side by side. However, you can change the layout to a vertical arrangement by using the `vertical()` method:

```php
Input::make('name')->vertical();
```

If you prefer the horizontal layout, you can use the `horizontal()` method to restore it:

```php
Input::make('name')->horizontal();
```

### Required Fields

Sometimes you may need to specify that a field is required, meaning that the user must enter a value in the field before they can submit the form. To mark a field as required, you can use the `required()` method:

```php
Input::make('name')
    ->type('text')
    ->required();
```

You can also use the `required()` method on other types of form elements, such as select, radio buttons, and checkboxes.


### Hiding Input Fields

There may be times when you want to hide a form element from the user interface, either temporarily or permanently. To hide a form element, you can use the `canSee()` method and pass a value of false:

```php
Input::make('name')->canSee(false);
```

If you want to show a previously hidden form element, you can use the canSee() method and pass a value of true:

```php
Input::make('name')->canSee(true);
```


> Note that many methods, such as `canSee`, `required`, `title`, `help`, `vertical`, `horizontal` and many others, are available in almost every `field` of the system.

### Types of Input
 

One of the most universal fields is the `input` field, which allows you to specify a variety of types such as text, file, hidden, color, email, number, range, and url. The type attribute determines the kind of input field you want to create and the kind of data it will accept. Here are some examples of using the `type` method:


```php
Input::make('name')->type('text');
```

A field for entering the name of the file that is sent to the server.
```php
Input::make('name')->type('file');
```

Hidden field.
```php
Input::make('name')->type('hidden');
```

Widget for choosing a color.
```php
Input::make('name')->type('color');
```

For email addresses.
```php
Input::make('name')->type('email');
```

Entering numbers.
```php
Input::make('name')->type('number');
```

Slider to select numbers in the specified range.
```php
Input::make('name')->type('range');
```

To specify web addresses.
```php
Input::make('name')->type('url');
```

> **Please note**. Please note that support for new HTML5 attributes such as `color` and `range` is dependent on the browser being used. You can learn more about attribute types at [Mozilla's website](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input).


### Masking Input Values
 
A mask is a useful tool for enforcing a specific format for user input. For example, you might want to use a mask to ensure that phone numbers are entered in a standard format, or that currency values are entered with the correct number of decimal places.

To use a mask with an input field, you can use the `mask()` method and pass a string that defines the format of the input. The string should contain placeholders for the allowed characters and any fixed characters that should be included. Here is an example of using a mask to enforce a standard phone number format:

```php
Input::make('phone')
    ->mask('(999) 999-9999')
    ->title('Phone number');
```   

You can also pass an array of options to the `mask()` method to customize the behavior of the mask. For example, you can use the `numericInput` option to specify that only numeric characters should be accepted:

```php
Input::make('price')
    ->title('Price')
    ->mask([
        'mask' => '999 999 999.99',
        'numericInput' => true
    ]);
```   

You can also use the `alias` option to use a predefined mask, such as `currency`, which automatically formats the input as a currency value:

```php
Input::make('price')
    ->title('Price')
    ->mask([
        'alias' => 'currency',
        'prefix' => ' ',
        'groupSeparator' => ' ',
        'digitsOptional' => true,
    ]);
```   

You can view all of the available options for the Inputmask library [here](https://github.com/RobinHerbots/Inputmask#options).


       
## TextArea

The `textarea` field is a form element that allows the user to enter multiple lines of text. It is similar to the input field, but it is designed to accept longer pieces of text and to preserve line breaks.

To create a `textarea` field, you can use the `TextArea` class:

```php
use Orchid\Screen\Fields\TextArea;

TextArea::make('description');
```    

By default, the `textarea` field will expand to fit the amount of text that is entered. However, you can use the `rows` method to specify a minimum number of rows:

```php
TextArea::make('description')
    ->rows(5);
```

This can be useful for providing a clear visual indication of the amount of text that is expected.

As with other form elements, you can use methods such as `title()`, `help()`, and `popover()` to add additional context and guidance for the user. You can also use the `required()` method to mark the textarea field as `required` and the `canSee()` method to show or hide the field.

 
## CheckBox

A checkbox is a graphical user interface element that allows the user to control a parameter with two states - checked and unchecked. Checkboxes are often used to represent binary choices, such as whether a particular feature is enabled or disabled.

To create a checkbox field, you can use the `CheckBox` class:


```php
use Orchid\Screen\Fields\CheckBox;

CheckBox::make('free')
    ->value(1)
    ->title('Free')
    ->placeholder('Event for free')
    ->help('Event for free');
```    


The `value` attribute determines the value that will be sent to the server when the checkbox is checked. The `title` attribute provides a label for the checkbox, and the `placeholder` attribute can be used to provide a default value or a short description. The `help` attribute can be used to provide additional context or instructions for the user.

By default, browsers do not send the value of an unchecked checkbox when the form is submitted. This can make it difficult to use checkboxes with simple Boolean values. To solve this problem, you can use the `sendTrueOrFalse()` method, which will send the value `false` to the server when the checkbox is unchecked:


```php
CheckBox::make('enabled')
    ->sendTrueOrFalse();
```

This can be useful for ensuring that the server receives a clear indication of the state of the checkbox.

## Select

The select field is a form element that allows the user to choose an option from a dropdown list. It is useful for presenting a limited set of options and allowing the user to make a selection.

To create a select field, you can use the `Select` class:

```php
use Orchid\Screen\Fields\Select;

Select::make('select')
    ->options([
        'index'   => 'Index',
        'noindex' => 'No index',
    ])
    ->title('Select tags')
    ->help('Allow search bots to index');
```

The `options` attribute is an array that defines the options that will be presented in the dropdown list. The keys of the array are the values that will be sent to the server, and the values are the labels that will be displayed to the user.

In addition to using an array of options, you can also use a data source to populate the options of a select field. For example, you can use a model to retrieve the options:

```php
Select::make('user')
    ->fromModel(User::class, 'email');
```

This will retrieve all records from the `User` model and use the email field as the label for each option. You can also use a custom query to retrieve the options:

```php
Select::make('user')
    ->fromQuery(User::where('balance', '!=', '0'), 'email');
```

This will retrieve all records from the `User` model where the `balance` field is not equal to `0`, and use the `email` field as the label for each option.

You can also specify a different field to use as the key for each option using the `fromModel()` and `fromQuery()` methods:


```php
Select::make('user')
    ->fromModel(User::class, 'email', 'uuid');
```


This will use the `uuid` field as the key for each option, rather than the default primary key.

If you want to provide an option that represents an unselected state, you can use the `empty()` method:

```php
// For array
Select::make('user')
    ->options([
        1  => 'Option 1',
        2  => 'Option 2',
    ])
    ->empty('No select');

// For model
Select::make('user')
    ->fromModel(User::class, 'name')
    ->empty('No select');
```

The `empty` method also accepts the second argument, which is responsible for the value:

```php
Select::make('user')
    ->empty('No select', 0)
    ->options([
        1  => 'Option 1',
        2  => 'Option 2',
    ]);
```

Allow custom values with the `allowAdd` method:

```php
Select::make('type')
    ->allowAdd()
    ->options([
        'Option 1',
        'Option 2',
    ]);
```

## Relation


Relations fields can load dynamic data, this is a good solution if you need connections.

```php
use Orchid\Screen\Fields\Relation;

Relation::make('idea')
    ->fromModel(Idea::class, 'name')
    ->title('Choose your idea');
```

For multiple selections, use the `multiple()` method.

```php
Relation::make('ideas.')
    ->fromModel(Idea::class, 'name')
    ->multiple()
    ->title('Choose your ideas');
```

> **Note.** Note the dot at the end of the name. It is necessary in order to show the expectedness of the array. As if it were `HTML` code `<input name='ideas[]'>`

To modify the load, you can use the reference to the `scope` model,
for example, take only active:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }
}
```

```php
Relation::make('idea')
    ->fromModel(Idea::class, 'name')
    ->applyScope('active')
    ->title('Choose your idea');
```

You can also pass additional parameters to the method:

```php
Relation::make('idea')
    ->fromModel(Idea::class, 'name')
    ->applyScope('status', 'active')
    ->title('Choose your idea');
```


You can add one or several fields, which will be additionally searched for:

```php
Relation::make('idea')
     ->fromModel(Idea::class, 'name')
     ->searchColumns('author', 'description')
     ->title('Choose your idea');
```

To set the number of items that will be listed as a result of a search, you can chain the method chunk, passing the number of search results as a param:

```php
Relation::make('users.')
    ->fromModel(User::class, 'name')
    ->chunk(20);
```

Selection options can work with calculated fields, but only to display the result, the search will occur only on one column in the database. To do this, use the `displayAppend` method.

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function getFullAttribute(): string
    {
        return sprintf('%s (%s)', $this->name, $this->email);
    }
}
```

To indicate the displayed field you must:

```php
Relation::make('users.')
    ->fromModel(User::class, 'name')
    ->displayAppend('full')
    ->multiple()
    ->title('Select users');
```


## DateTime

The DateTime field provides a streamlined interface for selecting both date and time within your Laravel applications, leveraging the robust functionality of the `flatpickr` JavaScript library.


![DateTime](/img/ui/datatime.png) 

### Usage

To create a DateTime field, utilize the `DateTimer` class:

```php
use Orchid\Screen\Fields\DateTimer;

DateTimer::make('open')
    ->title('Opening date');
```

### Direct Input

Enable direct input to allow users to manually enter:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->allowInput();
```

**Note:** Enabling direct input can also make the field mandatory:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->allowInput()
    ->required();
```

### Date Format

Customize the date format using the `format()` method:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->format('Y-m-d');
```

### Time Format

Opt to display time in 24-hour format:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->format24hr();
```

### Time Selection

Enable selection of both date and time using the `enableTime()` method:

```php
DateTimer::make('open')
    ->title('Opening time')
    ->enableTime();
```

### Time Selection Only

If only time selection is required:

```php
DateTimer::make('open')
    ->title('Opening time')
    ->noCalendar()
    ->format('h:i K'); // Specify time format
```

### Range Selection

Allow users to select a range for dates and times:

```php
DateTimer::make('open')
    ->format('Y-m-d H:i')
    ->enableTime()
    ->format24hr()
    ->range(); 
```

### Quick Date Selection

Facilitate easy selection with predefined quick date options:

```php
DateTimer::make('open')
    ->format('Y-m-d H:i')
    ->enableTime()
    ->format24hr()
    ->range() 
    ->withQuickDates([
        'Today'     => now(),
        'Yesterday' => now()->subDay(),
        'Last Week' => [now()->startOfDay()->subWeek(), now()->endOfDay()],
    ]);
```

### Allow Empty Values

Allow the field to remain empty:

```php
DateTimer::make('open')
    ->format('Y-m-d')
    ->allowEmpty()
    ->multiple();
```

### Multiple Selection

Permit multiple date selections:

```php
DateTimer::make('open')
    ->format('Y-m-d')
    ->allowEmpty()
    ->multiple();
```

## DateRange


Allows you to select a range of date (and time).

Example:
```php
use Orchid\Screen\Fields\DateRange;

DateRange::make('open')
    ->title('Opening between');
```           

Default value / result is an array with keys of `start`, `end`.

## TimeZone

The `TimeZone` field is a form element that allows the user to choose a time zone from a dropdown list. It is useful for selecting the time zone in which an event or action will take place.


```php
use Orchid\Screen\Fields\TimeZone;

TimeZone::make('time');
```

This will create a dropdown list of all available time zones. You can also specify a specific set of time zones to include in the list using the `listIdentifiers()` method:

```php
use DateTimeZone;

TimeZone::make('time')
    ->listIdentifiers(DateTimeZone::ALL); 
```

The `listIdentifiers()` method takes a constant from the DateTimeZone class as an argument. The default value is `DateTimeZone::ALL`, which includes all available time zones. Other possible values are:

```php
DateTimeZone::AFRICA;
DateTimeZone::AMERICA;
DateTimeZone::ANTARCTICA;
DateTimeZone::ARCTIC;
DateTimeZone::ASIA;
DateTimeZone::ATLANTIC;
DateTimeZone::AUSTRALIA;
DateTimeZone::EUROPE;
DateTimeZone::INDIAN;
DateTimeZone::PACIFIC;
DateTimeZone::UTC;
DateTimeZone::ALL_WITH_BC;
DateTimeZone::PER_COUNTRY;
```

The representation of variable zones can be found in the documentation [PHP](https://www.php.net/manual/en/class.datetimezone.php).


## Quill WYSIWYG Editor

The Quill WYSIWYG (What You See Is What You Get) editor offers a seamless solution for integrating rich text editing capabilities into your web applications. With Quill, users can effortlessly insert images, apply text styling, embed videos, and more.

### Usage

To create a Quill editor instance, simply utilize the `Quill` field. Here's an example of how to implement it in your code:

```php
use Orchid\Screen\Fields\Quill;

Quill::make('html');
```

### Toolbar Controls

Quill provides a comprehensive set of controls organized into six groups, empowering users with diverse editing functionalities. These groups include:

- **Text**: Tools for basic text formatting such as bold, italic, underline, and strikethrough.
- **Color**: Options for adjusting text and background color.
- **Header**: Tools for styling text as headers.
- **List**: Controls for creating ordered and unordered lists.
- **Format**: Additional formatting options like alignment and indentation.
- **Media**: Features for inserting multimedia content such as images and videos.

You can customize the toolbar by specifying which groups of controls to display. Here's how you can configure the toolbar in your code:

```php
Quill::make('html')
    ->toolbar(["text", "color", "header", "list", "format", "media"]);
```

### Extensibility

One of the strengths of Quill is its extensibility through plugins. You can enhance the editor's functionality by installing additional plugins. This can be easily accomplished using a JavaScript file.

```javascript
document.addEventListener('orchid:quill', (event) => {
    // Object for registering plugins
    event.detail.quill;

    // Parameter object for initialization
    event.detail.options;
});
```

**Note**: You can add custom scripts and stylesheets through the `platform.php` config file

Example for [quill-image-compress](https://github.com/benwinding/quill-image-compress):

Add the following in `config/platform.php` into the `resource.scripts` array
```
"https://unpkg.com/quill-image-compress@1.2.11/dist/quill.imageCompressor.min.js",
"/js/admin/quill.imagecropper.js",
```

create a `quill.imagecropper.js` in `public/js/admin` with the following content

```js
document.addEventListener('orchid:quill', (event) => {
    // Object for registering plugins
    event.detail.quill.register("modules/imageCompressor", imageCompressor);

    // Parameter object for initialization
    event.detail.options.modules = {
         imageCompressor: {
            quality: 0.9,
            maxWidth: 1000, // default
            maxHeight: 1000, // default
            imageType: 'image/jpeg'
        }
    };
});
```

## Markdown Editor

The Markdown editor field is a powerful tool for creating and editing text using the Markdown markup language. Markdown offers a simple and intuitive syntax that allows users to focus on content creation without getting bogged down by complex formatting.

![Markdown](/img/ui/markdown.png)
![Markdown Editor Preview](/img/ui/markdown2.png)

To create a Markdown editor field, you can use the `SimpleMDE` class:

```php
use Orchid\Screen\Fields\SimpleMDE;

SimpleMDE::make('markdown');
```  

## Matrix

The Matrix field provides a user-friendly interface for editing tabular data, offering flexibility and convenience. It's particularly useful for scenarios where you need to manage structured data within a flat table format, such as storing information in a JSON column type.

### Usage

You can easily create a Matrix field by specifying the column headers. Here's an example of how to define a Matrix field with columns:

```php
use Orchid\Screen\Fields\Matrix;

Matrix::make('options')
    ->columns([
        'Attribute',
        'Value',
        'Units',
    ]);
```

### Customizing Column Headers

In some cases, the values of the columns may differ from what needs to be displayed in the headers. You can address this by specifying keys for the columns:

```php
Matrix::make('options')
    ->columns([
        'Attribute' => 'attr',
        'Value' => 'product_value',
    ]);
```

### Limiting Rows

You can also set a maximum number of rows, after which the add button will be disabled:

```php
Matrix::make('options')
    ->columns(['id', 'name'])
    ->maxRows(10);
```

### Custom Fields

By default, each cell in the Matrix field contains a textarea element. However, you can customize the field types according to your requirements:

```php
Matrix::make('users')
    ->title('Users list')
    ->columns(['id', 'name'])
    ->fields([
        'id'   => Input::make()->type('number'),
        'name' => TextArea::make(),
    ]);
```

> It's important to note that the Matrix field performs field copying on the client side. While this works seamlessly for simple input and select fields, it may encounter limitations with complex or compound fields.

## Code editor

A field for writing program code with the ability to highlight.

![Code](/img/ui/code.png)

Example:
```php
use Orchid\Screen\Fields\Code;

Code::make('code');
```    

To specify code highlighting for a specific programming language, you can use the `language()` method.


```php
Code::make('code')
    ->language(Code::CSS);
```

The following languages are available:

* Markup - `markup`, `html`, `xml`, `svg`, `mathml`
* CSS - `css`
* C-like - `clike`
* JavaScript - `javascript`, `js`


The number of lines is supported:

```php
Code::make('code')
    ->lineNumbers();
```


## Picture

Allows you to upload an image.

Example:
```php
use Orchid\Screen\Fields\Picture;

Picture::make('picture');
```  

You can specify the storage backend for the uploaded image using the `storage` method:

```php
Picture::make('picture')
    ->storage('s3');
```

Use the `acceptedFiles` method to define the types of files that the field should accept. This is done using unique [unique file type specifiers](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file#unique_file_type_specifiers).

For example, to only allow JPEG images, you can use the following code:

```php
Picture::make('picture')
    ->acceptedFiles('.jpg');
```



## Cropper

Extends Picture and allows you to upload an image and crop to the desired format.

![Cropper](/img/fields/cropper.png)

Example:
```php
use Orchid\Screen\Fields\Cropper;

Cropper::make('picture');
```  

### Width and height

In order to control the format, you can specify the width and height of the desired image:

```php
Cropper::make('picture')
    ->width(500)
    ->height(300);
```

Or you can impose specific limits using `minWidth` / `maxWidth` or `minHeight` / `maxHeight` or use convenience methods `minCanvas` / `maxCanvas`

```php
Cropper::make('picture')
    ->minCanvas(500)
    ->maxWidth(1000)
    ->maxHeight(800);
```


### File Size Limit
    
To limit the size of the downloaded file, you must set the maximum value in `MB`.

```php
Cropper::make('picture')
    ->maxFileSize(2);
```


### Value

The control of the return value is carried out using the methods:

```php
Cropper::make('picture')
    ->targetId();
```

The sequence number (`id`) of the` Attachment` record will be returned.

```php
Cropper::make('picture')
    ->targetRelativeUrl();
```
Will return the relative path to the image.

```php
Cropper::make('picture')
    ->targetUrl();
```
Will return the absolute path to the image.


## Upload

Renders upload for images or regular files.

Example:
```php
use Orchid\Screen\Fields\Upload;

Upload::make('upload');
```  

```php
Upload::make('docs')
    ->groups('documents');

Upload::make('images')
    ->groups('photo');
```  

To get specific files via Model relation

```php
use Orchid\Attachment\Models\Attachment;

// One-to-Many (with foreign id)
public function hero()
{
    return $this->hasOne(Attachment::class, 'id', 'hero')->withDefault();
}

// Many-to-Many (no foreign id on table, should be uploaded with groups() function)
public function documents()
{
    return $this->hasMany(Attachment::class)->where('group','documents');
}
```

It can be used to limit the maximum number of files that will be processed:

```php
Upload::make('upload')
    ->maxFiles(10);
```

Determines the number of concurrent downloads for processing files:
```php
Upload::make('upload')
    ->parallelUploads(2);
```

Maximum upload file size:
Default `upload_max_filesize` & `post_max_size` values are 2M , You can change them in `php.ini` to enable setting max file size to be more than 2M
```php
Upload::make('upload')
    ->maxFileSize(1024); // Size in MB 
```

The default implementation of `accept` checks the type or extension of the MIME file against this list. This is a comma-separated list of MIME types or file extensions.

```php
Upload::make('upload')
    ->acceptedFiles('image/*,application/pdf,.psd');
```

The upload field can work with various repositories. To specify it, you must pass the key specified in `config/filesystems.php`:

```php
Upload::make('upload')
    ->storage('s3');
```

The default storage is `public`.


Sometimes you already know that the file was loaded earlier, then you can use the library search:

```php
Upload::make('upload')
    ->media();
```

It will add a new button with a modal window to preview uploaded files.

## Group

The Group field is used to combine several fields on one line. This can be useful for creating compact forms or for aligning fields horizontally. To create a Group field, use the `Group::make` method and pass an array of fields as the argument:

```php
use Orchid\Screen\Fields\Group;

Group::make([
    Input::make('first_name'),
    Input::make('last_name'),
]),
```

By default, fields within a Group field will occupy the entire available screen width. You can specify the width of the fields using the `fullWidth` or `autoWidth` methods:

```php
// Fields will occupy the entire available screen width
Group::make([
    // ...
])->fullWidth();

// Fields will take up as much space as necessary
Group::make([
    // ...
])->autoWidth();
```


## Button/Link

In certain cases, you need to add a button to call a modal window, a simple link, or add a button
submit the form at the end of the screen.
For such cases, there is a `Button` field. The `Button` field cannot have any
values and is not transmitted when saving. It can be used to call a modal window defined on the screen.
And to add a simple link in the form.

An example of using the modal window `addNewPayment` added earlier to the screen:

```php
use Orchid\Screen\Actions\ModalToggle;

ModalToggle::make('Add Payment')
    ->modal('addNewPayment')
    ->icon('wallet');
```

Linking example:

```php
use Orchid\Screen\Actions\Link;

Link::make('Google It!')
    ->href('http://google.com');

Link::make('Idea')
    ->route('platform.idea');
```

Example use with method:

```php
use Orchid\Screen\Actions\Button;

Button::make('Google It!')
    ->method('goToGoogle');
```

Available modifiers:

* `right()` - Positioning the element on the right edge of the screen
* `block()` - Positioning the element across the entire width of the screen
* `class('class-names')` - rewrites the standard button classes
* `method('methodName')` - when clicked, the form will be sent to the specified method within the current screen
* `icon('icon-wallet')` - sets an icon for the button

## Dropdown

You can easily create a DropDown action button combining all other actions. 
For example, you can create the typical three dots dropdown:

```php
use Orchid\Screen\Actions\DropDown;

DropDown::make()
    ->icon('options-vertical')
    ->list([
        Link::make(__('Edit'))
            ->route('platform.users.edit', $user->id)
            ->icon('pencil'),
        Button::make(__('Delete'))
            ->method('remove')
            ->icon('trash')
            ->confirm(__('Are you sure you want to delete the user?'))
            ->parameters([
                'id' => $user->id,
            ]),
    ]);
```

 
## NumberRange

You can create ranges of numbers. Especially usefull for filters.

```php
NumberRange::make();
```

Usage with filters:
```php
TD::make()->filter(NumberRange::make());
//or
TD::make()->filter(TD::FILTER_NUMBER_RANGE);
```

Result is an array with keys of `min`, `max`.  


## Custom Fields Creation

To create custom fields, refer to the "Builder" page in the documentation. 
This page provides a straightforward guide on how to create and customize fields according to your requirements. 
Access the "Builder" page by clicking here: [Builder](/en/docs/builder).
