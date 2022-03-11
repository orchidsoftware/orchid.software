---
title: Icons
description:
---

## Custom Icons

Допустим, мы хотим добавить иконку из популярного Font Awesome. TДля этого выберите подходящий каталог хранения, например, создайте новый каталог `icons` и подкаталог `fontawesome`:

```bash
resources
  - css 
  - icons
      -- fontawesome 
  - js
  - lang
  - views
```

Загрузите в новый каталог соответствующие значки, например, этот [значок блокнота](https://github.com/FortAwesome/Font-Awesome/blob/ce084cb3463f15fd6b001eb70622d00a0e43c56c/svgs/solid/address-book.svg). Затем укажите каталог, в котором нам нужно искать наши изображения, для этого отредактируйте файл конфигурации `config/platform.php`:


```php
'icons' => [
    'fa' => resource_path('icons/fontawesome')
],
```

Все, что мы здесь сделали, это объявили префикс, по которому мы будем обращаться к fa и каталог, в котором расположены файлы.
 Для отображения в компонентах пакета нужно передать только префикс + имя. Например, определение иконки в меню будет выглядеть так:

```php
Menu::make('Example of custom icons')
    ->icon('fa.address-book')
    ->url(#);
```

Вы также можете использовать иконки вне панели администратора [с помощью компонента Blade](https://github.com/orchidsoftware/blade-icons).
