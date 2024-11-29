<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\ICustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private ICustomerService $customerService;

    public function __construct(ICustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $items = $this->customerService->getAllCustomers();
        return view('customers.index', compact('items'));
    }

    public function show($id)
    {
        $customer = $this->customerService->getCustomerById($id);
        return view('customers.show', compact('customer'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        $this->customerService->createCustomer($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = $this->customerService->getCustomerById($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        $this->customerService->updateCustomer($id, $validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $this->customerService->deleteCustomer($id);
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
