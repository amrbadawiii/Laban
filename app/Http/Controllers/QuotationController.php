<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IQuotationService;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    protected IQuotationService $quotationService;

    public function __construct(IQuotationService $quotationService)
    {
        $this->quotationService = $quotationService;
    }

    public function index(Request $request)
    {
        $conditions = $request->only(['customer_id', 'warehouse_id', 'quotation_status']);
        $quotations = $this->quotationService->getAll($conditions, ['*'], ['customer', 'warehouse', 'items.product']);
        return view('quotations.index', compact('quotations'));
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
