---
title: Marca
description: Personaliza el look para que coincida con tu marca
extends: _layouts.documentation
section: main
---

Hay momentos en los que quieres que la plataforma coincida visualmente  con tu marca.
Después de la instalación, se proporcionan dos entradas de configuración que se encuentran en `config/platform.php`:

```php
'template' => [
    'header' => null,
    'footer' => null,
],
```

Para cambiar el encabezado o el pie de la página, se debe hacer referencia la ubicación de tus propias plantillas blade.


## Cambiar el logo y el nombre

Dentro del directorio: `resources/views` de tu proyecto, añade una nueva carpeta con el nombre `brand` (marca en inglés), luego dentro de esa carpeta crea un nuevo archivo llamado header.blade.php.
Quedando entonces la dirección completa del archivo como: `/resources/views/brand/header.blade.php`.

```php
resources          
└── views
    └── brand
        └── header.blade.php
```

 
Supongamos que estamos creando un sistema para una agencia ficticia de análisis de datos llamada Analitica, haremos entonces los siguientes cambios en el archivo que acabamos de crear:

```php
//resources/views/brand/header.blade.php.

@push('cabeza')
    <link
        href="/favicon.ico"
        id="favicon"
        rel="icono"
    >
@endpush

<p class="h2 n-m font-thin v-center">
    <x-orchid-icon path="database"/>

    <span class="m-l d-none d-sm-block">
        Analítica
        <small class="v-top opacity">Nest</small>
    </span>
</p>
```
 
Para que plantilla creada sea usada por la plataforma en lugar de la estándar, debe especificarse el nombre en el archivo de configuración, tal y como cuando se pasa un argumento al *view helper* de laravel `view('brand.header')`:

  
```php
//`config/platform.php`

'template' => [
    'header' => 'brand.header',
    'footer' => null,
],
```
```

> **Nota.** El archivo de configuración puede ser cacheado, y los cambios no tendrán efecto hasta que el comando `php artisan config:clear` sea ejecutado.


De la misma manera, podemos cambiar la parte inferior de la página, de nuevo crea un archivo nuevo `/recursos/visitas/marca/pie.blade.php` con el siguiente contenido:


``php
<p class="small m-n">
    Copyright {{date('Y')}} <a href="//example.com" target="_blank">"Analytics Nest"</a>
</p>
```

También haciendo cambios en el archivo de configuración:

```php
//`config/platform.php`

'template' => [
    'header' => 'brand.header',
    'footer' => 'brand.footer',
],
```

