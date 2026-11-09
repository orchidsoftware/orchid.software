---
title: Global search
description: Search registered Scout models with model presenters.
---

Global search displays matching models in the header search dialog. Configure Laravel Scout and its driver
before registering a model. Orchid does not provide the old separate search screen or its route.

## Register a model

In `config/orchid.php`, list the models that participate in search:

```php
'search' => [App\Models\Idea::class],
```

Add Scout's `Searchable` trait and Orchid's presenter declaration to the model:

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

## Describe search results

The presenter implements `Orchid\Screen\Contracts\Searchable`. Define the `orchid.ideas.edit` route used below
in your application's `routes/orchid.php`.

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

`perSearchShow()` limits the results displayed for that model group. `image()` may return `null`.
Use `searchQuery()` to enforce tenant visibility and other access restrictions for the current user.
Registering a model does not grant permission to view its records.

Search results appear in the dialog. Users can navigate them with the keyboard and follow the presenter's `url()`.
Do not link to the removed standalone search screen.

The example assumes an `active` column. Configure that attribute as filterable if your Scout driver requires it.
