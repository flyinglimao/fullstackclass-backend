<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckIsAdmin
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
        if (Auth::user()->isAdmin)
            return $next($request);
        else
            return redirect()->route('home')
                ->with([
                    'admin_error' => '您的權限不夠，您目前只是會員，無法執行此動作'
                ]);
    }
}
