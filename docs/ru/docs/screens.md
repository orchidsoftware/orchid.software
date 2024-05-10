---
title: Концепция экранов
description: Основные компоненты пользовательского интерфейса
---

## Введение

Основным элементом платформы являются экраны,  описываемые иерархией макетов, в соответствии с которой
каждый элемент имеет свойства, которые влияют на его внешний вид и поведение.

Проще говоря, то, что пользователь видит на странице и какие действия совершает, описывается в одном классе под названием "Экран". 
Он не знает откуда берутся данные, это может быть: база данных, API или любые другие внешние источники. 
Построение внешнего вида основано на предоставленных `шаблонах` (Layouts) и всё, что вам нужно сделать, это лишь определить, какие данные будут показаны в том или ином шаблоне.


## Создание экранов


Вы можете создать новый экран, выполнив Artisan команду:

```php
php artisan orchid:screen Idea
```

В директории `app/Orchid/Screens` будет создан файл `Idea` со следующим содержанием:

```php
namespace App\Http\Controllers\Screens;

use Illuminate\Http\Request;
use Orchid\Screen\Screen;

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
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands
     *
     * @return array
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views
     *
     * @return array
     */
    public function layout(): array
    {
        return [];
    }
}

```

Класс экрана включает несколько методов, которые можно использовать для определения поведения и внешнего вида экрана. Эти методы включают:

- **query**: Этот метод загружает данные из базы данных или других источников. Он должен возвращать массив данных, которые будут доступны для макетов и представлений экрана.

- **commandBar**: Этот метод используется для определения кнопок и других действий, которые будут отображаться на экране.

- **layout**: Этот метод используется для определения структуры и содержимого экрана. Он должен возвращать массив объектов макета, которые могут использоваться для отображения данных, форм и других элементов на экране.

![Схема иллюстрирует работу экрана](/img/scheme/screens.jpg)

Для использования нового экрана в вашем приложении, вам нужно зарегистрировать его в файле маршрутов.

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
Соответственно под него попадает имя "edit" в адресе.
В итоге будет редирект на "dashboard/idea/"

## Получение данных

Данные для показа на экране определяются в методе `query`, в котором должны происходить выборка или формирование информации.
Передача осуществляется в виде массива, ключи будут доступны в макетах, для их управления.

```php
public function query(): array
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
    use AsSource;
}
```

Пример, при котором в  Layouts будут доступны ключи `order` и `orders`:

```php
public function query(): array
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

public function query(): array
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


## Автозаполнение публичных свойств

Возвращённые из метода `query` данные будут автоматически вставлены в объявленные публичные свойства в соответствии с их именем. Например::


```php
/**
 * @var string
 */
public $message;

public function query(): array
{
    return [
        'message'  => 'Hello World!',
    ];
}

public function name(): ?string
{
    return $this->message;
}
```

При `GET` запросе заголовок страницы будет содержать слова «Hello world!».

## Обработка

В экранах предусмотрены встроенные команды, позволяющие пользователям выполнять различные пользовательские сценарии.
За это отвечает метод `commandBar`, в котором описываются требуемые кнопки управления. 

Например:

```php
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

public function commandBar(): array
{
    return [
        Button::make('Вывести на печать')->method('print'),
    ];
}

public function print(): void
{
   Toast::warning('Привет мир!');
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


### Дублирование действий

В разработке программного обеспечения часто возникает необходимость выполнять похожие действия на нескольких экранах или классах. Например, действие, такое как удаление объекта, может потребоваться как на экране с пагинацией, так и на экране с подробной информацией. Вместо дублирования метода в обоих классах более эффективно использовать концепцию наследования.

PHP предлагает мощную возможность наследования, при которой для сущности может быть создан базовый класс со своими правами доступа и методами. Эти методы могут затем наследоваться конкретными экранами, что позволяет повторно использовать код и уменьшает необходимость в избыточном коде. Это не только повышает эффективность процесса разработки, но также упрощает поддержку кода и его понимание.

### Вызов метода экрана

При работе с экраном все действия пользовательского интерфейса имеют соответствующий метод, который выполняется при вызове. Чтобы явно вызвать нужный метод из JavaScript или шаблона Blade, необходимо выполнить `POST` запрос к специфическому маршруту. Свойство `method` должно быть указано в атрибутах с использованием функции-помощника `route('platform.screen.name', ['method' => 'hello'])`.

Например, чтобы вызвать метод `hello` на экране `platform.screens.users`, можно использовать следующий код:

```php
<form action="{{ route('platform.screens.users', ['method' => 'hello']) }}"
      method="POST"
>
    @csrf
    <button type="submit">Отправить!</button>
</form>
```

Это отправит `POST` запрос на экран `platform.screens.users` с атрибутом метода `hello`, который запустит соответствующий метод на стороне сервера.

Вы также можете использовать это с кнопками пользовательского интерфейса:

```php
use Orchid\Screen\Actions\Button;

Button::make("Привет, мир!"')
    ->action(route('platform.screens.users', [
        'method' => 'hello',
    ]));
```


## Макеты

Макеты отвечают за внешний вид экрана, то есть за то, как и в каком виде будут отображаться данные.

Отображение внешнего вида элементов пользовательского интерфейса в приложении играет большое значение, делает приложение
проще в использовании и помогает пользователям интуитивно отображать элементы экрана для выполнения своих задач.

Разделение логики и презентации является одним из принципов разработки с Orchid. Одним из элементов презентации являются "Layouts" (макеты/слои), которые могут отображаться в различных вариациях. Если попытаться объяснить коротко, то получится, что это `view` на стероидах.

Для формирования страницы в большинстве случаев мы используем однотипные элементы. Например, представим блок, который отображает имя, подпись и аватар профиля:

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

Простое отображение блока с профилем может фигурировать на десятках страниц и если они скопированы, то поддержание их внешнего вида может потребовать много времени. Поэтому прорабатываются различные варианты повторного использования. Это называется компонентным подходом. Вне зависимости от способа доставки и уровня ответственности, практикуется как в `Blade` так и в `React/Vue/Angular`.

Именно из таких компонентов и состоят слои платформы. Явным отличием является только то, что необходимо оперировать именно классами, создавая которые Вы явно определяете, что принятый параметр `avatar` будет вставлен в теге `<img>`, без необходимости каждый раз править исходный код.


Каждый макет может включать в себя другой макет, то есть возможна вложенность. Например, экран разделен на две колонки, в левой поля для заполнения, справа справочная таблица и график.
Вы можете придумать свои примеры вложения.


```php
public function layout(): array
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

Иногда Вы захотите использовать один и тот же макет для разных целей. Чтобы уменьшить дублирование кода, Вы можете создать настраиваемый дизайн. Чтобы передать пользовательские параметры в ваш макет, вы можете использовать конструктор класса для их обработки::

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

Более подробно можно прочитать в разделе "Макеты".


## Дополнительные методы

#### Сообщение валидации

```php
/**
 * Сообщение если форма не валидна.
 */
public function formValidateMessage(): string
{
    return __('Please check the entered data');
}
```

Этот метод возвращает сообщение, если валидация HTML-формы не прошла, например, если какое-то поле обязательно для заполнения.

#### Предотвращение потери данных при переходе

```php
/**
 * Определяет, нужно ли предотвращать потерю данных при попытке перехода.
 */
public function needPreventsAbandonment(): bool
{
    return config('platform.prevents_abandonment', true);
}
```

Никто не хочет потерять данные, которые только что ввел. Для предотвращения этого этот метод запускает механизм, который блокирует обновление или переход с текущей страницы, если на ней были внесены изменения в данные.
