---
title: Расширение колонок
description: Typically, you manage several dozen permits in a typical business process.
extends: _layouts.page
section: main
---

### Расширение колонок

Работая с однотипными данными, часто требуется и обрабатывать их одинаковым образом. Для того чтобы не дублировать код, в слоях имеется возможность расширять класс `TD` собственными методами, для этого необходимо в сервис-провайдере зарегистрировать функцию замыкания.

Пример регистрации:

```php
// AppServiceProvider.php
TD::macro('bool', function () {

    $column = $this->column;

    $this->render(function ($datum) use ($column) {
        return view('bool',[
            'bool' => $datum->$column
        ]);
    });

    return $this;
});
```

Пример шаблона:

```php
// bool.blade.php

@if($bool)
    <i class="icon-check text-success"></i>
@else
    <i class="icon-close text-danger"></i>
@endif
```

Пример использования:

```php
public function grid(): array
{
    return [
        TD::set('status')->bool(),
    ];
}
```
