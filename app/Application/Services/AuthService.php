<?php

namespace App\Application\Services;

use App\Application\Interfaces\AuthServiceInterface;
use App\Infrastructure\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
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
        // Validate the login credentials
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // Retrieve authenticated user
            $user = Auth::user();

            // Store user-specific information in the session
            $request->session()->put([
                'user_id' => $user->id,
                'role' => $user->user_type, // Assuming your User model has a 'role' attribute
                'warehouse_id' => $user->warehouse_id, // Assuming your User model has a 'warehouse_id' attribute
            ]);
            dd($user, session(), session('role'));
            // Optionally debug the session for verification
            // dd(session()->all());

            return redirect()->intended('dashboard')->with('success', 'Welcome back!');
        }

        // Redirect back with an error message if credentials fail
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
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
