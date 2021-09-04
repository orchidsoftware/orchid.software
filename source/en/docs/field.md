---
title: Form elements
description: Fields are used to generate the output form template and edit
extends: _layouts.documentation
section: main
---

Fields are used to generate the output of the fill and edit form template.

> Feel free to add your fields, for example, to use the convenient editor for you or any components.


## Input

It is one of the versatile form elements and allows you to create different parts of the interface and provide interaction with the user. Mainly designed to create text fields.

![Input](/assets/img/fields/input.png)
 
Example:
```php
use Orchid\Screen\Fields\Input;

Input::make('name');
``` 


### Design

Empty and expressionless input fields can confuse the user,
but you can help by specifying a title.

```php
Input::make('name')
    ->title('First name');
```

When you need to describe the purpose of the field in more detail,
then you can use the hint:

```php
Input::make('name')
    ->help('What is your name?');
```

If the field description is very specific and a large description is required,
You can use the tooltip that will be shown as a popup:

```php
Input::make('name')
    ->popover('Tooltip - hint that user opens himself.');
```

Horizontal or vertical view:

```php
Input::make('name')->vertical();
```

```php
Input::make('name')->horizontal();
```

### Required

Sometimes you may need to specify a required field,
to do this, call the `required` method:

```php
Input::make('name')
    ->type('text')
    ->required();
```


### Hiding

```php
Input::make('name')->canSee(true);
Input::make('name')->canSee(false);
```

> Note that many methods, such as `canSee`, `required`, `title`, `help`, `vertical`, `horizontal` and many others, are available in almost every `field` of the system.

### Types
 
One of the most universal fields, by specifying a type, all `html` values are supported:

> **Please note**. Support for the new HTML5 attributes is completely dependent on the browser used.

Text field. Designed to enter characters using the keyboard.
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

