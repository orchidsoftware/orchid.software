---
title: Брендирование платформы
description: Настройка внешнего вида, для соответствия вашему бренду
---


Есть моменты, когда вы хотите, чтобы визуальный стиль платформы соответствовал вашему бренду. 
После установки предоставляется две настройки которые расположены в `config/platform.php`:

```php
'template' => [
    'header' => null,
    'footer' => null,
],
```

Чтобы изменить шапку или футер страницы, в них необходимо указать собственные `blade` шаблоны.


## Смена логотипа и названия

Создадим новую директорию `brand` в разделе для шаблонов и файл `header.blade.php`.
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
        href="/favicon.ico"
        id="favicon"
        rel="icon"
    >
@endpush

<div class="h2 d-flex align-items-center">
    @auth
        <x-orchid-icon path="bs.house" class="d-inline d-xl-none"/>
    @endauth

    <p class="my-0 {{ auth()->check() ? 'd-none d-xl-block' : '' }}">
        {{ config('app.name') }}
    </p>
</div>
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
    © Copyright {{date('Y')}} 
    <a href="//example.com" target="_blank">Analytics Nest</a>
</p>
```

Так же внесём изменения в файл конфигурации:

```php
'template' => [
    'header' => 'brand.header',
    'footer' => 'brand.footer',
],
```
> **Примечание**.  Если вы хотите, чтобы текст или изображения для страницы входа и панели отличались, вы можете использовать [Директивы аутентификации](https://laravel.com/docs/blade#authentication-directives).
