---
title: Глобальный поиск
description: Поиск по зарегистрированным моделям Scout через presenter.
---

Глобальный поиск выводит результаты в диалоге верхней панели. Сначала настройте Laravel Scout и его драйвер.
Отдельный экран поиска и его старый маршрут больше не используются.

## Зарегистрируйте модель

Добавьте модели в `config/orchid.php`:

```php
'search' => [App\Models\Idea::class],
```

Подключите трейт Scout `Searchable` и объявите presenter модели:

```php
namespace App\Models;

use App\Orchid\Presenters\IdeaPresenter;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Orchid\Presenter\Presentable;
use Orchid\Presenter\UsePresenter;

#[UsePresenter(IdeaPresenter::class)]
class Idea extends Model
{
    use Presentable, Searchable;

    public function toSearchableArray(): array
    {
        return ['name' => $this->name, 'active' => (bool) $this->active];
    }
}
```

## Опишите результат поиска

Presenter реализует `Orchid\Screen\Contracts\Searchable`. Маршрут `orchid.ideas.edit` из примера
нужно объявить в `routes/orchid.php` приложения.

```php
namespace App\Orchid\Presenters;

use Laravel\Scout\Builder;
use Orchid\Presenter\Presenter;
use Orchid\Screen\Contracts\Searchable;

class IdeaPresenter extends Presenter implements Searchable
{
    public function label(): string
    {
        return 'Ideas';
    }

    public function title(): string
    {
        return $this->entity->name;
    }

    public function subTitle(): string
    {
        return $this->entity->description ?? '';
    }

    public function url(): string
    {
        return route('orchid.ideas.edit', $this->entity);
    }

    public function image(): ?string
    {
        return null;
    }

    public function searchQuery(?string $query = null): Builder
    {
        return $this->entity->search($query)->where('active', true);
    }

    public function perSearchShow(): int
    {
        return 5;
    }
}
```

`perSearchShow()` ограничивает число результатов в группе модели. `image()` может вернуть `null`.
В `searchQuery()` добавьте ограничения доступа и текущего клиента.
Регистрация модели в поиске не предоставляет пользователю права на её записи.

Результаты появляются в диалоге. Пользователь может выбрать их с клавиатуры и перейти по `url()` presenter.
Не создавайте ссылки на удалённый отдельный экран поиска.

Пример предполагает колонку `active`. Если драйвер Scout требует настройки фильтруемых атрибутов, добавьте её туда.
