@extends('layouts.create')

@section('title', __('messages.details'))

@section('subContent')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-lg font-medium text-gray-700">{{ __('messages.details') }}:</h3>

            <x-key-value label="{{ __('measurementUnit.name_en') }}" :value="$measurementUnit['nameEn']" />
            <x-key-value label="{{ __('measurementUnit.name_ar') }}" :value="$measurementUnit['nameAr']" />
            <x-key-value label="{{ __('measurementUnit.abbreviation') }}" :value="$measurementUnit['abbreviation']" />
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('measurementUnits.index') }}"
            class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
            {{ __('messages.back') }}
        </a>
    </div>
@endsection
