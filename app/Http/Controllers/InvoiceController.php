<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IInvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    protected IInvoiceService $invoiceService;

    public function __construct(IInvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(Request $request)
    {
        $conditions = $request->only(['customer_id', 'warehouse_id', 'invoice_status']);
        $items = $this->invoiceService->getAll($conditions, ['*'], ['customer', 'warehouse', 'items.product']);
        return view('invoices.index', compact('items'));
    }

    public function show(int $id)
    {
        $invoice = $this->invoiceService->getById($id, ['customer', 'warehouse', 'items.product']);
        return view('invoices.show', compact('invoice'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->invoiceService->create($data);
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function edit(int $id)
    {
        $invoice = $this->invoiceService->getById($id, ['items']);
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $this->invoiceService->update($id, $data);
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->invoiceService->delete($id);
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
