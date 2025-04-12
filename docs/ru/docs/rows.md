---
title: Строки
---

Макет строк служит минимальным набором, который чаще всего используется.
Его цель - объединять все необходимые элементы форм.

Строки поддерживают короткую запись без создания отдельного класса,
например, когда требуется показать одно - два поля.

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

Для повторного использования, можно создать класс выполнив команду:

```php
php artisan orchid:rows Appointment
```

В директории `app/Orchid/Layouts`, будет создан новый класс, в котором можно определить поля:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;

class Appointment extends Rows
{
    /**
     * Define the fields for the appointment form.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            DateTimer::make('appointment_time')
                ->required()
                ->title('Time'),

            TextArea::make('doctor_notes')
                ->rows(10)
                ->required()
                ->title('Doctor notes')
                ->help('What did the patient complain about?'),
        ];
    }
}
```

Для использования такого класса в экране необходимо передать его название в метод `layouts`:

```php
public function layout(): array
{
    return [
        Appointment::class
    ];
}
```

## Доступ к данным экрана

Каждый раз, когда отображается слой, ему передаются данные с экрана, чтобы использовать его данные через свойство `query`. Например:

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

Если метод  `query` экрана возвращает указанный ключ, то поле будет отображаться:

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

Помимо простой проверки, Вы также можете получить значение:

```php
$this->query->get('available');
```

Также имеется возможность использовать dot-нотацию:

```php
$this->query->get('user.name');
```

## Повторное использование слоев

Макеты легко использовать повторно, когда поля связаны с отношениями разных моделей. Во время установки у нас есть слой для определения разрешений, который используется сразу на экране редактирования пользователей и ролей. Но иногда необходимо применить один и тот же набор полей с разными значениями. Рассмотрим пример, когда нужно указать адрес.

Такой набор будет и для клиента, и для заказчика, и появится дважды на одной и той же форме (например, в заказе, доставке и накладной). Для решения этой ситуации не нужно создавать и описывать практически одинаковые макеты. Вместо этого давайте добавим логику к одному единственному слою.

```php
namespace App\Orchid\Layouts;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AddressLayout extends Rows
{
    public function __construct(
        private string $prefix,
        private ?string $title = null
    ) {
        $this->prefix = Str::finish($prefix, '.');
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
     * @return Field[]
     */
    protected function addPrefix(array $fields): array
    {
        return collect($fields)
            ->each(fn(Field $field) => $field->set('name', $this->prefix . $field->get('name')))
            ->all();
    }
}

```

Теперь при использовании мы будем передавать значения префикса и заголовка:

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
