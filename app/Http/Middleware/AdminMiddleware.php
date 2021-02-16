<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        /*  Middleware
            https://laravel.com/docs/7.x/middleware
        */
        if(Auth::user() && auth()->user()->role !== 'admin'){
            abort(403, "Only for Admin.");
        }
        return $next($request);
    }
}