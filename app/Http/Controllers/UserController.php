<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IUserService;
use App\Application\Interfaces\IWarehouseService;
use App\Domain\Enums\UserType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserService $userService;
    private IWarehouseService $warehouseService;

    public function __construct(IUserService $userService, IWarehouseService $warehouseService)
    {
        $this->userService = $userService;
        $this->warehouseService = $warehouseService;
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $items = $this->userService->getAll()->toArray();

        return view('users.index', compact('items'));
    }

    public function show(int $id)
    {
        $user = $this->userService->getById($id)->toArray();

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $warehouses = $this->warehouseService->getAllWoP()->toArray();
        foreach (UserType::cases() as $userType) {
            $userTypes[$userType->value] = $userType->name;
        }

        return view('users.create', compact('warehouses', 'userTypes'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'warehouse_id' => 'required|exists:warehouses,id',
            'user_type' => 'required|in:user,admin',
        ]);

        $data = $request->all();
        $this->userService->createUser($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $user = $this->userService->getById($id);
        $warehouses = $this->warehouseService->getAllWoP()->toArray();
        foreach (UserType::cases() as $userType) {
            $userTypes[$userType->value] = $userType->name;
        }
        return view('users.create', compact('user', 'warehouses', 'userTypes'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'warehouse_id' => 'required|exists:warehouses,id',
            'user_type' => 'required|in:user,admin',
        ]);

        $data = $request->except(['password_confirmation']);
        if (empty($data['password'])) {
            unset($data['password']); // Avoid updating the password if not provided
        }

        $this->userService->updateUser($id, $data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->userService->delete($id);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
