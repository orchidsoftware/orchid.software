---
title: Отображение данных
description: Отображайте данные с помощью готовых шаблонов без написания html 
extends: _layouts.documentation.ru
section: main
---

Пакет имеет широкий набор различных полей для заполнения и редактирования контента, но сложно построить
профессиональную систему, состоящую только из одних форм. Конечно, можно написать собственное `html` представление в экране,
но это может потребовать времени и некоторых навыков в дизайне. Мы постарались позаботиться об этом с помощью комплексного решения.


## Трафарет

Трафареты - это готовые наборы для отображения обыденных элементов на экране пользователя, 
состоящие из `blade/html` представления и обязательного интерфейса который абстрагирован от источника информации. 


Например, у нас представлен следующий `blade` шаблон:

```php
Hello {{ $name }}
```

Для того чтобы он работал, мы должны каждый раз передавать значение для переменной `$name`, при этом его формирование может быть разным. Например, если приветстовать пользователя, то не обходимо конкатинировать имя и фамилию. Но мы так же хотим использовать его и для компаний. Тогда мы можем определить интерфейс и релизовать его у каждого класса:


```php
interface Named
{
    public function name(): string;
}

class User extends Model implements Named
{
    public function name(): string
    {
        return $this->first_name . $this->last_name;
    }
}

class Organization extends Model implements Named
{
    public function name(): string
    {
        return $this->name;
    }
}
```

С помощью такого решения мы можем придать шаблону следующий вид:

```php
Hello {{ $model->name() }}
```

И использовать повторно для множества обьектов, не изменяя его каждый раз.
Именно по такому принципу формируеться логика трафаретов.


## Представители (Presenter)

Представитель - это класс только для чтения, который оборачивает другой объект для того, чтобы расширить его функционал. Предоставлет гибкую альтернативу практике наследования с целью расширения функциональности, так же передает вызовы методов объекту, который был обернут, если их нет.

Возьмём предыдущий пример, с методом `name` для пользователя и организации, запись дополнительных методов не лучшее решения для модели, перенесём его в новый класс представителя:


```php
class User extends Model
{
    //...
}

class UserPresenter extends Named
{
    public function name(): string
    {
        return $this->first_name . $this->last_name;
    }
}

// Usage
$user = User::find(1);

$presenter = new UserPresenter($user);
$presenter->name();
```

С помощью такой записи мы можем использовать различных представителей для разных ситуаций, в которых нам нужна модель `User`.


### Cardable

```php
//...
```

### Compactable


```php
//...
```

### Personable


```php
public function query(): array
{
    $user = new class implements Personable {

        public function title(): string
        {
            return 'Jon Jonson';
        }

        public function subTitle(): string
        {
            return 'Seeker of adventures';
        }

        public function url(): string
        {
            return 'https://orchid.software/';
        }

        public function image(): ?string
        {
            return 'https://i.pravatar.cc/200';
        }
    };

    return [
        'user' => $user
    ];
}


public function layout(): array
{
    return [
        new Persona('user'),
    ];
}
```

```php
//...
```

### Searchable


```php
//...
```
