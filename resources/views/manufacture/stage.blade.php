@extends('layouts.index')

@section('title', __('messages.manufacturing_stage') . (app()->getLocale() === 'en' ? $processData['nameEn'] : $processData['nameAr']))

@section('header_link', '#')

@section('subContent')
<form action="{{ route('manufacture.process', $id) }}" method="POST">
    @csrf

    <!-- Warehouse Selection -->
    <div class="grid grid-cols-1 gap-4 mb-6">
        <x-select-input name="warehouse_id" label="{{ __('manufacture.select_warehouse') }}"
            :options="collect($warehouses)->pluck('name', 'id')" selected="" class="w-full" />
    </div>

    <!-- Inputs Section -->
    <div class="grid grid-cols-1 gap-4">
        <h2 class="text-xl font-bold">{{ __('manufacture.inputs') }}</h2>
        @foreach ($processData['inputs'] as $input)
            <div class="flex items-center space-x-6">
                <!-- Input Name -->
                <label class="w-1/4 text-gray-700 font-medium">{{ $input['name'] }}</label>

                <!-- Quantity Field Using text-input Component -->
                <x-text-input name="inputs[{{ $loop->index }}][quantity]" label="{{ __('manufacture.quantity') }}" type="number"
                    required="true" value="" class="flex-grow" />

                <!-- Measurement Unit Dropdown Using select-input Component -->
                <x-select-input name="inputs[{{ $loop->index }}][measurement_unit_id]" label="{{ __('manufacture.measurement_unit') }}"
                    :options="collect($input['measurement_unit'])->pluck('abbreviation', 'id')" selected=""
                    class="flex-grow" />

                <!-- Hidden Product ID -->
                <input type="hidden" name="inputs[{{ $loop->index }}][product_id]" value="{{ $input['product_id'] }}">
            </div>
        @endforeach
    </div>

    @if ($processData['manual_output'] == false)
        <!-- Clearance Rate Section -->
        <div class="grid grid-cols-1 gap-4 mt-6">
            <h2 class="text-xl font-bold">{{ __('manufacture.clearance_rate') }}</h2>
            <x-text-input name="clearance_rate" label="{{ __('manufacture.enter_clearance_rate') }}" type="number" required="true"
                class="w-full" />
        </div>
    @else
        <input type="hidden" name="clearance_rate" value="0">
    @endif


    <!-- Outputs Section -->
    <div class="grid grid-cols-1 gap-4 mt-6">
        <h2 class="text-xl font-bold">{{ __('manufacture.outputs') }}</h2>
        @foreach ($processData['outputs'] as $output)
            <div class="flex items-center space-x-6">
                <!-- Output Name -->
                <label class="w-1/4 text-gray-700 font-medium">{{ $output['name'] }}</label>

                @if ($processData['manual_output'] == true)
                    <!-- Show fields for manual quantity and unit -->
                    <x-text-input name="outputs[{{ $loop->index }}][quantity]" label="{{ __('manufacture.quantity') }}" type="number"
                        required="true" class="flex-grow" />

                    <x-select-input name="outputs[{{ $loop->index }}][measurement_unit_id]" label="{{ __('manufacture.measurement_unit') }}"
                        :options="collect($output['measurement_unit'])->pluck('abbreviation', 'id')" selected=""
                        class="flex-grow" />
                @endif

                <!-- Hidden Product ID -->
                <input type="hidden" name="outputs[{{ $loop->index }}][product_id]" value="{{ $output['product_id'] }}">
            </div>
        @endforeach
    </div>

    <!-- Submit Button -->
    <div class="mt-8">
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">
            {{ __('manufacture.process_stage') }}
        </button>
    </div>
</form>
@endsection
