---
title: Rows
---


The line layout serves as the minimum set that is most often used.
Its purpose is to combine all the necessary elements of forms.

The Rows support short writing without creating a separate class,
for example, when you want to show one or two fields.

```php
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;

public function layout(): array
{
    return [
        Layout::rows([
           Input::make('example')
                ->type('text')
                ->title('Example')
        ]),
    ];
}
```

For reuse, you can create a class by running the command:

```php
php artisan orchid:rows Appointment
```

In the directory `app/Orchid/Layouts`, a new class will be created where the fields can be defined:

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

To use such a class in the screen, pass its name in the `layouts` method:

```php
public function layout(): array
{
    return [
        Appointment::class
    ];
}
```


## Accessing screen data


Every time a layer is displayed, it is passed data from the screen to use its data through the `query` property. For example:

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

If the screen's `query` method returns the specified key, then the field will be displayed:

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

In addition to a simple check, you can also get a value:

```php
$this->query->get('available');
```

Access is also available through dot-notation:

```php
$this->query->get('user.name');
```


## Reuse Layers

Layouts are easy to reuse when fields are related to the relations of different models. During installation, we have a layer for defining permissions, which is used immediately at the user and roles editing screen. But sometimes you want to apply the same set of fields with different values. Let's consider an example when you need to specify an address.

Such a set will be both for the client, the customer, and it will appear twice on the same form (for example, in order, delivery and invoice). To solve this situation, you do not need to create and describe almost identical layouts. Instead, let's add logic to one single layer.

```php
namespace App\Orchid\Layouts;

use Illuminate\Support\Str;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AddressLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Prefix for a field name
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
     * Get the fields elements to be displayed.
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
     * @param Field[] $fields
     *
     * @return array
     */
    protected function addPrefix(array $fields): array
    {
        return array_map(function (Field $field) {
            return $field->set('name',
                $this->prefix . $field->get('name')
            );
        }, $fields);
    }
}
```

Now, when used, we will pass the prefix and header values:

```php
public function layout(): array
{
    return [
        Layout::columns([
            new AddressLayout('order.shipping_address', 'Shipping Address'),
            new AddressLayout('order.invoice_address', 'Invoice Address'),
        ]),
    ];
}
```
