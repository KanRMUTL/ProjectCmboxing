<?php

namespace App\Http\Middleware;

use Closure;

class IsMkhead
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
        if(auth()->check() && $request->user()->permission == 2){
            return $next($request);
        }
        abort(404);
        
    }
}
