<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $existingLocalizations=['ru','kz','en','cn'];
        if(isset($_COOKIE['localization'])){
            $localization=strtolower($_COOKIE['localization']);
            if(in_array($localization,$existingLocalizations)){
                App::setLocale($request->localization);
            }
            return $next($request);
        }
        App::setLocale('ru');
        return $next($request);
    }
}
