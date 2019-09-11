---
title: Макеты экрана
description: Отображение внешнего вида элементов пользовательского интерфейса в приложении играет большое значение
extends: _layouts.documentation.ru
section: main
---

Отображение внешнего вида элементов пользовательского интерфейса в приложении играет большое значение, делает приложение
проще в использовании и помогает пользователям интуитивно отображать элементы экрана для выполнения своих задач.

Разделение логики и презентации является один из принципов разработки с ORCHID.
Одним из элементов презентации являются "Layouts" (макеты) которые могут отображаться в различных вариациях, если попытаться объяснить коротко, то получится, что это `view` на стероидах.

## Подход через макеты

Для формирования страницы мы в большинстве случаев мы используем однотипные элементы, например, представим блок который отображает имя, подпись и аватар профиля:

```php
<div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
	<span class="thumb-sm avatar m-r-xs">
        <img src="/avatar/maria.jpg" class="bg-light" alt="Maria">
    </span>
    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
        <h6 class="mb-0">Maria</h6>
        <p class="text-muted mb-1">maria@exaple.com</p>
    </div>
</div>
```

Простое отображение блока с профилем может фигурировать на десятках страниц и если они скопированы, то поддерживать их внешний вид может потребовать много времени, по этому прорабатываются различные варианты повторного использования. Это называется компонентным подходом, вне зависимости от способа доставки и уровня ответственности, практикуется как в `Blade` так и в `React/Vue/Angular`. 

Именно из таких компонентов и состоят слои платформы, явным отличием является только, что необходимо оперировать именно классами, создавая которые вы явно определяете, что принятый параметр `avatar` будет вставлен в теге `<img>`, без необходимости каждый раз править исходный код.


## Таблица

Макет таблицы используется для вывода минимальной информации для просмотра и выборки.

```php
php artisan orchid:table PatientListLayout
```

Пример:
```php
namespace App\Layouts\Clinic\Patient;

use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

use Orchid\Platform\Http\Filters\SearchFilter;
use App\Http\Filters\LastNamePatient;

class PatientListLayout extends Table
{

    /**
     * @var string
     */
    protected $target = 'patients';

    /**
     * @return array
     */
    protected function columns() : array
    {
        return [
            TD::set('last_name','Last name')
                ->align('center')
                ->width('100px')
                ->render(function ($patient) {
                    return '<a href="' . route('platform.clinic.patient.edit',
                            $patient->id) . '">' . $patient->last_name . '</a>';
                }),

            TD::name('first_name')
                ->title('First Name')
                ->sort()
                ->link('platform.clinic.patient.edit', 'id'),
                
            TD::set('phone','Phone')
                ->loadModalAsync('oneAsyncModal', 'savePhone', 'id', 'phone'),
                
            TD::set('email','Email'),
                
            TD::set('created_at','Date of publication'),
               
        ];
    }
}
```

### Доступные методы

- Метод `align()` горизонтальное выравнивание текста, принимает значения: 'left', 'center', 'right'

- Метод `link($route,$key)` добавляет в ячейку ссылку, например на редактирование данной записи.

- Метод `locale()` отображение данных столбца согласно текущему языку локали.

- Метод `loadModalAsync($modal, $method, $options, $text)` добавляет модальное окно к каждой ячейке столбца. Где атрибуты $modal - название модального окна, $method - метод (функция) который отправляет данные через POST запрос, $options дополнительные атрибуты, например id или slug, $text - отображаемое значение ячейки.

- Метод `name($key)` устанавливает имя ключа из массива значения которого отображать в таблице.

- Метод `set($key, $name)` основной метод устанавливает имя ключа из массива и отображаемое название.

- Метод `render(function ($item) { return $item->id})` возможность генерации ячейки согласно функции. В $item передаются данные текущей строки.

