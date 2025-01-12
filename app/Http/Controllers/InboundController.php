<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IInboundService;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    protected IInboundService $inboundService;

    public function __construct(IInboundService $inboundService)
    {
        $this->inboundService = $inboundService;
    }

    public function index(Request $request)
    {
        $conditions = $request->only(['supplier_id', 'warehouse_id', 'is_confirmed']);
        $inbounds = $this->inboundService->getAll($conditions, ['*'], ['supplier', 'warehouse', 'items.product']);
        return view('inbounds.index', compact('inbounds'));
    }

    public function show(int $id)
    {
        $inbound = $this->inboundService->getById($id, ['supplier', 'warehouse', 'items.product']);
        return view('inbounds.show', compact('inbound'));
    }

    public function create()
    {
        return view('inbounds.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->inboundService->create($data);
        return redirect()->route('inbounds.index')->with('success', 'Inbound created successfully.');
    }

    public function edit(int $id)
    {
        $inbound = $this->inboundService->getById($id, ['items']);
        return view('inbounds.edit', compact('inbound'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $this->inboundService->update($id, $data);
        return redirect()->route('inbounds.index')->with('success', 'Inbound updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->inboundService->delete($id);
        return redirect()->route('inbounds.index')->with('success', 'Inbound deleted successfully.');
    }

    public function confirm(int $id)
    {
        $this->inboundService->confirmInbound($id);
        return redirect()->route('inbounds.index')->with('success', 'Inbound confirmed successfully.');
    }
}
