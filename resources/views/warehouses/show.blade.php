@extends('layouts.create')

@section('title', __('messages.details'))

@section('subContent')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-lg font-medium text-gray-700">{{ __('messages.details') }}:</h3>

            <!-- Display warehouse details -->
            <x-key-value label="{{ __('warehouse.name') }}" :value="$warehouse->getName()" />
            <x-key-value label="{{ __('warehouse.location') }}" :value="$warehouse->getLocation()" />
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('warehouses.index') }}"
            class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition duration-300">
            {{ __('messages.back') }}
        </a>
    </div>

@endsection
