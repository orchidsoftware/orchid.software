---
title: Концепция экранов
description: Основные компоненты пользовательского интерфейса
extends: _layouts.documentation
section: main
lang: ru
---

Основным элементом платформы являются экраны, описанные иерархией компоновки, в соответствии с которой
каждый элемент имеет свойства, которые влияют на его внешний вид и поведение.

Проще говоря, то, что пользователь видит на странице и какие действия совершает, описывается в одном классе под названием "Экран". Он не знает откуда берутся данные, это может быть: база данных, API или любые другие внешние источники. Построение внешнего вида основано на предоставленных `шаблонах` (Layouts) и всё, что вам нужно сделать, это лишь определить какие данные будут показаны в том или ином шаблоне.

![Screens](https://orchid.software/assets/img/scheme/screens.jpg)

## Создание

Вы можете создать новый экран, выполнив Artisan команду:

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


Прежде чем быть доступными по прямому URL адресу, экраны, так же как и контроллеры, необходимо зарегистрировать в файле маршрутов `/routes/platform.php`. Записанные в него маршруты будут проходить через 'middleware', указанные в `private` [конфигурации](/ru/docs/configuration). Зарегистрировать каждый экран можно с помощью метода `screen` у `Route`:


```php
use App\Orchid\Screens\Idea;

Route::screen('/idea', Idea::class)->name('platform.idea');
```

Добавление экрана немного отличаться от привычной регистрации, например, `GET` запроса, тем, что вместо одного адреса, регистрируется целая группа. Для наглядности можно выполнить Artisan команду `route:list`:

```php
Method   | URI                      | Name
---------+--------------------------+--------------
GET|POST | dashboard/idea/{method?} | platform.idea
```

Если вы регистрируете несколько маршрутов:
```php
use App\Orchid\Screens\Idea;
use App\Orchid\Screens\IdeaEdit;

Route::screen('/idea/edit', IdeaEdit::class)->name('platform.idea.edit');
Route::screen('/idea', Idea::class)->name('platform.idea');
```
> **Обратите внимание**, Routing Laravel выбирает первый подходящий маршрут.

Написав такие маршруты:
```php
Route::screen('/idea', ...
Route::screen('/idea/edit',...
```
Мы получаем:
```php
URI                           | Name
------------------------------+----------------------
dashboard/idea/{method?}      | platform.idea
dashboard/idea/edit/{method?} | platform.idea.edit
```
`{method?}` - означает необязательный аргумент, который может идти далее.
Соотвественно под него попадает имя "edit" в адресе.
В итоге будет редирект на "dashboard/idea/"

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

Отображение внешнего вида элементов пользовательского интерфейса в приложении играет большое значение, делает приложение
проще в использовании и помогает пользователям интуитивно отображать элементы экрана для выполнения своих задач.

Разделение логики и презентации является одним из принципов разработки с Orchid. Одним из элементов презентации являются "Layouts" (макеты/слои), которые могут отображаться в различных вариациях. Если попытаться объяснить коротко, то получится, что это `view` на стероидах.

Для формирования страницы в большинстве случаев мы используем однотипные элементы, например, представим блок, который отображает имя, подпись и аватар профиля:

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

Простое отображение блока с профилем может фигурировать на десятках страниц и если они скопированы, то поддержание их внешнего вида может потребовать много времени, поэтому прорабатываются различные варианты повторного использования. Это называется компонентным подходом, вне зависимости от способа доставки и уровня ответственности, практикуется как в `Blade` так и в `React/Vue/Angular`.

Именно из таких компонентов и состоят слои платформы, явным отличием является только, что необходимо оперировать именно классами, создавая которые вы явно определяете, что принятый параметр `avatar` будет вставлен в теге `<img>`, без необходимости каждый раз править исходный код.


Макеты отвечают за внешний вид экрана, то есть, как и в каком виде данные будут показаны. Каждый макет может включать в себя другой макет, то есть возможна вложенность. Например, экран делится двумя колонками, в левой поля для заполнения, справа справочная таблица и график.
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

Иногда вы захотите использовать один и тот же макет для разных целей, чтобы уменьшить дублирование кода, вы можете создать макет и передавать собственные параметры в конструктор класса:

```php
namespace App\Orchid\Layouts;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;

class ReusableEditLayout extends Rows
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $prefix;

    /**
     * ReusableEditLayout constructor.
     *
     * @param string $prefix
     * @param string $title
     */
    public function __construct(string $prefix, string $title)
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
            Label::make('label')
                ->title($this->title),

            Input::make($this->prefix . '.address')
                ->required()
                ->title('Address')
                ->placeholder('177A Bleecker Street'),
        ];
    }
}
```

Экземпляры могут быть использованы таким же образом, принимая параметры

```php
public function layout(): array
{
    return [
        Layout::columns([
            new ReusableEditLayout('order.shipping_address', 'Shipping Address'),
            new ReusableEditLayout('order.invoice_address', 'Invoice Address'),
        ]),
    ];
}
```

Более подробно можно прочитать в разделе [Макеты](/ru/docs/layouts/).
