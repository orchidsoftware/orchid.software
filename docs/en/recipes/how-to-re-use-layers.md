---
title: Reuse Layers
description: Reusing layers for Laravel Orchid
extends: _layouts.page
section: main
---

Layouts are easy to reuse when fields are related to the relations of different models. During installation, we have a layer for defining permissions, which is used immediately at the user and roles editing screen. But sometimes you want to apply the same set of fields with different values. Let's consider an example when you need to specify an address.

Such a set will be both for the client, the customer, and it will appear twice on the same form (for example, in order, delivery and invoice). To solve this situation, you do not need to create and describe almost identical layouts. Instead, let's add logic to one single layer.

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
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
        $this->prefix = $prefix;
        $this->title = $title;
    }

    /**
     * Views.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make($this->prefix . '.address')
                ->required()
                ->title('Address')
                ->placeholder('177A Bleecker Street'),
        ];
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

But this is also inconvenient. Why? Now in the definition, we will think, do we need to end the prefix with a dot? And also, specify strange names through the concatenation `$this->prefix. '.address'`.

Let's fix it! Since the main thing is to return an array of objects, you can modify the fields before returning, as well as take care of the point in the constructor:

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

The main task has been solved. Now, the reuse of a class with one set of fields for the address does not make you think and duplicate it.
