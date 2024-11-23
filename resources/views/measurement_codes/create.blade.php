@extends('layouts.create')

@section('title', 'Add New Measurement Code')

@section('subContent')

<form action="{{ route('measurement_codes.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Measurement Units</label>
            @foreach($measurementUnits as $unit)
            <div class="flex items-center">
                <input type="checkbox" name="measurement_units[]" value="{{ $unit->id }}" id="unit_{{ $unit->id }}" class="mr-2">
                <label for="unit_{{ $unit->id }}">{{ $unit->name_en }}</label>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Create
        </button>
    </div>
</form>
@endsection