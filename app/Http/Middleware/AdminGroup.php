<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminGroup
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
        if ((!Auth::guest() && !$request->user()->hasRole('admin'))
            || Auth::guest()) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
