@extends('layouts.create')

@section('title', __('messages.create'))

@section('subContent')
    <form action="{{ route('measurementUnits.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name_en" label="{{ __('measurementUnit.name_en') }}" required />
            <x-text-input name="name_ar" label="{{ __('measurementUnit.name_ar') }}" required />
            <x-text-input name="abbreviation" label="{{ __('measurementUnit.abbreviation') }}" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.create') }}
            </button>
        </div>
    </form>
@endsection
