@extends('layouts.create')

@section('title', __('messages.edit'))

@section('subContent')
    <br>
    <!-- Form for updating warehouse details -->
    <form action="{{ route('warehouses.update', $warehouse->getId()) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Grid of Inputs for Warehouse details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name" label="{{ __('warehouse.name') }}" :value="$warehouse->getName()" required />
            <x-text-input name="location" label="{{ __('warehouse.location') }}" :value="$warehouse->getLocation()" required />
        </div>

        <!-- Submit Button for updating warehouse details -->
        <div class="mt-6">
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('messages.update') }}
            </button>
        </div>
    </form>

    <!-- Display validation errors if any -->
    @if ($errors->any())
        <div class="text-red-700 px-4 py-3">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Optional RTL CSS for Select Fields -->
    <style>
        .rtl-select {
            background-position: right 0.5rem center;
            padding-right: 0.75rem;
            padding-left: 2rem;
        }

        .rtl-select::-ms-expand {
            display: none;
        }

        [dir="rtl"] .rtl-select {
            background-position: left 0.5rem center;
            padding-right: 2rem;
            padding-left: 0.75rem;
        }
    </style>
    <script>
        document.getElementById('update-button').addEventListener('click', function() {
            document.getElementById('update-form').submit();
        });
    </script>
@endsection
