---
title: Отображение данных
description: Отображайте данные с помощью готовых шаблонов без написания html 
extends: _layouts.documentation.ru
section: main
---

Пакет имеет широкий набор различных полей для заполнения и редактирования контента, но сложно построить
профессиональную систему, состоящую только из одних форм. Конечно, можно написать собственное `html` представление в экране,
но это может потребовать времени и некоторых навыков в дизайне. Мы постарались позаботиться об этом с помощью комплексного решения "Шаблоны".


## Шаблон


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
