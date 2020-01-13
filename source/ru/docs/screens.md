---
title: Концепция экранов
description: Основные компоненты пользовательского интерфейса
extends: _layouts.documentation.ru
section: main
---

Основным элементом платформы являются экраны, описанные иерархией компоновки, в соответствии с которой
каждый элемент имеет свойства, которые влияют на его внешний вид и поведение.

Проще говоря, то, что пользователь видит на странице и какие действия совершает, описывается в одном классе под названием "Экран". Он не знает откуда берутся данные, это может быть: база данных, API или любые другие внешние источники. Построение внешнего вида основано на предоставленных `шаблонах` (Layouts) и всё, что вам нужно сделать, это лишь определить какие данные будут показаны в том или ином шаблоне.

![Screens](https://orchid.software/assets/img/scheme/screens.jpg)

## Создание

Вы можете создать новый экран выполнив Artisan команду:

```php
php artisan orchid:screen Idea
```

В директории `app/Orchid/Screens` будет создан файл `Idea` со следующим содержанием:

```php
namespace App\Http\Controllers\Screens;

use Illuminate\Http\Request;
use Orchid\Platform\Screen\Screen;

class Idea extends Screen
{
    /**
     * Display header name
     *
     * @var string
     */
    public $name = 'Idea Screen';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Idea Screen';

    /**
     * Query data
     *
     * @return array
     */
    public function query() : array
    {
        return [];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar() : array
    {
        return [];
    }

    /**
     * Views
     *
     * @return array
     */
    public function layout() : array
    {
        return [];
    }
}

```

## Регистрация в маршрутах


Прежде чем, быть доступными по прямому URL адресу экраны, так же как и контроллеры, необходимо зарегистрировать в файле маршрутов `/routes/platform.php`. Записанные в него маршруты будут проходить через 'middleware' указанные в `private` [конфигурации](/ru/docs/configuration). Зарегистрировать каждый экран можно с помощью метода `screen` у `Route`:


```php
use App\Orchid\Screens\Idea;

Route::screen('/idea', Idea::class)->name('platform.idea');
```

Добавление экрана немного отличаться от привычной регистрации, например, `GET` запроса, тем, что вместо одного адреса, регистрируется целая группа. Для наглядности можно выполнить Artisan команду `route:list`:

```php
Method                      | URI                                  | Name
----------------------------+--------------------------------------+--------------
GET|HEAD|POST|PUT|PATCH|... | dashboard/idea/{method?}/{argument?} | platform.idea
```


## Получение данных

Данные для показа на экране определяются в методе `query`, где должны происходить выборки или формирование информации.
Передача осуществляется в виде массива, ключи будут доступны в макетах, для их управления.

```php
public function query() : array
{
    return [
        'name'  => 'Alexandr Chernyaev',
    ];
}
```

В качестве источника может выступать модель `Eloquent`, для этого необходимо добавить трейт `AsSource` :

```php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use AsSource
}
```

Пример, при котором в  Layouts будут доступны ключи `order` и `orders`:

```php
public function query() : array
{
    return [
        'order'  => Order::find(1),
        'orders' => Order::paginate(),
    ];
}
```

Использование именно моделей `Eloquent` не обязательно, возможно использование массивов с помощью обёртки `Repository`:

```php
//...
use Orchid\Screen\Repository;    
//...

public function query() : array
{
    return [
        'order'      => new Repository([
            'product_id' => 'prod-100',
            'name'       => 'Desk',
            'price'      => 10.24,
            'created_at' => '01.01.2020',
      ]),
    ];
}
```



## Обработка

В экранах предусмотрены встроенные команды, позволяющие пользователям выполнять различные пользовательские сценарии.
За это отвечает метод `commandBar`, в котором описываются требуемые кнопки управления. 

Например:

```php
public function commandBar() : array
{
    return [
        Button::make('Вывести на печать')->method('print'),
    ];
}
```

Класс `Button` отвечает за то, что будет происходить по нажатию на кнопку. В примере выше, при нажатии на кнопку `Вывести на печать`,
будет вызван метод экрана `print`, в Request будут доступны все данные, которые пользователь видел на экране.


```php
// По нажатию будет вызван метод 'create'
use Orchid\Screen\Actions\Button;

Button::make('Новая функция')
    ->method('create');

// По нажатию будете перенаправлены на указанный адрес
use Orchid\Screen\Actions\Link;

Link::make('Внешняя ссылка')
    ->href('http://orchid.software');

// По нажатию будет показано модальное окно (CreateUserModal),
// в котором можно выполнить метод "save"
use Orchid\Screen\Actions\ModalToggle;

ModalToggle::make('Модальное окно')
    ->modal('CreateUserModal')
    ->method('save');
```


## Макеты

Макеты отвечают за внешний вид экрана, то есть, как и в каком виде данные будут показаны.

Каждый макет может включать в себя другой макет, то есть возможна вложенность.
Например, экран делится двумя колонками, в левой поля для заполнения, справа справочная таблица и график.
Вы можете придумать свои примеры вложения.


```php
public function layout() : array
{
    return [
        Layout::columns([
            'Левая колонка' => [
                FirstRows::class,
            ],
            'Правая колонка' => [
                SecondRows::class,
            ],
        ]),
        
        // Модальное окно
        Layout::modal('Appointments', [
            ThirdRows::class,
        ]),
    ];
}
```

Более подробно можно прочитать в разделе [Макеты](/ru/docs/layouts/).
