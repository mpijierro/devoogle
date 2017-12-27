<?php

namespace Mulidev\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ( ! Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        $user = user();

        if ( ! $user->isAdmin()) {
            return redirect()->route('home-resource');
        }

        return $next($request);
    }
}
