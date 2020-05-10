---
title: Брендирование платформы
description: Typically, you manage several dozen permits in a typical business process.
extends: _layouts.page
section: main
---


Есть моменты, когда вы хотите, чтобы визуальный стиль платформы соответствовал вашему бренду. 
После установки предоставляется две настройки которые расположены в `config/platform.php`:

```php
'template' => [
    'header' => null,
    'footer' => null,
],
```

Для изменения в шапке страницы или футере в них необходимо указать собственные `blade` шаблоны.


# Смена логотипа и названия

Создадим новую директорию в разделе для шаблонов `brand` и файл `header.blade.php`.
Тогда полный путь будет выглядеть следующим образом `/resources/views/brand/header.blade.php`.

```php
resources          
└── views
    └── brand
        └── header.blade.php
```

 
Допустим, что мы делаем систему для вымышленного аналитического агентства, внесем изменения в только что созданный файл:

```php
@push('head')
    <link
        href="{{ route('platform.resource', ['orchid', 'favicon/orchid-pinned-tab.svg']) }}"
        id="favicon"
        rel="icon"
    >
@endpush

<p class="h2 n-m font-thin v-center">
    <i class="icon-database"></i>
    <span class="m-l d-none d-sm-block">
        Analytics
    <small class="v-top opacity">Nest</small>
    </span>
</p>
```
 
Для того чтобы созданный шаблон использовался вместо стандартного, необходимо указать его в файле конфигурации,
так же как если бы передавали аргумент в помощнике `view('brand.header')`:
  
```php
  'template' => [
      'header' => 'brand.header',
      'footer' => null,
  ],
```

> **Обратите внимание.** Файл конфигурации может быть кэширован и изменения не вступят в силу, до выполнения команды `php artisan config:clear`


Таким же образом мы можем изменить нижнюю часть страницы, снова создадим новый файл `/resources/views/brand/footer.blade.php` со следующим содержанием:

```php
<p class="small m-n">
    © Copyright {{date('Y')}} <a href="//example.com" target="_blank">"Analytics Nest"</a>
</p>
```

Так же внеся изменения в файл конфигурации:

```php
  'template' => [
      'header' => 'brand.header',
      'footer' => 'brand.footer',
  ],
```
