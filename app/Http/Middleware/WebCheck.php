<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class WebCheck
{

    public function handle($request, Closure $next)
    {
        if (Auth::guard('web')->user() &&
            (string)Auth::guard('web')->user()->status === 'active' &&
            Auth::guard('web')->check()) {
            \App::setLocale(Auth::guard('web')->user()->locale);

            $locale = \App::getLocale();
            return $next($request);
        } else if (Auth::guard('web')->user() &&
            (string)Auth::guard('web')->user()->status === 'inActive') {
            return redirect()->route('web.account-deactivate');
        }
        $locale = 'en';

        return redirect()->route('login');

    }
}
