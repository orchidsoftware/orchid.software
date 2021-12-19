---
title: Элементы формы
description: Поля используются для генерации вывода шаблона формы заполнения и редактирования
---

Поля используются для генерации вывода шаблона формы заполнения и редактирования.

> Не стесняйтесь добавлять свои поля, например, для использования удобного редактора для вас или любых компонентов.
 
## Input

Является одним из разносторонних элементов формы и позволяет создавать разные части интерфейса и обеспечивать взаимодействие с пользователем. Главным образом предназначен для создания текстовых полей.

![Input](/img/fields/input.png)
 
Пример записи:
```php
Input::make('name');
``` 


### Пользовательское оформление

Пустые и невыразительные поля для ввода могут запутывать пользователя,
но вы можете помочь с помощью указания заголовка. 

```php
Input::make('name')
    ->title('First name');
```

Когда требуется более подробно описать предназначение поля,
тогда можно использовать подсказку:

```php
Input::make('name')
    ->help('What is your name?');
```

Если описание поля очень специфическое и требуется большое описание, 
можно использовать тултип, который будет показан в качестве всплывающего окна:

```php
Input::make('name')
    ->popover('Tooltip - hint that user opens himself.');
```

Горизонтальное или вертикальное представление:

```php
Input::make('name')->vertical();
```

```php
Input::make('name')->horizontal();
```

### Обязательное для заполнения

Иногда вам может потребоваться указать поле обязательным к заполнению,
для этого необходимо вызвать метод `required`:

```php
Input::make('name')
    ->type('text')
    ->required();
```


### Скрытие полей

```php
Input::make('name')->canSee(true);
Input::make('name')->canSee(false);
```

> Заметьте, многие методы, такие как `canSee`, `required`, `title`, `help`, `vertical`, `horizontal` и многие другие, доступны почти в каждом `поле` системы.
 
### Типы
 
Одно из самых универсальных полей за счет указания типа, поддерживаются  все `html` значения:

> **Обратите внимание**. Поддержка новых HTML5 атрибутов полностью зависит от используемого браузера.

Текстовое поле. Предназначено для ввода символов с помощью клавиатуры.
```php
Input::make('name')->type('text');
```

Поле для ввода имени файла, который пересылается на сервер.	
```php
Input::make('name')->type('file');
```

Скрытое поле.
```php
Input::make('name')->type('hidden');
```

Виджет для выбора цвета.
```php
Input::make('name')->type('color');
```

Для адресов электронной почты.
```php
Input::make('name')->type('email');
```

Ввод чисел.
```php
Input::make('name')->type('number');
```

Ползунок для выбора чисел в указанном диапазоне.
```php
Input::make('name')->type('range');
```

Для указания веб-адресов.
```php
Input::make('name')->type('url');
```

Более подробно о типах атрибутов можно узнать на [сайте Mozilla](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input).



### Маска для ввода значений
 
Отлично подходит если значения должны быть записаны в стандартном виде, например ИНН или номер телефона

Пример записи:
```php
Input::make('phone')
    ->mask('(999) 999-9999')
    ->title('Номер телефона');
```   

В маску можно передавать массив с параметрами, например:


```php
Input::make('price')
    ->title('Стоимость')
    ->mask([
     'mask' => '999 999 999.99',
     'numericInput' => true
    ]);
```   

```php
Input::make('price')
    ->title('Стоимость')
    ->mask([
        'alias' => 'currency',
        'prefix' => ' ',
        'groupSeparator' => ' ',
        'digitsOptional' => true,
    ]);
```   

