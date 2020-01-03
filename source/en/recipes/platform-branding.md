---
title: Брендирование платформы
description: Typically, you manage several dozen permits in a typical business process.
extends: _layouts.page
section: main
---

После установки предоставляется две настройки для брендирования пакета, 
которые расположены в `config/platform.php`:

```php
'template' => [
    'header' => null,
    'footer' => null,
],
```

# Смена логотипа и названия

Изменения вносятся в шапку страницы, для этого необходимо указать собственный `blade` шаблон.

Создадим новую директорию в разделе для шаблонов `brand` и файл `header.blade.php`,
 тогда полный путь будет выглядеть следующим образом `/resources/views/brand/header.blade.php`.
 Для того, что бы созданный шаблон использовался вместо стандартного, необходимо указать его в конфиге,
  так же как если бы передавали аргумент в момощник `view('brand.header')`:
  
```php
  'template' => [
      'header' => 'brand.header',
      'footer' => null,
  ],
```


