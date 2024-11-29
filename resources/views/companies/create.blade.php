@extends('layouts.create')

@section('title', __('messages.create'))

@section('subContent')
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name" label="{{ __('company.name') }}" required />
            <x-text-input name="email" label="{{ __('company.email') }}" required />
            <x-text-input name="phone" label="{{ __('company.phone') }}" />
            <x-text-input name="address" label="{{ __('company.address') }}" />
            <x-text-input name="website" label="{{ __('company.website') }}" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.create') }}
            </button>
        </div>
    </form>
@endsection
