---
title: Quick Start for Beginners
description: The Quick Start Guide is a basic introduction to the Orchid infrastructure.
---

## Introduction

<!-- 
> **This is an updated manual.** If you need an earlier manual, it is available at [this link](/en/docs/quickstart-old).
-->

Welcome to this tutorial on building an app with Orchid! Admin panels and line of business applications are important for many web applications as they allow to manage content, users, and other data.

In this tutorial, we will be creating a simple task list application to demonstrate some features of Orchid. This task list allows us to track all the tasks we need to complete, just like a traditional “to-do list”.

Before beginning this tutorial, make sure that you have already installed [the framework and package](/en/docs/installation), and started the web server. Let's get started!


> To maximize your learning, we advise typing out the code yourself rather than copying and pasting. This approach helps reinforce your understanding and retention.


## Prepping the Database

### Database Migrations

First, let's use a migration to define a database table to hold all of our tasks. 

```shell
php artisan make:migration create_tasks_table --create=tasks
```

Let's edit this file and add an additional string column for the `name` and boolean column for the `active` of our tasks:


```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
```

To run our migration, we will use the `migrate` Artisan command. 

```bash
php artisan migrate
```


### Eloquent Models


So, let's define a `Task` model that corresponds to our `tasks` database table we just created.


```shell
php artisan make:model Task
```

In the `app/Models` directory, a new file `Task.php` will be created, we will describe the fields as available for filling:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Task extends Model
{
    use HasFactory, AsSource;
}
```

> **Note.** The model has the `AsSource` trait, for convenient handling via dot notation.


## Screen


Now that we have the basic setup out of the way, it's time to add our first [screen](/en/docs/screens) to the application. A screen in Orchid is similar to a controller, but it has a pre-defined structure that is used to define data and events for a single page. The structure of a screen allows us to easily define the layout and behavior of the page, and helps to keep our code organized and maintainable.

To create a new screen, use the `orchid:screen` command. This will generate a new screen class containing the code needed to define data and events for the page. You can then use this class to render the page and handle user interactions.

```bash
php artisan orchid:screen TaskScreen
```

A new file `TaskScreen.php` will be created in the `app/Orchid/Screens` directory:

```php
namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class TaskScreen extends Screen
{
    /**
     * A method that defines all screen input data
     * is in it that database queries should be called,
     * api or any others (not necessarily explicit),
     * the result of which should be an array,
     * appeal to which his keys will be used.
     */
    public function query(): array
    {
        return [];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return "TaskScreen";
    }

    /**
     * Displays a description on the user's screen
     * directly under the heading.
     */
    public function description(): ?string
    {
        return "TaskScreen";
    }
    
    /**
     * Identifies control buttons and events.
     * which will have to happen by pressing
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Set of mappings
     * rows, tables, graphs,
     * modal windows, and their combinations
     */
    public function layout(): array
    {
        return [];
    }
}
```

### Routing


Just like a controller, a screen in Orchid needs to be registered in the route file in order to be accessible to the user. To register a screen, we will need to open the route file for the admin panel (typically `routes/platform.php`) and define a new route for the screen.

To define a new route for a screen, we can use the Screen method provided by Orchid.
This method takes two arguments: the url of the screen, and the class name of the screen.

```php
use App\Orchid\Screens\TaskScreen;

Route::screen('task', TaskScreen::class)->name('platform.task');
```

Now that we have registered a new route for our screen, we can visit the screen in the browser by navigating to the corresponding URL. In this case, since we registered the route as `/admin/task`, we can visit the screen by going to `http://your-app.test/admin/task` in the browser.

When you visit the screen for the first time, it will likely be empty, as we have not yet defined any content or layout for the page. To fill the screen with elements, we will need to define the data and events for the screen, and use them to render the content of the page.

To add a name and description to our screen, we will need to update the `name` and `description` methods as follows:

```php
/**
 * The name is displayed on the user's screen and in the headers
 */
public function name(): ?string
{
    return 'Simple To-Do List';
}

/**
 * The description is displayed on the user's screen under the heading
 */
public function description(): ?string
{
    return 'Orchid Quickstart';
}
```

## Navigation

### Menu


To make it easier for users to access our screen, we can add a new menu item to the admin panel's navigation menu. This will allow users to click on a link in the menu to access the screen, rather than having to manually type the URL into the browser.

To add a new menu item to the navigation menu, we will need to open the `app/Orchid/PlatformProvider.php` file and add a new declaration to the `menu()` method. This declaration will use the `Menu` method provided by Orchid to define a new menu item for our screen.


```php
use Orchid\Screen\Actions\Menu;

/**
 * @return Menu[]
 */
public function menu(): array
{
    return [
        // Other items...
    
        Menu::make('Tasks')
            ->icon('bag')
            ->route('platform.task')
            ->title('Tools')
    ];
}
```

### Breadcrumbs

Now that we have added a menu item for our screen, it will be displayed in the navigation menu and users will be able to access it by clicking on the menu item. In addition to navigating to the screen via the menu, users can also navigate to the screen using breadcrumbs.

Breadcrumbs are a navigation aid that allows users to see their current location within the application and easily return to previous screens. They are typically displayed as a series of links at the top of the page, with the current screen being the last link in the series.

To add breadcrumbs to our screen, we will need to update the route definition for the screen in the `routes/platform.php` file. Specifically, we will need to append the route with the `->breadcrumbs()` method:

