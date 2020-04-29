---
title: Расширение слоёв
extends: _layouts.documentation
section: main
lang: en
menu: layouts
---

The `Layouts` class is grouping several ones; to add a new feature to it, it is enough to specify it in the service provider as:

```php
use Orchid\Screen\Layouts\Base;
use Orchid\Screen\Repository;
use Orchid\Screen\Layout;

Layout::macro('hello', function (string $name) {
    return new class($name) extends Base
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
        protected function build(Repository $repository)
        {
            return view('hello')->with('name', $this->name);
        }

    };
});
```

Then on the screen, the call will look like:

```php
public function layout(): array
{
    return [
        Layout::hello('Alexandr Chernyaev')
    ];
}
```
