## Состояние экрана

В PHP, когда мы хотим сохранить промежуточный результат между запросами, обычно используются хранилища, такие как базы данных или быстрые хранилища типа Redis.
Для более простых случаев, можно передать состояние прямо в URL-адресе. Вы наверняка видели это, например, `operation?result=success`. Каждый из этих способов является уместным и вполне применимым.

## Публичные свойства


Однако в Laravel Orchid есть удобное решение для хранения небольшого количества информации, например, модель Eloquent
Это возможно благодаря тому, что каждый запрос передает с собой состояние всех публичных свойств экрана.

Давайте попробуем это на практике и создадим новый экран под названием `StateScreen` с помощью команды Artisan:

```bash
php artisan orchid:screen StateScreen
```

Затем зарегистрируем его в файле маршрута:

```php
use App\Orchid\Screens\StateScreen;

Route::screen('state', StateScreen::class)->name('state');
```

Классическим примером является подсчет количество кликов. Добавим следующий код в только что созданный экран:

```php
<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;

class StateScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'clicks' => 0,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'State';
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Label::make('clicks')->title('Click Count:'),
            ]),
        ];
    }
}
```

Перейдем в браузере на нашу страницу и посмотрим, как выглядит экран. На нем должна быть выведена надпись "Click Count: 0". Добавим в наш экран простой метод, в котором посмотрим на содержимое запроса:

```php
/**
 * The screen's layout elements.
 *
 * @return \Orchid\Screen\Layout[]|string[]
 */
public function layout(): array
{
    return [
        Layout::rows([
            Label::make('clicks')
                ->title('Click Count:'),

            Button::make('Increment Click')
                ->type(Color::DARK)
                ->method('increment'),
        ]),
    ];
}

/**
 * Increment the click count.
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function increment(Request $request)
{
    dd($request->all());
}
```

После нажатия на кнопку "Отправить" вы увидите содержимое запроса. Однако заметьте, что значение кликов отсутствует. В классическом варианте построения серверного приложения мы могли бы добавить скрытое поле формы `<input type="hidden">` и делать редирект с GET параметром `?count=1`.

Однако Orchid имеет удобное решение, позволяющее автоматически сохранять состояние публичных свойств экрана.

```php
class StateScreen extends Screen
{
    /**
     * The number of clicks.
     *
     * @var int
     */
    public $clicks;

    //...

    /**
     * Increment the click count.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function increment(Request $request)
    {
        dd($this->message);
    }
}
```

Теперь, если мы отправим форму, то значение свойства сохранится таким же, каким мы его задали в процессе. В данном примере мы использовали простой тип `int`, но это также можно использовать и для более сложных объектов, таких как модели Eloquent.

> Сохранение больших объемов данных в публичных свойствах экрана может вызвать проблемы с производительностью. Поэтому рекомендуется быть осторожными и избегать хранения большого объема информации в публичных свойствах.

Чтобы обновить состояние экрана, нам достаточно изменить публичное свойство, но перед этим обновим наш `query`, чтобы он возвращал массив с ключом `clicks`, содержащим текущее значение свойства, и если оно отсутствует, устанавливает значение `0`:

```php
class StateScreen extends Screen
{
    /**
     * The number of clicks.
     *
     * @var int
     */
    public $clicks;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'clicks'  => $this->clicks ?? 0,
        ];
    }
}
```

Обновим метод `increment()`, чтобы он увеличивал значение свойства `clicks` на единицу при каждом вызове.

```php
/**
 * Increment the click count.
 */
public function increment()
{
    $this->clicks++;
}
```

Теперь, когда пользователь нажимает кнопку "Increment Click", счетчик кликов будет обновляться. Если вы обновите страницу, счетчик будет сброшен.
