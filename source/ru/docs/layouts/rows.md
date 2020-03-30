---
title: Строки
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Макет строк служит минимальным набором, который чаще всего используется.
Его цель объединять все необходимые поля.

Для создания исполните команду:
```php
php artisan orchid:rows PatientFirstRows
```

Пример:
```php
namespace App\Layouts\Clinic\Patient;

use Orchid\Screen\Field;
use Orchid\Platform\Layouts\Rows;

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

Строки поддерживают короткую запись без создания отдельного класса,
например, когда требуется показать одно - два поля.

```php
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
