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
use Orchid\Screen\Fields\Input;

Input::make('name');
``` 


### Пользовательское оформление

Пустые и невыразительные поля для ввода могут запутывать пользователя,
но вы можете помочь, указав заголовок. 

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

Иногда необходимо временно или на постоянной основе скрыть поле из пользовательского интерфейса. Для того чтобы скрыть элемент формы, необходимо использовать метод `canSee` и передать в него значение `false`:

```php
Input::make('name')->canSee(false);
```

Если же Вы хотите отобразить скрытый элемент снова, то нужно использовать метод `canSee` и передать в него значение `true`:

```php
Input::make('name')->canSee(true);
```


> Заметьте, многие методы, такие как `canSee`, `required`, `title`, `help`, `vertical`, `horizontal` и многие другие, доступны почти в каждом `поле` системы.
 
### Типы
 
Input - одно из самых универсальных полей за счет указания типа, поддерживаются  все `html` значения:

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

Более подробно о атрибуте `type` можно узнать на [сайте Mozilla](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input).



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

По умолчанию браузеры не отправляют значения невыбранного поля. Это осложняет установку простых булевых типов. 
Для решения этого есть отдельный метод, при использовании которого значение `false` будет отправлено:

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
    ->options([
        1  => 'Пункт 1',
        2  => 'Пункт 2',
    ])
    ->empty('Не выбрано');

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
     ->searchColumns('author', 'description')
     ->title('Choose your idea');
```

Чтобы установить количество элементов, которые будут перечислены в результате поиска, Вы можете использовать метод chunk, передав количество результатов поиска в качестве параметра:

```php
Relation::make('users.')
    ->fromModel(User::class, 'name')
    ->chunk(20);
```

Опции выбора могут работать с вычисляемыми полями, но только для отображения результата, поиск будет происходить только по одной колонке в базе данных. Для этого используется метод `displayAppend`.

```php
namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function getFullAttribute(): string
    {
        return sprintf('%s (%s)', $this->name, $this->email);
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

## DateRange

Позволяет выбрать диапазон даты (и времени).

Пример:

```php
DateRange::make('open')
    ->title('Opening between');
```           


## TimeZone


Поле для удобного выбора часового пояса:

```php
TimeZone::make('time');
```

Указание конкретных часовых поясов возможно с помощью:

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

Можно установить дополнительные плагины с помощью простого Javascript файла:

```js
document.addEventListener('orchid:quill', (event) => {
    // Object for registering plugins
    event.detail.quill;

    // Parameter object for initialization
    event.detail.options;
});
```

> **Примечание**: Вы можете добавлять пользовательские сценарии и таблицы стилей через файл конфигурации`platform.php`.

Пример для [quill-image-compress](https://github.com/benwinding/quill-image-compress):

В файле `config/platform.php` добавьте следующее в массив `resource.scripts` :

```
"https://unpkg.com/quill-image-compress@1.2.11/dist/quill.imageCompressor.min.js",
"/js/admin/quill.imagecropper.js",
```

В директории `public/js/admin` создайте файл `quill.imagecropper.js` со следующим содержимым:

```js
document.addEventListener('orchid:quill', (event) => {
    // Object for registering plugins
    event.detail.quill.register("modules/imageCompressor", imageCompressor);

    // Parameter object for initialization
    event.detail.options.modules = {
         imageCompressor: {
            quality: 0.9,
            maxWidth: 1000, // default
            maxHeight: 1000, // default
            imageType: 'image/jpeg'
        }
    };
});
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

> **Примечание.** Матрица под капотом делает копирование полей на стороне клиента. Это хорошо работает для простых полей `input/select/etc`, но может не сработать для сложных или составных полей.


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


Поддерживаются файловые системы Laravel:

```php
Picture::make('picture')
    ->storage('s3');
```

Используйте метод `acceptedFiles`, чтобы определить типы файлов, которые должно принимать поле, например:

```php
Picture::make('picture')
    ->acceptedFiles('.jpg');
```

Передаваемая строка представляет собой список   [уникальных спецификаторов типов файлов](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file#unique_file_type_specifiers), разделённый запятыми.


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

Или вы можете установить определенные ограничения, используя `minWidth` / `maxWidth` или `minHeight` / `maxHeight` или использовать удобные методы `minCanvas` / `maxCanvas`

```php
Cropper::make('picture')
    ->minCanvas(500)
    ->maxWidth(1000)
    ->maxHeight(800);
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

Upload позволяет визуализировать и обрабатывать загрузку изображений или обычных файлов. Поле предоставляет удобный и интуитивно понятный интерфейс для работы с файлами, включая поддержку группировки и обработки различных типов файлов.

Чтобы создать элемент загрузки файла, используйте метод `make` класса `Upload` и укажите имя поля:

```php
Upload::make('upload');
```  


Вы можете группировать файлы по различным категориям, используя метод `groups`.
Это особенно полезно, если вам нужно загружать разные типы файлов, такие как документы и изображения.

```php
Upload::make('docs')
    ->groups('documents');

Upload::make('images')
    ->groups('photo');
```  

Чтобы получить определенные файлы через отношение модели:

```php
use Orchid\Attachment\Models\Attachment;

// Один ко многим (с внешним  id)
public function hero()
{
    return $this->hasOne(Attachment::class, 'id', 'hero')->withDefault();
}

// Много ко многим (в таблице нет внешнего идентификатора, его следует загружать с помощью функции groups())
public function documents()
{
    return $this->hasMany(Attachment::class)->where('group','documents');
}
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

Максимальный размер загружаемого файла: 
по умолчанию значения `upload_max_filesize` и `post_max_size` равны 2M , Вы можете изменить их в файле `php.ini` , чтобы установить максимальный размер файла более 2M.
```php
Upload::make('upload')
    ->maxFileSize(1024); // Size in MB 
```


Реализация по умолчанию `accept` проверяет тип или расширение MIME файла по этому списку. Это разделенный запятыми список типов MIME или расширений файлов.

```php
Upload::make('upload')
    ->acceptedFiles('image/*,application/pdf,.psd');
```

Поле загрузки может работать с различными хранилищами, чтобы указать его необходимо передать ключ, указанный в `config/filesystems.php`:

```php
Upload::make('upload')
    ->storage('s3');
```

По умолчанию используется хранилище `public`.


Когда Вы знаете, что файл был загружен ранее, можно воспользоваться поиском по библиотеке:

```php
Upload::make('upload')
    ->media();
```

Добавится новая кнопка с модальным окном для предварительного просмотра загруженных файлов.


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
* `icon('icon-wallet)` - задает иконку для кнопки.
 


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
## NumberRange

Вы можете создавать диапазоны чисел. Особенно полезно для фильтров.
```php
NumberRange::make();
```

Использование с фильтрами:
```php
TD::make()->filter(NumberRange::make())
//or
TD::make()->filter(TD::FILTER_NUMBER_RANGE)
```

Результатом является массив с ключами `min`, `max`.  
