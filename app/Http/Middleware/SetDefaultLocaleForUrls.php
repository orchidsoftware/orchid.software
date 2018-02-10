<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SetDefaultLocaleForUrls
{
    public function handle(Request $request, Closure $next)
    {
        $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE', 'en'), 0, 2);

        if (!$request->session()->has('locale')) {
            $locale = $request->session()->get('locale', 'en');
        }

        if (!is_null($request->route('locale'))) {
            $locale = $request->route('locale');
        }

        $request->session()->put('locale', $locale);

        $request->setDefaultLocale($locale);
        App::setLocale($locale);

        URL::defaults([
            'locale' => $locale
        ]);

        return $next($request);
    }
}