Все доступные параметры *Inputmask* можно посмотреть [здесь](https://github.com/RobinHerbots/Inputmask#options).


       
## TextArea

Поле `textarea` представляет собой элемент формы для создания области, в которую можно вводить несколько строк текста. 
В отличие от тега `input` в текстовом поле допустимо делать переносы строк, они сохраняются при отправке данных на сервер.

Пример записи:
```php
TextArea::make('description');
```    

Вы можете задать необходимое количество строк с помощью метода `rows`:

```php
TextArea::make('description')
    ->rows(5);
```

 
## CheckBox
 
Элемент графического пользовательского интерфейса, позволяющий пользователю управлять параметром с двумя состояниями — ☑ включено и ☐ выключено.


Пример записи:
```php
CheckBox::make('free')
    ->value(1)
    ->title('Free')
    ->placeholder('Event for free')
    ->help('Event for free');
```    

По умолчанию браузеры не отправляют значения не выбранного поля. Это осложняет установку простых булевых типов. Для решения этого есть отдельный метод, при котором значение `false` будет отправлено:

```php
CheckBox::make('enabled')
    ->sendTrueOrFalse();
```

## Select

Простой выбор из списка массива:

```php
Select::make('select')
    ->options([
        'index'   => 'Index',
        'noindex' => 'No index',
    ])
    ->title('Select tags')
    ->help('Allow search bots to index');
```

Работа с источником:

```php
Select::make('user')
    ->fromModel(User::class, 'email');
```

Источник с условием:
```php
Select::make('user')
    ->fromQuery(User::where('balance', '!=', '0'), 'email');
```

Изменение ключа:
```php
Select::make('user')
    ->fromModel(User::class, 'email', 'uuid');
```

Возможны ситуации, когда необходимо добавить некоторое значение, которое означает, что поле не выбрано. 
Для этого можно использовать метод `empty`:

```php
// Для массива
Select::make('user')
    ->empty('Не выбрано')
    ->options([
        1  => 'Пункт 1',
        2  => 'Пункт 2',
    ]);

// Для источника
Select::make('user')
    ->fromModel(User::class, 'name')
    ->empty('Не выбрано');
```

> **Обратите внимание**, что `empty` вызывается позднее заполняющих методов, иначе добавленное значение будет перезаписано.

Метод `empty` так же принимает и второй аргумент, отвечающий за значение:

```php
Select::make('user')
    ->empty('Не выбрано', 0)
    ->options([
        1  => 'Пункт 1',
        2  => 'Пункт 2',
    ]);
```

## Relation


Поля отношения могут подгружать динамические данные, это хорошее решение, если вам нужны связи.

```php
Relation::make('idea')
    ->fromModel(Idea::class, 'name')
    ->title('Выберите свою идею');
```

Для множественного выбора примените метод `multiple()`

```php
Relation::make('ideas.')
    ->fromModel(Idea::class, 'name')
    ->multiple()
    ->title('Выберите свои идеи');
```

> **Примечание.** Обратите внимание на точку в конце имени. Она необходима для того, чтобы показать ожидаемость массива. Как если бы это был `HTML` код `<input name='ideas[]'>`

Для модификации загрузки можно использовать указание на `scope` модели,
например, взять только активные:

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }
}
```

```php
Relation::make('idea')
    ->fromModel(Idea::class, 'name')
    ->applyScope('active')
    ->title('Выберите свою идею');
```

Вы также можете передавать в метод дополнительные параметры:

```php
Relation::make('idea')
    ->fromModel(Idea::class, 'name')
    ->applyScope('status', 'active')
    ->title('Выберите свою идею');
```
Вы можете добавить одно или несколько полей, по которым будет дополнительно осуществляться поиск:

```php
Relation::make('idea')
    ->fromModel(Idea::class, 'name')
    ->searchColumns('author')
    ->title('Выберите свою идею');
```

Опции выбора могут работать с вычисляемыми полями, но только для отображения результата, поиск будет происходить только по одной колонке в базе данных. Для этого используется метод `displayAppend`.

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @return string
     */
    public function getFullAttribute(): string
    {
        return $this->attributes['name'] . ' (' . $this->attributes['email'] . ')';
    }
}
```

Для указания отображаемого поля необходимо:

```php
Relation::make('users.')
    ->fromModel(User::class, 'name')
    ->displayAppend('full')
    ->multiple()
    ->title('Select users');
```


## DateTime


Позволяет выбрать дату и время.

![Datatime](/img/ui/datatime.png) 


Пример записи:
```php
DateTimer::make('open')
    ->title('Opening date');
```           

Разрешить прямой ввод:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->allowInput();
```           

**Обратите внимание**, что установка поля обязательным может быть только при условии прямого ввода:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->allowInput()
    ->required();
```


