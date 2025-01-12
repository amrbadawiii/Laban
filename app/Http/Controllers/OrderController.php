<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected IOrderService $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $conditions = $request->only(['customer_id', 'warehouse_id', 'order_status']);
        $orders = $this->orderService->getAll($conditions, ['*'], ['customer', 'warehouse', 'items.product']);
        return view('orders.index', compact('orders'));
    }

    public function show(int $id)
    {
        $order = $this->orderService->getById($id, ['customer', 'warehouse', 'items.product']);
        return view('orders.show', compact('order'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->orderService->create($data);
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(int $id)
    {
        $order = $this->orderService->getById($id, ['items']);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $this->orderService->update($id, $data);
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->orderService->delete($id);
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
