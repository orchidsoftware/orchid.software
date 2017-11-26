<?php namespace App\Http\Widgets;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Orchid\CMS\Core\Models\Menu;
use Orchid\Widget\Service\Widget;

class HeaderMenu extends Widget
{

    /**
     * @var
     */
    public $menu;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->menu = Menu::where('lang', App::getLocale())
            ->whereNull('parent')
            ->where('type', 'header')
            ->with('children')
            ->get();
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return view('partials.header_menu', [
            'menu' => $this->menu,
        ]);
    }

}