```php
use App\Orchid\Screens\TaskScreen;
use Tabuna\Breadcrumbs\Trail;
    
Route::screen('task', TaskScreen::class)
    ->name('platform.task')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push('Task');
    });
```


## Adding Tasks

### Adding Window Modal

To display elements on the workspace, we will need to define them in the `layout` method of the screen class. 
The `layout` method is responsible for returning an array of layout definitions, which define the structure and content of the page.

To add a modal window with an input field for the task name, we can update the `layout` method as follows:


```php
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;

/**
 * The screen's layout elements.
 *
 * @return \Orchid\Screen\Layout[]|string[]
 */
public function layout(): iterable
{
    return [
        Layout::modal('taskModal', Layout::rows([
            Input::make('task.name')
                ->title('Name')
                ->placeholder('Enter task name')
                ->help('The name of the task to be created.'),
        ]))
            ->title('Create Task')
            ->applyButton('Add Task'),
    ];
}
```

This will create a modal window with the title "Create Task". The modal will contain an input field for the task name, with the label "Name".

### Launch Modal

If you visit the screen in the browser, you will notice that the modal window is not displayed, even though we have defined it in the `layout` method. This is because the modal is hidden by default, and must be called in order to be displayed.

To call the modal window, we can add a button to the screen that will trigger the modal when clicked. To do this, we can use the `commandBar` method of the screen class, which defines the basic actions that are available on the screen.

To add a button that calls the modal window, we can update the `commandBar` method as follows:


```php
use Orchid\Screen\Actions\ModalToggle;

/**
 * The screen's action buttons.
 *
 * @return \Orchid\Screen\Action[]
 */
public function commandBar(): iterable
{
    return [
        ModalToggle::make('Add Task')
            ->modal('taskModal')
            ->method('create')
            ->icon('plus'),
    ];
}
```

This will create a button with the label "Add Task" and an icon of a plus sign. 
When the button is clicked, it will open the `taskModal` modal window, and when clicked again, it will close the modal.

In the following sections, we will go over the details of how to define the `create` method and control the behavior of the button.


### Creating the Task

To handle the submission of the modal window form, we will need to define a method that will be called when the form is sent to the server. This method can be used to validate the form data, save the new task to the database, and perform any other necessary actions.

To define the method that will be called when the form is submitted, we can update the screen class as follows:


```php
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @param \Illuminate\Http\Request $request
 *
 * @return void
 */
public function create(Request $request)
{
    // Validate form data, save task to database, etc.
    $request->validate([
        'task.name' => 'required|max:255',
    ]);

    $task = new Task();
    $task->name = $request->input('task.name');
    $task->save();
}
```

Great! We can now successfully create tasks. Next, let's continue adding to our screen by building a list of all existing tasks.

### Displaying Existing Tasks

The query method specifies what data should be shown on the screen. 
This data can be collected or generated within the method. The data is returned in an array,

Let's return a simple sample with the key `tasks`:

```php
use App\Models\Task;

/**
 * Fetch data to be displayed on the screen.
 *
 * @return array
 */
public function query(): iterable
{
    return [
        'tasks' => Task::latest()->get(),
    ];
}
```

Once the data is passed, we can spin through the tasks in our layouts and display them in a table.

To create the task list, we will need to define a new layout for the screen. This layout will use a table component to display the list of tasks, and will include columns for the task name and actions.

To define the task list layout, we can update the layouts method of the screen class as follows:


```php

use Orchid\Screen\TD;

/**
 * The screen's layout elements.
 *
 * @return \Orchid\Screen\Layout[]|string[]
 */
public function layout(): iterable
{
    return [
        Layout::table('tasks', [
            TD::make('name'),
        ]),

        Layout::modal('taskModal', Layout::rows([
            Input::make('task.name')
                ->title('Name')
                ->placeholder('Enter task name')
                ->help('The name of the task to be created.'),
        ]))
            ->title('Create Task')
            ->applyButton('Add Task'),
    ];
}
```

The first argument points to the `tasks` key that we specified in the `query` method. It is this set that will be passed to the table.
And the second one, we pass the set of columns we want to display. The values in them will be automatically set according to the specified property name.

Our task application is almost complete. But, we have no way to delete our existing tasks when they're done. Let's add that next!


## Deleting Tasks

### Adding the Delete Button

So, let's add a delete button to each row of our task listing...

```php
use Orchid\Screen\Actions\Button;

Layout::table('tasks', [
    TD::make('name'),

    TD::make('Actions')
        ->alignRight()
        ->render(function (Task $task) {
            return Button::make('Delete Task')
                ->confirm('After deleting, the task will be gone forever.')
                ->method('delete', ['task' => $task->id]);
        }),
]),
```

### Deleting the Task

To delete a task, we will need to add a method to the screen class that handles the deletion of the task. This method can be called when the delete button is clicked, and can be used to delete the task from the database:

```php
/**
 * @param Task $task
 *
 * @return void
 */
public function delete(Task $task)
{
    $task->delete();
}
```


Congratulations on completing the tutorial! You should now have a good understanding of how to build a basic screen for an Orchid application. The development process for more complex screens will be similar in many aspects, so you should be able to apply the concepts learned in this tutorial to your future projects.

To learn more about the capabilities of Orchid screens, we recommend visiting the [Screens](/en/docs/screens) section of the documentation. This section covers a wide range of topics related to building and customizing screens, including layout customization, form handling, data loading, and more.

We hope you find this tutorial useful and recommends that you also explore the [following lessons available at the link](/en/docs/quickstart-crud).
