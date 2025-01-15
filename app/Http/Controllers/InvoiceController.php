<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IInvoiceService;
use App\Domain\Enums\InvoiceStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $items = $this->invoiceService->getAll($conditions, ['*'], ['customer', 'warehouse', 'invoiceItems.product'])->toArray();
        return view('invoices.index', compact('items'));
    }

    public function show(int $id)
    {
        $invoice = $this->invoiceService->getById($id, ['customer', 'warehouse', 'invoiceItems', 'invoiceItems.product', 'invoiceItems.measurementUnit'])->toArray();
        return view('invoices.show', compact('invoice'));
    }

    public function destroy(int $id)
    {
        $this->invoiceService->delete($id);
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    public function updateStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'invoice_status' => ['required', Rule::in(InvoiceStatusEnum::cases())],
        ]);

        $quotation = $this->invoiceService->updateStatus($id, $validated['invoice_status']);

        return redirect()->route('invoices.show', $id)->with('status', __('messages.invoice_status_updated'));
    }
}
