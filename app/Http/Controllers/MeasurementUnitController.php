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
        $items = $this->measurementUnitService->getAll()->toArray();

        return view('measurementUnits.index', compact('items')); // Pass Measurement Units as an array to the view
    }

    public function show($id)
    {
        $unit = $this->measurementUnitService->getById($id)->toArray();
        return view('measurementUnits.show', ['measurementUnit' => $unit]); // Pass Measurement Unit as an array to the view
    }

    public function create()
    {
        return view('measurementUnits.create'); // Show a form for creating a Measurement Unit
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'abbreviation' => 'required'
        ]);

        $this->measurementUnitService->create($validated);
        return redirect()->route('measurementUnits.index')->with('success', 'Measurement Unit created successfully.');
    }

    public function edit($id)
    {
        $unit = $this->measurementUnitService->getById($id)->toArray();
        return view('measurementUnits.edit', ['measurementUnit' => $unit]); // Pass Measurement Units as an array to the view
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'abbreviation' => 'required'
        ]);

        $this->measurementUnitService->update($id, $validated);
        return redirect()->route('measurementUnits.index')->with('success', 'measurement Units updated successfully.');
    }

    public function destroy($id)
    {
        $this->measurementUnitService->delete($id);
        return redirect()->route('measurementUnits.index')->with('success', 'measurement Unit deleted successfully.');
    }
}
