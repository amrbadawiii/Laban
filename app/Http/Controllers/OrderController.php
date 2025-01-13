<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\ICustomerService;
use App\Application\Interfaces\IOrderService;
use App\Application\Interfaces\IWarehouseService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected IOrderService $orderService;
    protected IWarehouseService $warehouseService;
    protected ICustomerService $customerService;

    public function __construct(IOrderService $orderService, IWarehouseService $warehouseService, ICustomerService $customerService)
    {
        $this->orderService = $orderService;
        $this->warehouseService = $warehouseService;
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $usePopup = true;
        $title = 'Order';
        $action = route('orders.store');
        $warehouse = $this->warehouseService->getAllWoP([], ['id', 'name'])->toArray();
        $customer = $this->customerService->getAllWoP([], ['id', 'first_name'])->toArray();
        $warehouses = [];
        $customers = [];
        foreach ($warehouse as $item) {
            $warehouses[$item['id']] = $item['name'];
        }
        foreach ($customer as $item) {
            $customers[$item['id']] = $item['first_name'];
        }
        $inputs = [
            ['name' => 'warehouse_id', 'type' => 'select', 'label' => 'Warehouse', 'required' => true, 'options' => $warehouses],
            ['name' => 'customer_id', 'type' => 'select', 'label' => 'Customer', 'required' => true, 'options' => $customers],
            ['name' => 'order_number', 'type' => 'text', 'label' => 'Order Number', 'required' => true],
            ['name' => 'order_date', 'type' => 'date', 'label' => 'Order Date', 'required' => true],
            ['name' => 'delivery_date', 'type' => 'date', 'label' => 'Delivery Date', 'required' => false],
            ['name' => 'order_status', 'type' => 'text', 'label' => 'Status', 'required' => true],
            ['name' => 'total_amount', 'type' => 'number', 'label' => 'Total Amount', 'required' => true],
            ['name' => 'notes', 'type' => 'textarea', 'label' => 'Notes', 'required' => false],
        ];
        $conditions = $request->only(['customer_id', 'warehouse_id', 'order_status']);
        $items = $this->orderService->getAll($conditions, ['*'], ['customer', 'warehouse', 'items.product']);
        return view('orders.index', compact('items', 'inputs', 'usePopup', 'title', 'action'));
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
