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

Трафаренты - это готовые наборы, для отображения обыденных элементов на экране пользователя. 
Состоящие из `blade/html` представления и обязательного интерфейса который абстрагирован от источника информации. 


Например, у нас представлен следующий `blade` шаблон:

```php
Hello {{ $name }}
```

Для того, что бы он работал мы должны каждый раз передавать значение для переменной `$name`, при этом его формирование, может быть разным, если приветстовать пользователя, то не обходимо конкатинировать имя и фамилию. Но мы так же хотим использовать его и для кампаний. Тогда мы можем определить интерфейс и релизовать его у каждого класса:


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


По такому принципу формируеться логика трафаретов.


  

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


## Представители (Presenter)

Представитель - это класс только для чтения, который предоставлет гибкую альтернативу практике создания подклассов с целью расширения функциональности.


```php
declare(strict_types=1);

namespace App\Orchid\Presenters;

use Orchid\Screen\Presenter;
use Orchid\Screen\Presenters\Personable;
use Orchid\Screen\Presenters\Searchable;

class UserPresenter extends Presenter implements Searchable, Personable
{
    /**
     * @return string
     */
    public function label(): string
    {
        return 'Users';
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->entity->name;
    }

    /**
     * @return string
     */
    public function subTitle(): string
    {
        return 'Administrator';
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return route('platform.systems.users.edit', $this->entity);
    }

    /**
     * @return string
     */
    public function image(): ?string
    {
        return $this->entity->getAvatar();
    }
}

// Usage
$user = User::find(1);

$presenter = new UserPresenter($user);
$presenter->url();
```


## Cardable

```php
//...
```

## Compactable


```php
//...
```

## Personable


```php
//...
```

## Searchable


```php
//...
```
