<?php

namespace App\Http\Middleware;

use App\Domain\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === UserType::User->value) {
            return $next($request);
        }

        return redirect()->route('unauthorized');
    }
}
