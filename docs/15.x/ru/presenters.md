---
title: Presenters
description: Форматирование значений модели через Presentable и атрибут UsePresenter.
---

Presenter форматирует значения объекта для отображения. Наследуйте класс от
`Orchid\Presenter\Presenter`. Исходный объект доступен через `$this->entity`.

## Создайте presenter

Выполните `php artisan orchid:presenter CustomerPresenter` и определите значения для представлений:

```php
namespace App\Orchid\Presenters;

use Orchid\Presenter\Presenter;

class CustomerPresenter extends Presenter
{
    public function fullName(): string
    {
        return $this->entity->first_name.' '.$this->entity->last_name;
    }
}
```

## Назначьте presenter модели

Добавьте трейт `Presentable` и атрибут `UsePresenter`:

```php
namespace App\Models;

use App\Orchid\Presenters\CustomerPresenter;
use Illuminate\Database\Eloquent\Model;
use Orchid\Presenter\Presentable;
use Orchid\Presenter\UsePresenter;

#[UsePresenter(CustomerPresenter::class)]
class Customer extends Model
{
    use Presentable;
}
```

Дочерняя модель наследует presenter, пока не объявит собственный атрибут `UsePresenter`.

```php
$customer = Customer::findOrFail(1);
$presenter = $customer->presenter();

$presenter->fullName();
$presenter->fullName;
$presenter->email;
```

Обращение к свойству сначала вызывает одноимённый метод presenter, затем читает свойство исходного объекта.
Базовый presenter не перенаправляет произвольные вызовы методов в модель.

## Выберите presenter для одного вызова

```php
$presenter = $customer->presenter(CompactCustomerPresenter::class);
```

Этот вариант действует только для текущего вызова и не меняет presenter модели по умолчанию.
Если нет атрибута и явного аргумента, `presenter()` выбрасывает `RuntimeException`.

## Преобразуйте коллекцию

```php
$customers = Customer::query()->limit(10)->get()->map->presenter();
```

Для обычного объекта можно вызвать `new CustomerPresenter($object)`.
Для глобального поиска реализуйте [контракт поискового presenter](/ru/docs/global-search).

## Переход с 14.x

Замените импорт `Orchid\Support\Presenter` на `Orchid\Presenter\Presenter`.
Вместо метода-фабрики в модели используйте `Presentable` и `UsePresenter`.
Проверьте presenter, которые полагались на перенаправление методов модели или старые контракты.
