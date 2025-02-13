<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('client')->check() || Auth::guard('web')->check()) {
            return $next($request);
        }

        return abort(403, 'Acesso não autorizado.');
    }
}
