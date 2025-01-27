<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\IStockService;
use App\Application\Interfaces\IWarehouseService;
use App\Domain\Enums\StockTypeEnum;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    protected IStockService $stockService;
    protected IProductService $productService;
    protected IMeasurementUnitService $measurementUnitService;
    protected IWarehouseService $warehouseService;

    public function __construct(IStockService $stockService, IProductService $productService, IMeasurementUnitService $measurementUnitService, IWarehouseService $warehouseService)
    {
        $this->stockService = $stockService;
        $this->productService = $productService;
        $this->measurementUnitService = $measurementUnitService;
        $this->warehouseService = $warehouseService;
    }

    /**
     * Display the manufacturing stages.
     */
    public function index()
    {
        $stagesEn = [
            0 => 'Milling',
            1 => 'Butter Production',
            2 => 'Ghee Production',
            3 => 'Thrombosis Production',
            4 => 'Mozzarella Production',
            5 => 'Butter Mixture Production',
        ];
        $stagesAr = [
            0 => 'فرز',
            1 => 'إنتاج الزبدة',
            2 => 'إنتاج السمن',
            3 => 'إنتاج التخثر',
            4 => 'إنتاج الموزاريلا',
            5 => 'إنتاج خليط الزبدة',
        ];

        return view('manufacture.index', compact('stagesEn', 'stagesAr'));
    }

    public function stage($id)
    {
        $processData = $this->getProcessData($id);
        $warehouses = $this->warehouseService->getAllWoP()->toArray();

        if (!$processData) {
            return redirect()->route('manufacture.index')->with('error', 'Invalid process ID.');
        }

        return view('manufacture.stage', compact('processData', 'id', 'warehouses'));
    }

    /**
     * Get process data by stage ID
     */
    private function getProcessData($id)
    {
        $processes = [
            0 => [
                'nameEn' => 'Milling',
                'nameAr' => 'فرز',
                'manual_output' => true, // Manual output enabled for this stage
                'inputs' => [
                    [
                        'product_id' => $this->productService->getById(1)->getId(),
                        'name' => $this->productService->getById(1)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
                'outputs' => [
                    [
                        'product_id' => $this->productService->getById(7)->getId(),
                        'name' => $this->productService->getById(7)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                    [
                        'product_id' => $this->productService->getById(6)->getId(),
                        'name' => $this->productService->getById(6)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
            ],
            1 => [
                'nameEn' => 'Butter Production',
                'nameAr' => 'إنتاج الزبدة',
                'manual_output' => false, // Manual output enabled for this stage
                'inputs' => [
                    [
                        'product_id' => $this->productService->getById(7)->getId(),
                        'name' => $this->productService->getById(7)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
                'outputs' => [
                    [
                        'product_id' => $this->productService->getById(2)->getId(),
                        'name' => $this->productService->getById(2)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
            ],
            2 => [
                'nameEn' => 'Ghee Production',
                'nameAr' => 'إنتاج السمن',
                'manual_output' => false, // Manual output enabled for this stage
                'inputs' => [
                    [
                        'product_id' => $this->productService->getById(2)->getId(),
                        'name' => $this->productService->getById(2)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
                'outputs' => [
                    [
                        'product_id' => $this->productService->getById(8)->getId(),
                        'name' => $this->productService->getById(8)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
            ],
            3 => [
                'nameEn' => 'Thrombosis Production',
                'nameAr' => 'إنتاج التخثر',
                'manual_output' => false, // Manual output enabled for this stage
                'inputs' => [
                    [
                        'product_id' => $this->productService->getById(6)->getId(),
                        'name' => $this->productService->getById(6)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
                'outputs' => [
                    [
                        'product_id' => $this->productService->getById(9)->getId(),
                        'name' => $this->productService->getById(9)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
            ],
            4 => [
                'nameEn' => 'Mozzarella Production',
                'nameAr' => 'إنتاج الموزاريلا',
                'manual_output' => false, // Manual output enabled for this stage
                'inputs' => [
                    [
                        'product_id' => $this->productService->getById(9)->getId(),
                        'name' => $this->productService->getById(9)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
                'outputs' => [
                    [
                        'product_id' => $this->productService->getById(10)->getId(),
                        'name' => $this->productService->getById(10)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
            ],
            5 => [
                'nameEn' => 'Butter Mixture Production',
                'nameAr' => 'إنتاج خليط الزبدة',
                'manual_output' => false, // Manual output enabled for this stage
                'inputs' => [
                    [
                        'product_id' => $this->productService->getById(7)->getId(),
                        'name' => $this->productService->getById(7)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
                'outputs' => [
                    [
                        'product_id' => $this->productService->getById(8)->getId(),
                        'name' => $this->productService->getById(8)->getName(),
                        'measurement_unit' => $this->measurementUnitService->getAllWoP()->toArray()
                    ],
                ],
            ],
            // Add other processes here...
        ];

        return $processes[$id] ?? null;
    }


    /**
     * Handle stock changes for a specific manufacturing stage.
     */
    public function processStage(Request $request, int $stage)
    {
        $data = $request->validate([
            'warehouse_id' => 'required',
            //'clearance_rate' => 'required|numeric',
            'inputs' => 'required|array', // Array of inputs: ['product_id', 'quantity', 'warehouse_id', etc.]
            'outputs' => 'required|array', // Array of outputs: ['product_id', 'quantity', 'warehouse_id', etc.]
        ]);

        \DB::transaction(function () use ($data, $stage) {

            // Process inputs (reduce stock)
            foreach ($data['inputs'] as $input) {
                $this->stockService->create([
                    'product_id' => $input['product_id'],
                    'warehouse_id' => $data['warehouse_id'],
                    'measurement_unit_id' => $input['measurement_unit_id'],
                    'incoming' => 0,
                    'outgoing' => $input['quantity'], // Reduce stock
                    'stock_type' => StockTypeEnum::Production->value,
                    'reference_type' => 'Production',
                    'reference_id' => $stage,
                ]);
            }

            // Process outputs (add stock)
            foreach ($data['outputs'] as $output) {
                // if ($stage === 0) {
                //     // If stage is not 0, calculate output quantity as (clearance_rate * input quantity)
                //     $outputQuantity = $output['quantity'];
                // } elseif ($stage !== 0) {
                //     $inputQuantity = $data['inputs'][$outputIndex]['quantity'] ?? 0; // Match input and output by index
                //     $outputQuantity = $data['clearance_rate'] * $inputQuantity;
                //     $output['measurement_unit_id'] = $input['measurement_unit_id'];
                // }

                $this->stockService->create([
                    'product_id' => $output['product_id'],
                    'warehouse_id' => $data['warehouse_id'],
                    'measurement_unit_id' => $output['measurement_unit_id'],
                    'incoming' => $output['quantity'], // Add calculated stock
                    'outgoing' => 0,
                    'stock_type' => StockTypeEnum::Production->value,
                    'reference_type' => 'Production',
                    'reference_id' => $stage,
                ]);
            }
        });

        return redirect()->route('manufacture.index')->with('success', "Stage $stage processed successfully.");
    }

}
