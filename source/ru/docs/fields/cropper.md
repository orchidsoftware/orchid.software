---
title: Cropper
extends: _layouts.documentation
section: main
lang: ru
---
  
Позволяет загружать изображение и обрезать до нужного формата.

![Cropper](/assets/img/fields/cropper.png)

Пример записи:
```php
Cropper::make('picture');
```  

## Ширина и высота

Для того чтобы контролировать формат, можно указать ширину и высоту необходимого изображения:

```php
Cropper::make('picture')
    ->width(500)
    ->height(300);
```

## Ограничение размера файла

Для ограничения размера загружаемого файла необходимо задать максимальное значение в `MB`

```php
Cropper::make('picture')
    ->maxFileSize(2);
```


## Значение

Контроль возращаемого значения осуществляется с помощью методов:

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




