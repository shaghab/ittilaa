<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if ($request->user() === null) {
            return redirect(RouteServiceProvider::LOGIN);
        }

        if(!$request->user()->hasPermissionTo($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
