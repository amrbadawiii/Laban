@extends('layouts.create')

@section('title', __('messages.edit'))

@section('subContent')
    <form action="{{ route('measurementUnits.update', $measurementUnit->getId()) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name_en" label="{{ __('measurementUnit.name_en') }}" :value="$measurementUnit->getNameEn()" required />
            <x-text-input name="name_ar" label="{{ __('measurementUnit.name_ar') }}" :value="$measurementUnit->getNameAr()" required />
            <x-text-input name="abbreviation" label="{{ __('measurementUnit.abbreviation') }}" :value="$measurementUnit->getAbbreviation()" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.update') }}
            </button>
        </div>
    </form>
@endsection
