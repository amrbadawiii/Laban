<?php

namespace App\Application\Services;

use App\Application\Interfaces\AuthServiceInterface;
use App\Infrastructure\Interfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle user login.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate login credentials
        $credentials = $request->only('email', 'password');
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // Retrieve authenticated user
            $user = Auth::user();

            // Store user-specific information in the session
            $request->session()->put([
                'user_id' => $user->id,
                'role' => $user->user_type, // Assuming the User model has a 'user_type' attribute
                'warehouse_id' => $user->warehouse_id, // Assuming the User model has a 'warehouse_id' attribute
            ]);

            return redirect()->intended('dashboard')->with('success', 'Welcome back!');
        }

        // Redirect back with error if authentication fails
        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ])->onlyInput('email');
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
