<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Constants\UserRoleConstants;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->role_id == UserRoleConstants::SUPER_ADMIN) {
                    return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
                } else if(Auth::user()->role_id == UserRoleConstants::EMPLOYER) {
                    return redirect(RouteServiceProvider::EMPLOYER_DASHBOARD);
                } else {
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }
        return $next($request);
    }
}
