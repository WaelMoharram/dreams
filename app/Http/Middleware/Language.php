<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        //dd(session()->all());
        if(session()->has('lang')){
            if(session()->get('lang') == 'ar'){
                App()->setlocale('ar');
            }else if(session()->get('lang') == 'en'){
                App()->setlocale('en');
            }
        }

        return $next($request);
    }
}
