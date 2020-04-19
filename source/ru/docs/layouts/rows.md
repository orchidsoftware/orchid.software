---
title: Строки
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Макет строк служит минимальным набором, который чаще всего используется.
Его цель объединять все необходимые элементы форм.


Строки поддерживают короткую запись без создания отдельного класса,
например, когда требуется показать одно - два поля.

```php
use Orchid\Screen\Layout;
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

Для повторного использования, можно создать класс выполнив команду:

```php
php artisan orchid:rows Appointment
```

В директории `app/Orchid/Layouts`, будет создан новый класс, где можно определять поля:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Platform\Layouts\Rows;
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

Для использования такого класса в экране необходимо передать его название в методе `layouts`:

```php
public function layout(): array
{
    return [
        Appointment::class
    ];
}
```
