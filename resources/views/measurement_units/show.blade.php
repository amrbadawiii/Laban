@extends('layouts.create')

@section('title', 'Measurement Unit Details')

@section('subContent')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Page:</h3>
        <p class="mt-2 text-gray-500">Measurement Units</p>
    </div>
</div>
<div class="mt-6">
    <a href="{{ route('measurement_codes.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition duration-300">
        Back to Measurement Units
    </a>
</div>
@endsection