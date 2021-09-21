<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUser
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
        if (Auth::guard('user')->check()) {  // if he already registered and have account

            if(Auth::user() -> email_verified_at == null){

                return redirect(RouteServiceProvider::VERIFIED);

            }

        }
        return $next($request);
    }
}
