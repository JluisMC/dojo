<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Permissions
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
        if((Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
            && key_value_from_json(Auth::user()->permissions, Route::currentRouteName()) == true):
            // dd(Route::currentRouteName());
            return $next($request);
        else:
            // dd(Route::currentRouteName());
            return redirect('/');
        endif;
    }
}
