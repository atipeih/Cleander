<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //未ログイン
        if(!session()->has('id')) {
            return redirect(url('/login'));
        }
        return $next($request);
    }
}
