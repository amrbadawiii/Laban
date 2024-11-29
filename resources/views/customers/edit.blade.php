@extends('layouts.create')

@section('title', __('messages.edit'))

@section('subContent')
    <form action="{{ route('customers.update', $customer->getId()) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="first_name" label="{{ __('customer.firstName') }}" :value="$customer->getFirstName()" required />
            <x-text-input name="last_name" label="{{ __('customer.lastName') }}" :value="$customer->getLastName()" required />
            <x-text-input name="email" label="{{ __('customer.email') }}" :value="$customer->getEmail()" required />
            <x-text-input name="phone" label="{{ __('customer.phone') }}" :value="$customer->getPhone()" />
            <x-text-input name="address" label="{{ __('customer.address') }}" :value="$customer->getAddress()" />
            <x-text-input name="city" label="{{ __('customer.city') }}" :value="$customer->getCity()" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.update') }}
            </button>
        </div>
    </form>
@endsection
