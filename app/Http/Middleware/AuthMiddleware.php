<?php

namespace App\Http\Middleware;

use App\Domain\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Please login to access this resource.']);
        }

        // Set role
        if ($user->user_type === UserType::Admin->value) {
            $request->merge(['role' => 'admin']);
        } elseif ($user->user_type === UserType::User->value) {
            $request->merge(['role' => 'user', 'warehouse_id' => $user->warehouse_id]);
        }

        return $next($request);
    }
}