You can learn more about attribute types at [Mozilla's website](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input).



### Mask for entering values
 
Great if the values should be written in a standard form, such as TIN or phone number

Example:
```php
Input::make('phone')
    ->mask('(999) 999-9999')
    ->title('Phone number');
```   

An array with parameters can be passed to the mask, for example:

```php
Input::make('price')
    ->title('Price')
    ->mask([
     'mask' => '999 999 999.99',
     'numericInput' => true
    ]);
```   

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

All available *Inputmask* options can be viewed [here](https://github.com/RobinHerbots/Inputmask#options).


       
## TextArea

The `textarea` field is a form element for creating an area into which multiple lines of text can be entered.
In contrast to the `input` tag, it is permissible to do line breaks in the text field, they are saved when sending data to the server.

Example:
```php
TextArea::make('description');
```    

You can set the required number of rows using the `rows` method:

```php
TextArea::make('description')
    ->rows(5);
```

 
## CheckBox

A graphical user interface element that allows the user to control a parameter with two states - ☑ on and ☐ off.


Example:
```php
CheckBox::make('free')
    ->value(1)
    ->title('Free')
    ->placeholder('Event for free')
    ->help('Event for free');
```    

By default, browsers do not send the value of an unselected field. This complicates the installation of simple Boolean types. To solve this, there is a separate method in which the value `false` will be sent:

```php
CheckBox::make('enabled')
    ->sendTrueOrFalse();
```

## Select

Simple selection from an array list:

```php
Select::make('select')
    ->options([
        'index'   => 'Index',
        'noindex' => 'No index',
    ])
    ->title('Select tags')
    ->help('Allow search bots to index');
```

Work with a source model:

```php
Select::make('user')
    ->fromModel(User::class, 'email');
```

Source with the condition:
```php
Select::make('user')
    ->fromQuery(User::where('balance', '!=', '0'), 'email');
```

Key change:
```php
Select::make('user')
    ->fromModel(User::class, 'email', 'uuid');
```

There may be situations when you need to add some value, which means that the field is not selected. To do this, you can use the `empty` method:
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

## Relation


Relations fields can load dynamic data, this is a good solution if you need connections.

```php
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


Selection options can work with calculated fields, but only to display the result, the search will occur only on one column in the database. To do this, use the `displayAppend` method.

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @return string
     */
    public function getFullAttribute(): string
    {
        return $this->attributes['name'] . ' (' . $this->attributes['email'] . ')';
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


Allows you to select the date and time.

![Datatime](https://orchid.software/assets/img/ui/datatime.png) 


Example:
```php
DateTimer::make('open')
    ->title('Opening date');
```           

Allow direct input:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->allowInput();
```           

**Please note** that setting a field can be mandatory only with direct input:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->allowInput()
    ->required();
```


Data format:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->format('Y-m-d');
```

Example for display in 24th format:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->format24hr();
```

Calendar over time:

```php
DateTimer::make('open')
    ->title('Opening time')
    ->enableTime();
```

Choice of time only:

```php
DateTimer::make('open')
    ->title('Opening time')
    ->noCalendar()
    ->format('h:i K');
```


## TimeZone


Field for convenient time zone selection:

```php
TimeZone::make('time');
```

Specification of specific time zones is possible using:

```php
use DateTimeZone;

TimeZone::make('time')
    ->listIdentifiers(DateTimeZone::ALL); 
```

The default value is `DateTimeZone::ALL`, but others are possible:

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


## HTML Quill Editor

Such an editor allows you to insert pictures, tables, specify styles for text, video.

Example:
```php
Quill::make('html');
``` 

There are 6 groups of controls available:

```php
Quill::make('html')
    ->toolbar(["text", "color", "header", "list", "format", "media"]);
``` 

It's possible to install additional plugins with a simple Javascript file

```js
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
   
Editor for the lightweight markup language. Created with the goal of writing the most readable and easy to edit text.  But suitable for converting into languages for advanced publications.
 

![Markdown](https://orchid.software/assets/img/ui/markdown.png)
![Markdown2](https://orchid.software/assets/img/ui/markdown2.png)

Example:
```php
SimpleMDE::make('markdown');
```  

## Matrix

The field provides a convenient interface for editing a flat table. For example, you can store information inside a JSON column type:

```php
Matrix::make('options')
    ->columns([
        'Attribute',
        'Value',
        'Units',
    ])
```

Not always the values of the columns can coincide with what needs to be displayed in the headers, for this you can write using the keys:

```php
Matrix::make('options')
    ->columns([
        'Attribute' => 'attr',
        'Value' => 'product_value',
    ])
```

It is possible to indicate the maximum number of lines, upon reaching which the add button will not be available:

```php
Matrix::make('options')
    ->columns(['id', 'name'])
    ->maxRows(10)
```

By default, each cell element has a textarea field, but you can change it to your own fields as follows:

```php
Matrix::make('users')
    ->title('Users list')
    ->columns(['id', 'name'])
    ->fields([
        'id'   => Input::make()->type('number'),
        'name' => TextArea::make(),
    ]),
```

## Code editor

A field for writing program code with the ability to highlight.

![Code](/assets/img/ui/code.png)

Example:
```php
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
Picture::make('picture');
```  

Laravel filesystems are supported:

```php
Picture::make('picture')
    ->storage('s3');
```

## Cropper

Extends Picture and allows you to upload an image and crop to the desired format.

![Cropper](/assets/img/fields/cropper.png)

Example:
```php
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


### File size limit
    
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


## Group

A group is used to combine several fields on one line.

```php
Group::make([
    Input::make('first_name'),
    Input::make('last_name'),
]),
```

In order to determine the width of the fields, you must use one of the proposed methods.

Fields will occupy the entire available screen width.
```php
Group::make([
    // ...
])->fullWidth();
```

Fields will take up as much space as necessary.
```php
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
ModalToggle::make('Add Payment')
    ->modal('addNewPayment')
    ->icon('wallet');
```

Linking example:

```php
Link::make('Google It!')
    ->href('http://google.com');


Link::make('Idea')
    ->route('platform.idea');
```

Example use with method:

```php
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

 
