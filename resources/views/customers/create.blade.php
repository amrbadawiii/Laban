@extends('layouts.create')

@section('title', __('messages.create'))

@section('subContent')
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="first_name" label="{{ __('customer.first_name') }}" required />
            <x-text-input name="last_name" label="{{ __('customer.last_name') }}" required />
            <x-text-input name="email" label="{{ __('customer.email') }}" required />
            <x-text-input name="phone" label="{{ __('customer.phone') }}" />
            <x-text-input name="address" label="{{ __('customer.address') }}" />
            <x-text-input name="city" label="{{ __('customer.city') }}" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.create') }}
            </button>
        </div>
    </form>
@endsection
