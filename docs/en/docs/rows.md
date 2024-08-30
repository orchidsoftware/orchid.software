---
title: Rows
description: Learn how to create short and concise forms using the Row layout in Orchid. The Row layout combines necessary form elements and is perfect for displaying one or two fields. Find out how to create reusable Row classes and access screen data for conditional field display.
---


The `Row` layout serves as a basic layout that combines all the necessary [elements of a form](/en/docs/field). 
It is useful for creating short and concise forms, such as when you want to show one or two fields.

Here is an example of how to use the `Row` layout:

```php
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;

public function layout(): array
{
    return [
        Layout::rows([
           Input::make('name')
                ->type('text')
                ->title('First name:')
        ]),
    ];
}
```

To make the `Row` layout more reusable, you can create a custom class by running the following command:

```php
php artisan orchid:rows Appointment
```

This will create a new class in the `app/Orchid/Layouts` directory where you can define your fields:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;

class Appointment extends Rows
{

    /**
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            DateTimer::make()
                ->name('appointment_time')
                ->required()
                ->title('Time'),

            TextArea::make()
                ->name('doctor_notes')
                ->rows(10)
                ->required()
                ->title('Doctor notes')
                ->help('What did the patient complain about?'),
        ];
    }
}
```

To use the custom `Row` class in a screen, pass the class name in the `layout` method:

```php
public function layout(): array
{
    return [
        Appointment::class
    ];
}
```

> **Note** that the Row layout is only intended for displaying a small number of fields. For more complex forms, you may want to consider using other layout types such as `Tabs` or `Accordion`.


## Accessing Screen Data



The `Row` layout has access to data from the screen through the `query` property. This allows you to use data from the screen in the fields of the Row layout.

For example, you can use the `query` property to conditionally show or hide a field based on the presence of a specific key:


```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;

class Appointment extends Rows
{

    /**
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('appointment_time')
                ->canSee($this->query->has('available'))
                ->required()
                ->title('Time'),
        ];
    }
}
```

In this example, the `appointment_time` field will only be displayed if the screen's `query` method returns `true` for the `available` key:

```php
/**
 * Query data
 *
 * @return array
 */
public function query() : array
{
    return [
      'available' => true,
    ];
}
```

You can also use the `query` method to retrieve a specific value from the screen data:

```php
$this->query->get('available');
```

The `query` method also supports dot notation for accessing nested data:

```php
$this->query->get('user.name');
```


## Reusing Layouts

Layouts can be easily reused when the fields they contain are related to different models. For example, you may want to use the same set of fields to capture an address for a client, a customer, and an order. Instead of creating and defining multiple almost identical layouts, you can add logic to a single layout to handle this situation.

Here is an example of a reusable `AddressLayout` class that takes a prefix and title as arguments:

```php
namespace App\Orchid\Layouts;

use Illuminate\Support\Str;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AddressLayout extends Rows
{
    /**
     * The title of the group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Prefix for a field name.
     *
     * @var string
     */
    protected $prefix;

    /**
     * ReusableEditLayout constructor.
     *
     * @param string      $prefix
     * @param string|null $title
     */
    public function __construct(string $prefix, string $title = null)
    {
        $this->prefix = Str::finish($prefix, '.');
        $this->title = $title;
    }

    /**
     * Get the fields to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return $this->addPrefix([
            Input::make('address')
                ->required()
                ->title('Address')
                ->placeholder('177A Bleecker Street'),
        ]);
    }

    /**
     * Add the prefix to each field name.
     *
     * @param Field[] $fields
     *
     * @return array
     */
    protected function addPrefix(array $fields): array
    {
        return array_map(fn(Field $field) => $field->set('name', $this->prefix . $field->get('name')), $fields);
    }
}
```

To use the `AddressLayout` class, pass the prefix and title values as arguments:

```php
public function layout(): array
{
    return [
        new AddressLayout('order.shipping_address', 'Shipping Address'),
        new AddressLayout('order.invoice_address', 'Invoice Address'),
    ];
}
```

This allows you to reuse the same layout with different prefixes and titles, saving time and effort in the process.