Формат данных:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->format('Y-m-d');
```

Пример, для отображения в 24-ом формате:

```php
DateTimer::make('open')
    ->title('Opening date')
    ->format24hr();
```

Календарь со временем:

```php
DateTimer::make('open')
    ->title('Opening time')
    ->enableTime();
```

Выбор только времени:

```php
DateTimer::make('open')
    ->title('Opening time')
    ->noCalendar()
    ->format('h:i K');
```


## TimeZone


Поле для удобного выбора часового пояса:

```php
TimeZone::make('time');
```

Возможно указание конкретных временных зон, используя:

```php
use DateTimeZone;

TimeZone::make('time')
    ->listIdentifiers(DateTimeZone::ALL); 
```

По умолчанию принимает значение `DateTimeZone::ALL`, но возможны и другие:

```php
DateTimeZone::AFRICA;
DateTimeZone::AMERICA;
DateTimeZone::ANTARCTICA;
DateTimeZone::ARCTIC;
DateTimeZone::ASIA;
DateTimeZone::ATLANTIC;
DateTimeZone::AUSTRALIA;
DateTimeZone::EUROPE;
DateTimeZone::INDIAN;
DateTimeZone::PACIFIC;
DateTimeZone::UTC;
DateTimeZone::ALL_WITH_BC;
DateTimeZone::PER_COUNTRY;
```

С представлением переменных зон можно ознакомиться в документации [PHP](https://www.php.net/manual/ru/class.datetimezone.php).


## HTML редактор Quill

Такой редактор позволяет вставлять рисунки, таблицы, указывать стили оформления текста, видео.

Пример записи:
```php
Quill::make('html');
``` 

Доступно 6 групп элементов управления:

```php
Quill::make('html')
    ->toolbar(["text", "color", "header", "list", "format", "media"]);
``` 


## Markdown редактор

Редактор для облегчённого языка разметки,
 созданный с целью написания максимально читаемого и удобного для правки текста, но пригодного для преобразования в языки для продвинутых публикаций.
 

![Markdown](/img/ui/markdown.png)
![Markdown2](/img/ui/markdown2.png)

Пример записи:
```php
SimpleMDE::make('markdown');
```  

## Matrix

Поле предоставляет удобный интерфейс для редактирования плоской таблицы. 
Например, вы можете хранить информацию внутри столбца типа JSON:

```php
Matrix::make('options')
    ->columns([
        'Attribute',
        'Value',
        'Units',
    ])
```

Не всегда значения столбцов могут совпадать с тем, что нужно отображать в заголовках,
 для этого вы можете написать, используя ключи:

```php
Matrix::make('options')
    ->columns([
        'Attribute' => 'attr',
        'Value' => 'product_value',
    ])
```

Возможно указание максимального количества строк, при достижении которого кнопка добавления не будет доступна:

```php
Matrix::make('options')
    ->columns(['id', 'name'])
    ->maxRows(10)
```

По умолчанию каждый элемент ячейки имеет поле textarea, но вы можете изменить
 его на свои собственные поля следующим образом:

```php
Matrix::make('users')
    ->title('Users list')
    ->columns(['id', 'name'])
    ->fields([
        'id'   => Input::make()->type('number'),
        'name' => TextArea::make(),
    ]),
```


## Редактор кода


Поле для записи программного кода с возможностью подсветки.

![Code](/img/ui/code.png)


Пример записи:
```php
Code::make('code');
```    

Для указания подцветки кода под конкретный язык программирования можно использовать метод `language()`.


```php
 Code::make('code')
     ->language(Code::CSS);
```

Доступны следующие языки:

* Markup - `markup`, `html`, `xml`, `svg`, `mathml`
* CSS - `css`
* C-like - `clike`
* JavaScript - `javascript`, `js`


Поддерживается указание количества строк:

```php
Code::make('code')
    ->lineNumbers();
```


## Picture

Позволяет загружать изображение.


Пример записи:
```php
Picture::make('picture');
```  


## Cropper


Позволяет загружать изображение и обрезать до нужного формата.

![Cropper](/img/fields/cropper.png)

Пример записи:
```php
Cropper::make('picture');
```  

### Ширина и высота

Для того чтобы контролировать формат, можно указать ширину и высоту необходимого изображения:

```php
Cropper::make('picture')
    ->width(500)
    ->height(300);
