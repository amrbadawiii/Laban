@extends('layouts.create')

@section('title', __('messages.create'))

@section('subContent')
    <br>
    <form action="{{ route('warehouses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name" label="{{ __('warehouse.name') }}" required />
            <x-text-input name="location" label="{{ __('warehouse.location') }}" required />
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('messages.create') }}
            </button>
        </div>
    </form>
    @if ($errors->any())
        <div class="text-red-700 px-4 py-3">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
@endsection
