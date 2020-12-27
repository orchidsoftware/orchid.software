---
title: Таблицы
extends: _layouts.documentation
section: main
lang: ru
---

## Таблицы

Макет таблицы используется для вывода минимальной информации для просмотра и выборки.

![Table](/assets/img/layouts/table.png)


Для создания выполните команду:
```php
php artisan orchid:table PatientListLayout
```

Пример:
```php
namespace App\Layouts\Clinic\Patient;

use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Platform\Http\Filters\SearchFilter;
use App\Http\Filters\LastNamePatient;

class PatientListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'patients';

    /**
     * @return TD[]
     */
    protected function columns() : array
    {
        return [
            TD::set('last_name','Last name')
                ->align('center')
                ->width('100px')
                ->render(function ($patient) {
                    return Link::make($patient->last_name)
                        ->route('platform.clinic.patient.edit', $patient);
                }),

            TD::set('first_name', 'First Name')
                ->sort()
                ->render(function ($patient) {
                    return Link::make($patient->first_name)
                        ->route('platform.clinic.patient.edit', $patient);
                }),

            TD::set('phone','Phone')
                ->render(function ($patient){
                    return ModalToggle::make($patient->phone)
                        ->modal('oneAsyncModal')
                        ->modalTitle('Phone')
                        ->method('saveUser')
                        ->asyncParameters([
                            'id' => $patient->id,
                        ]);
                }),

            TD::set('email','Email'),
            TD::set('created_at','Date of publication'),
        ];
    }
}
```

Таблицы так же поддерживают запись через короткий синтаксис без создания класса:

```php
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

Layout::table('clients', [
    TD::set('name'),
    TD::set('created_at')->sort(),
]);
```

## Ячейки

Таблица является только общей облочкой, для которой необходимо указать классы TD, предназначенные для создания одной ячейки.

```php
use Orchid\Screen\TD;

TD::set('last_name');
```

Метод `set` является основным методом, устанавливает имя ключа из массива и отображаемое название.

```php
TD::set('last_name', 'Last name');
```


### Выравнивание

Вырваниванием содержимого можно управлять спомощью метода `align`:

```php
TD::set('last_name')->align(TD::ALIGN_LEFT);
TD::set('last_name')->align(TD::ALIGN_CENTER);
TD::set('last_name')->align(TD::ALIGN_RIGHT);
```

### Сортировка

Сортировка выборки должна осуществляться в `query` экрана,
для моделей можно использовать автоматическую `http` [сортировку и 
фильтрацию](/ru/docs/filters/#avtomaticheskaya-http-filtratsiya-i-sortirovka)

Для включения активной возможности сортировки по данному столбцу
необходимо указать метод `sort`:

```php
TD::set('last_name')->sort();
```

### Ширина

Управлять шириной ячейки можно используя метод `width`:

```php
TD::set('last_name')->width('100px');
```

### Отображение и скрытие столбцов

По умолчанию пользователь может скрыть для себя любой столбец, но вы можете
запретить делать это указав:

```php
TD::set('last_name')->cantHide();
```

А так же скрыть по умолчанию, но может быть показан по желанию пользователя.

```php
TD::set('last_name')->defaultHidden();
```


### Вывод данных

В некоторый случаях, может потребоваться отобразить комбинированные
 данные, для этого предназначен метод `render`. Он реализует возможность генерации ячейки согласно функции:
 
```php
TD::set('full_name')
    ->render(function ($user) {
        return $user->firt_name . ' ' . $user->last_name;
    });
```

Функция замыкания должна возвращать любое строчное значение:
```php
TD::set('full_name')
    ->render(function ($user) {
        return view('blade_template', [
            'user' => $user
        ]);
    });
```

Обратите внимание, что вы можете использовать поля и действия:

```php
use Orchid\Screen\Actions\Link;

TD::set('full_name')
    ->render(function ($user) {
        return Link::make($user->last_name)
               ->route('platform.user.edit', $user);
    });
```

Иногда может потребоваться получить значение из `query` экрана, а не полагаться только на `target`. Вы можете получить значение следующим образом:

```php
use Orchid\Screen\Actions\Link;

TD::set('price')
    ->render(function ($product) {
        return $product->price + $this->query->get('tax');
    });
```


## Параметры таблицы

Вы можете указать текст, который будет отображён если таблица пуста,
дополнительно указав методы:

```php
/**
 * @return string
 */
protected function iconNotFound(): string
{
    return 'icon-table';
}

/**
 * @return string
 */
protected function textNotFound(): string
{
    return __('There are no records in this view');
}

/**
 * @return string
 */
protected function subNotFound(): string
{
    return '';
}
```

Если строки таблицы кажутся вам не контрастными, то вы можете включить 
`striped` режим:

```php
/**
 * @return bool
 */
protected function striped(): bool
{
    return false;
}
```


## Строка итога

Добавляет итоговую строку внизу таблицы, для этого необходимо определить метод `total` и описать требуемые ячейки. Например:

```php
public function total():array
{
    return [
        TD::set('total')
            ->align(TD::ALIGN_RIGHT)
            ->colspan(2)
            ->render(function () {
                return 'Total:';
            }),

        TD::set('total_count')
            ->align(TD::ALIGN_RIGHT),

        TD::set('total_active_count')
            ->align(TD::ALIGN_RIGHT),
    ];
}
```

Данная строка будет игнорировать указанный `target` смотря на результат `query` экрана:

```php
public function query(): array
{
    return [
        'total_active_count' => '$93 960',
        'total_count' => '$103 783',
        // ...
    ];
}
```


## Расширение колонок

Работая с однотипными данными, часто требуется и обрабатывать их одинаковым образом. Для того чтобы не дублировать код, в слоях имеется возможность расширять класс `TD` собственными методами. Для этого необходимо в сервис-провайдере зарегистрировать функцию замыкания.

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
