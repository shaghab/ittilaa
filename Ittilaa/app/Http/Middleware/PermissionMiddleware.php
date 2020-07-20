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
        // TODO: later add guest user in session
        if ($request->user() === null) {
            // Get URLs
            $urlCurrent = url()->current();
            $urlBase = url()->to('/');

            // Set the previous url that we came from to redirect to after successful login but only if is internal
            if (($urlCurrent != $urlBase.RouteServiceProvider::LOGIN &&
                $urlCurrent != $urlBase.RouteServiceProvider::REGISTER) && 
                (substr($urlCurrent, 0, strlen($urlBase)) === $urlBase))    {
                session()->put('url.intended', $urlCurrent);
            }

            return redirect(RouteServiceProvider::LOGIN);
        }

        if(!$request->user()->hasPermissionTo($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
