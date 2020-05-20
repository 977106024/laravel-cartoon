<?php

namespace App\Http\Middleware;

use Closure;

class imgBase64
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
        
        // $res = $request -> file('photo');
        return $next($request);
    }
}
