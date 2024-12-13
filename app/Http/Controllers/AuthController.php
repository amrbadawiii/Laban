<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\AuthServiceInterface;
use App\Application\Interfaces\IWarehouseService;
use App\Application\Interfaces\UserServiceInterface;
use App\Infrastructure\Interfaces\IWarehouseRepository;
use App\Infrastructure\Interfaces\WarehouseRepositoryInterface;
use Illuminate\Http\Request;
use App\Domain\Enums\UserType;

class AuthController extends Controller
{
    protected AuthServiceInterface $authService;
    protected UserServiceInterface $userService;
    protected IWarehouseService $warehouseService;

    public function __construct(
        AuthServiceInterface $authService,
        UserServiceInterface $userService,
        IWarehouseService $warehouseRepository
    ) {
        $this->authService = $authService;
        $this->userService = $userService;
        $this->warehouseRepository = $warehouseRepository;
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        return $this->authService->login($request);
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    /**
     * Show the user creation form (Admin only).
     */
    public function showCreateUserForm()
    {
        $this->authorizeAdmin();

        $warehouses = $this->warehouseService->getAll();
        $userTypes = UserType::reverse();

        return view('auth.create-user', compact('warehouses', 'userTypes'));
    }

    /**
     * Handle user creation (Admin only).
     */
    public function createUser(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'user_type' => 'required|in:' . implode(',', array_keys(UserType::reverse())),
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        $this->userService->createUser($request->all());

        return redirect('dashboard')->with('success', 'User created successfully.');
    }

    /**
     * Ensure only admins can perform the action.
     */
    private function authorizeAdmin()
    {
        if (!auth()->check() || auth()->user()->user_type !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }
    }
}
