<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\ICustomerService;
use App\Application\Interfaces\IQuotationService;
use App\Application\Interfaces\IWarehouseService;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    protected IQuotationService $quotationService;
    protected IWarehouseService $warehouseService;
    protected ICustomerService $customerService;

    public function __construct(IQuotationService $quotationService, IWarehouseService $warehouseService, ICustomerService $customerService)
    {
        $this->quotationService = $quotationService;
        $this->warehouseService = $warehouseService;
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $usePopup = true;
        $title = 'Quotation';
        $action = route('quotations.store');
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
            ['name' => 'quotation_number', 'type' => 'text', 'label' => 'Quotation Number', 'required' => true],
            ['name' => 'quotation_date', 'type' => 'date', 'label' => 'Quotation Date', 'required' => true],
            ['name' => 'expiry_date', 'type' => 'date', 'label' => 'Expiry Date', 'required' => false],
            ['name' => 'quotation_status', 'type' => 'text', 'label' => 'Status', 'required' => true],
            ['name' => 'total_amount', 'type' => 'number', 'label' => 'Total Amount', 'required' => true],
            ['name' => 'notes', 'type' => 'textarea', 'label' => 'Notes', 'required' => false],
        ];

        $conditions = $request->only(['customer_id', 'warehouse_id', 'quotation_status']);
        $items = $this->quotationService->getAll($conditions, ['*'], ['customer', 'warehouse', 'items.product']);
        return view('quotations.index', compact('items', 'inputs', 'usePopup', 'title', 'action'));
    }

    public function show(int $id)
    {
        $quotation = $this->quotationService->getById($id, ['customer', 'warehouse', 'items.product']);
        return view('quotations.show', compact('quotation'));
    }

    public function create()
    {
        return view('quotations.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->quotationService->create($data);
        return redirect()->route('quotations.index')->with('success', 'Quotation created successfully.');
    }

    public function edit(int $id)
    {
        $quotation = $this->quotationService->getById($id, ['items']);
        return view('quotations.edit', compact('quotation'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $this->quotationService->update($id, $data);
        return redirect()->route('quotations.index')->with('success', 'Quotation updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->quotationService->delete($id);
        return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully.');
    }
}
