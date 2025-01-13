@extends('layouts.create')

@section('title', __('messages.details'))

@section('subContent')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-lg font-medium text-gray-700">{{ __('messages.details') }}:</h3>

            <!-- Define product values before passing to the component -->
            @php
                $isSelling = $product['is_selling'] ? 'Yes' : 'No';
                $isProduction = $product['is_production'] ? 'Yes' : 'No';
            @endphp

            <x-key-value label="{{ __('product.name') }}" :value="$product['name']" />
            <x-key-value label="{{ __('product.is_production') }}" :value="$isProduction" />
            <x-key-value label="{{ __('product.is_selling') }}" :value="$isSelling" />
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
            {{ __('messages.back') }}
        </a>
    </div>
@endsection
