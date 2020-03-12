<?php

namespace App\Http\Middleware;

use Closure;

class Cus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'cus')
    { 
        if (! Auth::guard($guard)->check()) {
            return redirect(route('cus.login'));
        }
        return $next($request);
    }
}
