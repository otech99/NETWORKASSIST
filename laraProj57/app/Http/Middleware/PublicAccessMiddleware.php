<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PublicAccessMiddleware
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
        if (Auth::check() && (Auth::user()->tipo_account === 'admin'|| Auth::user()->tipo_account === 'staff')) {
            return redirect()->route('dashboard'); //
        }

        return $next($request);
    }
}
