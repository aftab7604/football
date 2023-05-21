<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        } else {
            switch (Auth::user()->user_level) {
                case User::USER_LEVEL['CUSTOMER']:
                    return redirect(route('public.fixtures'));
                    break;
                default:
                    break;
            }
        }
        return $next($request);
    }
}