- Метод `sort()` добавляет в заголовок возможность сортировки по данному столбцу ([См. HTTP фильтрация и сортировка](https://orchid.software/ru/docs/filters)).

- Метод `width()` явно задает ширину столбца `width('100px')`

### Расширение колонок

Работая с однотипными данными, часто требуется и обрабатывать их одинаковым образом, для того, что бы не дублировать код в слоях имеется возможность расширять класс `TD` собственными методами, для этого необходимо в сервис-провайдере зарегистрировать функцию замыкания.

Пример регистрации:

```php
// AppServiceProvider.php
TD::macro('bool', function () {

    $column = $this->column;

    $this->render(function ($datum) use ($column) {
        return view('bool',[
            'bool' => $datum->$column
        ]);
    });

    return $this;
});
```
Пример шаблона:
```php
// bool.blade.php

@if($bool)
    <i class="icon-check text-success"></i>
@else
    <i class="icon-close text-danger"></i>
@endif
```

Пример использования:
```php
public function grid(): array
{
    return [
        TD::set('status')->bool(),
    ];
}
```


## Строки

Макет строк служит минимальным набором, который чаще всего используется.
Его цель объединять все необходимые поля.

Для создания исполните команду:
```php
php artisan orchid:rows PatientFirstRows
```

Пример:
```php
namespace App\Layouts\Clinic\Patient;

use App\Http\Widgets\AppointmentTypes;
use Orchid\Screen\Field;
use Orchid\Platform\Layouts\Rows;

class Appointment extends Rows
{

    /**
     * @return array
     *
     * @throws \Orchid\Press\EntityTypeException
     */
    protected function fields(): array
    {
        return [

            DateTimer::make()
                ->name('appointment_time')
                ->required()
                ->title('Time'),

            Relationship::make()
                ->name('appointment_type')
                ->required()
                ->title('Appointment type')
                ->handler(AppointmentTypes::class),

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
например, когда требуется показать одно - два поля

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


## Модальные окна

```php
public function layout(): array
{
    return [
        Layout::modal('exampleModal', [
	    Layout::rows([]),
        ]),
    ];
}
```

Модальные окна имеют свойства, размера и названия кнопок которые доступны для изменения:

```php
Layout::modal('exampleModals', [
    Layout::rows([]),
])
    ->title('Заголовок окна')
    ->size(Modal::SIZE_LG)
    ->applyButton(self::APPLY_BUTTON)
    ->closeButton(self::CLOSE_BUTTON),
```

> **Обратите внимание**, при использовании метода **loadModalAsync** содержимое окна может использовать динамические данные, которых нет при первоначальной отображении, для исключения возможных ошибок необходимо делать проверку на существование переменных. Например, в шаблонизаторе Blade это может выглядеть как: `{{ $variable ?? '' }}`.

## Графики

Макет графиков удобный способ графически отображать динамику значений, но он требует некоторой
обработки данных, пример данных из `query`

```php
public function query($patient = null) : array
{
    $charts = [
        [
            'title'  => "Some Data",
            'values' => [25, 40, 30, 35, 8, 52, 17, -4],
        ],
        [
            'title'  => "Another Set",
            'values' => [25, 50, -10, 15, 18, 32, 27, 14],
        ],
        [
            'title'  => "Yet Another",
            'values' => [15, 20, -3, -15, 58, 12, -17, 37],
        ],
    ];
    
    return [
        'charts' => $charts,
    ];
}
```

Для создания исполните команду:
```php
php artisan orchid:chart ChartsLayout
```

Пример макета:
```php
namespace App\Layouts\Clinic\Patient;

use Orchid\Platform\Layouts\Chart;

class ChartsLayout extends Chart
{

    /**
     * @var string
     */
    protected $title = 'DemoCharts';

    /**
     * @var int
     */
    protected $height = 150;

    /**
     * Available options:
     * 'bar', 'line', 
     * 'pie', 'percentage'
     *
     * @var string
     */
    protected $type = 'scatter';

    /**
     * @var array
     */
    protected $labels = [
        "12am-3am",
        "3am-6am",
        "6am-9am",
        "9am-12pm",
        "12pm-3pm",
        "3pm-6pm",
        "6pm-9pm",
        "9pm-12am",
    ];

    /**
     * @var string
     */
    protected $target = 'charts';
}
```


## Набор фильтров

Для группировки фильтров, их сброса и применения, существует отдельный слой `Selection`,
в котором они указываются. 

Для создания исполните команду:
```php
php artisan orchid:selection MySelection
```

Пример класса:
```php
namespace App\Orchid\Layouts;

use Orchid\Platform\Filters\Filter;
use Orchid\Press\Http\Filters\CreatedFilter;
use Orchid\Press\Http\Filters\SearchFilter;
use Orchid\Screen\Layouts\Selection;

class MySelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
          SearchFilter::class,
          CreatedFilter::class
        ];
    }
}
```


## Табы

Табы поддерживают короткий синтаксис через вызов статического метода, 
что не требует создания отдельного класса:

```php
public function layout(): array
{
    return [
        Layout::tabs([
            'Example Tab Table' => TableExample::class,
            'Example Tab Rows'  => RowExample::class,
        ]),
    ];
}
```

Название вкладок будет соответствовать ключам массива

## Столбцы

Аналогично табам:

```php
public function layout(): array
{
    return [
        Layout::columns([
           TableExample::class,
           RowExample::class,
        ]),
    ];
}
```


## Раскрывающийся список


```php
public function layout(): array
{
    return [
        Layout::collapse([
            Input::make('name')
                ->type('text')
                ->title('Name Articles')
        ])->label('More'),
    ];
}
```

## Аккордеон

```php
public function layout(): array
{
    return [
        Layout::accordion([
            'Personal Information' => [
                Layout::rows([
                    Input::make('user.name')
                        ->type('text')
                        ->required()
                        ->title('Name')
                        ->placeholder('Name'),

                    Input::make('user.email')
                        ->type('email')
                        ->required()
                        ->title('Email')
                        ->placeholder('Email'),
                ]),
            ],
            'Billing Address'      => [
                Layout::rows([
                    Input::make('address')
                        ->type('text')
                        ->required()
                        ->title('Адрес доставки')
                        ->placeholder('Ул. Ленина дом 14 оф.162'),
                ]),
            ],
        ]),
    ];
}
```

## Пользовательский шаблон


Вполне ожидаемая ситуация, когда необходимо отобразить собственный шаблон, 
для этого:

```php
public function layout(): array
{
    return [
        Layout::view('myTemplate'),
    ];
}
```

Все данные из метода `query` будут переданы в ваш шаблон.


## Обертка

Промежуточным звеном между "Пользовательским шаблоном" и стандартными слоями может служить "Обёртка", с помощью которой
доступно указывать где именно должны отображаться другие слои.

```php
public function layout(): array
{
    return [
        Layout::wrapper('myTemplate', [
            'foo' => [
                RowLayout::class,
                RowLayout::class,
            ],
            'bar' => RowLayout::class,
        ]),
    ];
}
```

В шаблон `myTemplate` будут переданы переменные `foo` и `bar`, которые содержат уже собранные `View`, которые можно выводить:

```html
<div class="row">
    <div class="col-7 border-right">
        @foreach($foo as $row)
            {!! $row !!}
        @endforeach
    </div>
    <div class="col-5 no-gutter">
        {!! $bar !!}
    </div>
</div>
```

Переменные из `query` так же доступны в шаблоне.


## Расширение слоёв

Класс `Layouts` является группирующим нескольких различных, для того, что бы добавить в него новую возможность достаточно указать её в сервис провайдере как:

```php
use Orchid\Screen\Layouts\Base;
use Orchid\Screen\Repository;
use Orchid\Screen\Layout;

Layout::macro('hello', function (string $name) {
    return new class($name) extends Base
    {
        /**
         * @ string
         */
        public $name;

        /**
         * Hello constructor.
         *
         * @param string $name
         */
        public function __construct(string $name)
        {
            $this->name = $name;
        }

        /**
         * @param Repository $repository
         *
         * @return mixed
         */
        public function build(Repository $repository)
        {
            return view('hello')->with('name', $this->name);
        }

    };
});
```

Тогда в экране вызов будет выглядеть как:

```php
public function layout(): array
{
    return [
        Layout::hello('Alexandr Chernyaev')
    ];
}
```
