<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if((Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3)
        //     && key_value_from_json(Auth::user()->role->permissions, Route::currentRouteName()) == true):
        //     // dd(Route::currentRouteName());
        //     return $next($request);
        // else:
        //     // dd(Route::currentRouteName());
        //     return redirect('/');
        // endif;
    }
}
