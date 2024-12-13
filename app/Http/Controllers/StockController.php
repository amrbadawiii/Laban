<?php

namespace App\Http\Controllers;

use App\Application\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private StockService $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Display a listing of the stocks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $items = $this->stockService->getAll()->toArray();
        //dd($items);
        return view('stocks.index', compact('items'));
    }

    /**
     * Show the form for creating a new stock.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Store a newly created stock in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'warehouse_id' => 'required|integer',
            'quantity' => 'required|numeric',
        ]);

        $this->stockService->create($validated);

        return redirect()->route('stocks.index')->with('success', 'Stock created successfully.');
    }

    /**
     * Display the specified stock.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $stock = $this->stockService->getById($id)->toArray();

        if (!$stock) {
            abort(404, 'Stock not found');
        }

        return view('stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified stock.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $stock = $this->stockService->getById($id)->toArray();

        if (!$stock) {
            abort(404, 'Stock not found');
        }

        return view('stocks.edit', compact('stock'));
    }

    /**
     * Update the specified stock in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'quantity' => 'sometimes|required|numeric',
            'warehouse_id' => 'sometimes|required|integer',
        ]);

        $updated = $this->stockService->update($id, $validated);

        if (!$updated) {
            return redirect()->back()->withErrors('Failed to update stock.');
        }

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    /**
     * Remove the specified stock from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $deleted = $this->stockService->delete($id);

        if (!$deleted) {
            return redirect()->back()->withErrors('Failed to delete stock.');
        }

        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }
}
