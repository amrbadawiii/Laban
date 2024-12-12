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
        $items = $this->customerService->getAll()->toArray();
        return view('customers.index', compact('items')); // Pass customers as an array to the view
    }

    public function show($id)
    {
        $customer = $this->customerService->getById($id)->toArray();
        return view('customers.show', ['customer' => $customer]); // Pass customer as an array to the view
    }

    public function create()
    {
        return view('customers.create'); // Show a form for creating a warehouse
    }

    public function store(Request $request)
    {
        //dd($request->toArray());
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $this->customerService->create($validated);
        return redirect()->route('customers.index')->with('success', 'customer created successfully.');
    }

    public function edit($id)
    {
        $customer = $this->customerService->getById($id)->toArray();
        return view('customers.edit', ['customer' => $customer]); // Pass customer as an array to the view
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $this->customerService->update($id, $validated);
        return redirect()->route('customers.index')->with('success', 'customer updated successfully.');
    }

    public function destroy($id)
    {
        $this->customerService->delete($id);
        return redirect()->route('customers.index')->with('success', 'customer deleted successfully.');
    }
}
