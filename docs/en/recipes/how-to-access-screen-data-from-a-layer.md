---
title: Accessing screen data from layers
description:
extends: _layouts.page
section: main
---

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
