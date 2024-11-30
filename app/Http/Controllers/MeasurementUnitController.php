<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IMeasurementUnitService;
use Illuminate\Http\Request;

class MeasurementUnitController extends Controller
{
    private IMeasurementUnitService $measurementUnitService;

    public function __construct(IMeasurementUnitService $measurementUnitService)
    {
        $this->measurementUnitService = $measurementUnitService;
    }

    public function index()
    {
        $items = $this->measurementUnitService->getAllMeasurementUnits();
        return view('measurementUnits.index', compact('items'));
    }

    public function show($id)
    {
        $measurementUnit = $this->measurementUnitService->getMeasurementUnitById($id);
        return view('measurementUnits.show', compact('measurementUnit'));
    }

    public function create()
    {
        return view('measurementUnits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:255',
        ]);

        $this->measurementUnitService->createMeasurementUnit($validated);
        return redirect()->route('measurementUnits.index')->with('success', 'Measurement Unit created successfully.');
    }

    public function edit($id)
    {
        $measurementUnit = $this->measurementUnitService->getMeasurementUnitById($id);
        return view('measurementUnits.edit', compact('measurementUnit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:255',
        ]);

        $this->measurementUnitService->updateMeasurementUnit($id, $validated);
        return redirect()->route('measurementUnits.index')->with('success', 'Measurement Unit updated successfully.');
    }

    public function destroy($id)
    {
        $this->measurementUnitService->deleteMeasurementUnit($id);
        return redirect()->route('measurementUnits.index')->with('success', 'Measurement Unit deleted successfully.');
    }
}
