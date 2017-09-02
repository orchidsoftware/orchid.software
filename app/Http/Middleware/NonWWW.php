<?php

namespace App\Http\Middleware;

use Closure;

class NonWWW
{

    /**
     * @param         $request
     * @param Closure $next
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle($request, Closure $next)
    {
        if (substr($request->header('host'), 0, 4) == 'www.'){
            $request->setTrustedProxies( [ $request->getClientIp() ] );
            $request->headers->set('host', parse_url(config('app.url'), PHP_URL_HOST));
            return redirect($request->getRequestUri(), 301);
        }
        return $next($request);
    }

}
