---
title: Legend
extends: _layouts.documentation
---

Макет легенда используется для просмотра одной модели:

![Legend](/img/layouts/legend.png)

Легенда поддерживает краткое написание без создания отдельного класса, например:

```php
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Sight;

public function layout(): array
{
    return [
        Layout::legend('user', [
            Sight::make('id'),
            Sight::make('name'),
            Sight::make('email'),
        ]),
    ];
}
```

Ожидается, что первый аргумент получит ключ, указанный в методе запроса экрана, который должен быть массивом или моделью. А второй — столбцы которые требуется отобразить.

Многие методы у класса  `Sight` класса общие с `TD` (используется в [таблице](/en/docs/table/)).  Например, можно добавить пояснение:

```php
Layout::legend('user', [
    Sight::make('id')->popover('Unique number in the system'),
]),
```

Для того, чтобы использовать собственный шаблон или выполнить дополнительную обработку, вы можете использовать замыкание, переданное в  метод `render` :

```php
Layout::legend('user', [
    Sight::make('id')->render(function (){
        return 'Any html';
    }),
]),
```

Если такая обработка нужна часто, то более подходящим решением будет создать `Blade компонент` ([Подробнее](https://laravel.com/docs/blade#components)) и указать его:

```php
Layout::legend('user', [
    Sight::make('id')->component(IdInformation::class),
]),
```

Компоненты работают так же, как таблица. Вы можете увидеть больше примеров [здесь](/ru/docs/table#components).
