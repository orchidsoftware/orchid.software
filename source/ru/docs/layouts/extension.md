---
title: Расширение слоёв
extends: _layouts.documentation
section: main
lang: ru
menu: layouts
---

Класс `Layouts` является группирующим нескольких различных. Для того чтобы добавить в него новую возможность, достаточно указать её в сервис провайдере как:

```php
use Orchid\Screen\Layout;
use Orchid\Screen\LayoutFactory;
use Orchid\Screen\Repository;


LayoutFactory::macro('hello', function (string $name) {
    return new class($name) extends Layout
    {
        /**
         * @ string
         */
        public $name;

        /**
         * Hello constructor.
         *
         * @param string $name
         */
        public function __construct(string $name)
        {
            $this->name = $name;
        }

        /**
         * @param Repository $repository
         *
         * @return mixed
         */
        public function build(Repository $repository)
        {
            return view('hello')->with('name', $this->name);
        }

    };
});
```

Тогда в экране вызов будет выглядеть как:

```php
use Orchid\Support\Facades\Layout;

public function layout(): array
{
    return [
        Layout::hello('Alexandr Chernyaev')
    ];
}
```
