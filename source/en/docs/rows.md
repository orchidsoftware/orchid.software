---
title: Rows
extends: _layouts.documentation
section: main
lang: en
---


The line layout serves as the minimum set that is most often used.
Its purpose is to combine all the necessary elements of forms.


Strings support short writing without creating a separate class,
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
