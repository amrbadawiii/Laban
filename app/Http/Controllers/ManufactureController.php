<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IStockService;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    protected IStockService $stockService;

    public function __construct(IStockService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Display the manufacturing stages.
     */
    public function index()
    {
        $stages = [
            'Stage 1: Preparation',
            'Stage 2: Mixing',
            'Stage 3: Processing',
            'Stage 4: Packaging',
            'Stage 5: Quality Control',
            'Stage 6: Storage',
        ];

        return view('manufacture.index', compact('stages'));
    }

    /**
     * Handle stock changes for a specific manufacturing stage.
     */
    public function processStage(Request $request, int $stage)
    {
        $data = $request->validate([
            'inputs' => 'required|array', // Array of inputs: ['product_id', 'quantity', 'warehouse_id', etc.]
            'outputs' => 'required|array', // Array of outputs: ['product_id', 'quantity', 'warehouse_id', etc.]
        ]);

        \DB::transaction(function () use ($data, $stage) {
            // Process inputs (reduce stock)
            foreach ($data['inputs'] as $input) {
                $this->stockService->create([
                    'product_id' => $input['product_id'],
                    'warehouse_id' => $input['warehouse_id'],
                    'measurement_unit_id' => $input['measurement_unit_id'],
                    'credit' => 0,
                    'debit' => $input['quantity'], // Reduce stock
                    'type' => 'production',
                    'status' => 'completed',
                    'reference_type' => 'stage_' . $stage,
                ]);
            }

            // Process outputs (add stock)
            foreach ($data['outputs'] as $output) {
                $this->stockService->create([
                    'product_id' => $output['product_id'],
                    'warehouse_id' => $output['warehouse_id'],
                    'measurement_unit_id' => $output['measurement_unit_id'],
                    'credit' => $output['quantity'], // Add stock
                    'debit' => 0,
                    'type' => 'production',
                    'status' => 'completed',
                    'reference_type' => 'stage_' . $stage,
                ]);
            }
        });

        return redirect()->route('manufacture.index')->with('success', "Stage $stage processed successfully.");
    }
}
