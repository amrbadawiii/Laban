<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\ICustomerService;
use App\Application\Interfaces\IInboundService;
use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IOrderService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\IWarehouseService;
use App\Domain\Enums\OrderStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    protected IOrderService $orderService;
    protected ICustomerService $customerService;
    protected IWarehouseService $warehouseService;
    protected IProductService $productService;
    protected IMeasurementUnitService $measurementUnitService;

    public function __construct(IOrderService $orderService, ICustomerService $customerService, IWarehouseService $warehouseService, IProductService $productService, IMeasurementUnitService $measurementUnitService)
    {
        $this->orderService = $orderService;
        $this->customerService = $customerService;
        $this->warehouseService = $warehouseService;
        $this->productService = $productService;
        $this->measurementUnitService = $measurementUnitService;
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
            ['name' => 'notes', 'type' => 'textarea', 'label' => 'Notes', 'required' => false],
        ];
        $conditions = $request->only(['customer_id', 'warehouse_id', 'order_status']);
        $items = $this->orderService->getAll($conditions, ['*'], ['customer', 'warehouse', 'orderItems.product'])->toArray();
        return view('orders.index', compact('items', 'inputs', 'usePopup', 'title', 'action'));
    }

    public function show(int $id)
    {
        $order = $this->orderService->getById($id, ['customer', 'warehouse', 'orderItems', 'orderItems.product', 'orderItems.measurementUnit'])->toArray();
        return view('orders.show', compact('order'));
    }


    public function createOrder(int $id)
    {
        $usePopup = true;
        $title = 'Order Items';
        $action = route('orders.storeItems', ['id' => $id]);
        $product = $this->productService->getAllWoP([], ['id', 'name'])->toArray();
        $unit = $this->measurementUnitService->getAllWoP([], ['id', 'abbreviation'])->toArray();
        $products = [];
        $units = [];
        foreach ($product as $item) {
            $products[$item['id']] = $item['name'];
        }
        foreach ($unit as $item) {
            $units[$item['id']] = $item['abbreviation'];
        }
        $inputs = [
            ['name' => 'product_id', 'type' => 'select', 'label' => 'Product', 'required' => true, 'options' => $products],
            ['name' => 'measurement_unit_id', 'type' => 'select', 'label' => 'Unit', 'required' => true, 'options' => $units],
            ['name' => 'quantity', 'type' => 'number', 'label' => 'Quantity', 'required' => true],
            ['name' => 'unit_price', 'type' => 'number', 'label' => 'Unit Price', 'required' => true],
        ];
        $order = $this->orderService->getById($id, ['customer', 'warehouse', 'orderItems', 'orderItems.product', 'orderItems.measurementUnit'])->toArray();

        return view('orders.create', compact('order', 'inputs', 'usePopup', 'title', 'action'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $id = $this->orderService->create($data);
        return redirect()->route('orders.createOrder', ['id' => $id['id']])->with('success', 'Order created successfully.');
    }

    public function storeItems(Request $request, int $id)
    {
        $data = $request->all();
        $this->orderService->addOrderItems($id, $data);
        return redirect()->route('orders.createOrder', ['id' => $id])->with('success', 'Order created successfully.');
    }

    public function destroy(int $id)
    {
        $this->orderService->delete($id);
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function deleteItem(int $id)
    {
        $this->orderService->removeOrderItems($id);
        return redirect()->back()->with('success', 'Order item deleted successfully.');
    }

    public function updateStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'order_status' => ['required', Rule::in(OrderStatusEnum::cases())],
        ]);

        $order = $this->orderService->updateStatus($id, $validated['order_status']);

        return redirect()->route('orders.show', $id)->with('status', __('messages.order_status_updated'));
    }

}
