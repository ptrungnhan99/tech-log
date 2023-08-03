<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginMiddleware
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
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return $next($request);
            }
            return redirect('/admin/login')->with('alert', 'Permission denied');
        }
        return redirect('/admin/login')->with('alert', 'Permission denied');
    }
}