```

### Ограничение размера файла

Для ограничения размера загружаемого файла необходимо задать максимальное значение в `MB`

```php
Cropper::make('picture')
    ->maxFileSize(2);
```


### Значение

Контроль возвращаемого значения осуществляется с помощью методов:

```php
Cropper::make('picture')
    ->targetId();
```
Будет возвращён порядковый номер (`id`) записи `Attachment`.

```php
Cropper::make('picture')
    ->targetRelativeUrl();
```
Вернёт относительный путь до изображения.

```php
Cropper::make('picture')
    ->targetUrl();
```
Вернёт абсолютный путь до изображения.



## Upload


Визуализирует загрузку для изображений или обычных файлов.

Пример записи:
```php
Upload::make('upload');
```  

```php
Upload::make('docs')
    ->groups('documents');

Upload::make('images')
    ->groups('photo');
```  

Может использоваться для ограничения максимального количества файлов, которые будут обрабатываться:

```php
Upload::make('upload')
    ->maxFiles(10);
```

Определяет количество параллельных загрузок для обработки файлов:
```php
Upload::make('upload')
    ->parallelUploads(2);
```

Максимальный объём загружаемого файла:

```php
Upload::make('upload')
    ->maxFileSize(1024);
```

Реализация по умолчанию `accept` проверяет тип или расширение MIME файла по этому списку. Это разделенный запятыми список типов MIME или расширений файлов.

```php
Upload::make('upload')
    ->acceptedFiles('image/*,application/pdf,.psd');
```

Поле загрузки может работать с различными хранилищами, чтобы указать его необходимо передать ключ указанный в `config/filesystems.php`:

```php
Upload::make('upload')
    ->storage('s3');
```

По умолчанию используется хранилище `public`.


## Group

Группа используется для объединения нескольких полей на одной строке.

```php
Group::make([
    Input::make('first_name'),
    Input::make('last_name'),
]),
```

Для того чтобы определить ширину полей, необходимо использовать один из предложенных методов.

Поля будут занимать всю доступную ширину экрана.
```php
Group::make([
    // ...
])->fullWidth();
```

Поля будут занимать столько места, сколько необходимо.
```php
Group::make([
    // ...
])->autoWidth();
```


## Кнопка/Ссылка

В определенных случаях необходимо добавить кнопку для вызова модального окна, простую ссылку или добавить кнопку 
отправки формы в конце экрана. 
Для таких случаев существует поле `Button`. Поле `Button` не может иметь какого либо 
значения и не передается при сохранении. Оно может быть использовано для вызова модального окна определенного на экране
и для добавления простой ссылки в форме.

Пример использования с модальным окном `addNewPayment` добавленного ранее на экран: 

```php
ModalToggle::make('Add Payment')
    ->modal('addNewPayment')
    ->icon('wallet');
```

Пример использования со ссылкой:

```php
Link::make('Google It!')
    ->href('http://google.com');

Link::make('Idea')
    ->route('platform.idea');
```

Пример использования с методом:

```php
Button::make('Google It!')
    ->method('goToGoogle');
```

Доступные модификаторы:

* `right()` - позиционирование элемента по правому краю экрана.
* `block()` - позиционирование элемента по всей ширине экрана.
* `class('class-names')` - переписывает стандартные классы для кнопки.
* `method('methodName')` - при клике форма будет отправлена на заданный метод в рамках текущего экрана.
* `icon('wallet)` - задает иконку для кнопки.
 


## Dropdown

Вы можете легко создать кнопку действия DropDown, объединяющую все остальные действия.
Например, создать типичный раскрывающийся список из трех точек:

```php
DropDown::make()
    ->icon('options-vertical')
    ->list([
        Link::make(__('Edit'))
            ->route('platform.systems.users.edit', $user->id)
            ->icon('pencil'),
        Button::make(__('Delete'))
            ->method('remove')
            ->icon('trash')
            ->confirm(__('Are you sure you want to delete the user?'))
            ->parameters([
                'id' => $user->id,
            ]),
    ]);
```
