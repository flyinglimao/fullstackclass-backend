<?php

namespace App\Http\Middleware;

use Closure;

class PutApiTag
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
      $request->isApi = true;
        return $next($request);
    }
}
