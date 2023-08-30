<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }


    public function handle($request, Closure $next, ...$guards)
    {
        $routesTobeIgnored = [
            route('api.auth.login'),
            route('api.auth.register'),
            route('api.auth.verify'),
            route('api.auth.resend'),
            route('login'),
            route('register'),
        ];

        if ( str_contains($request->url(), 'api') && ! in_array($request->url(), $routesTobeIgnored) ){
            if ( ! Auth::guard('api')->check() ){
                return sendError(
                    'Unauthorized attempt',
                    [],
                    Response::HTTP_UNAUTHORIZED
                );
            }
        } else {
            if (! in_array($request->url(), $routesTobeIgnored) && ! Auth::guard('web')->check() ){
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
