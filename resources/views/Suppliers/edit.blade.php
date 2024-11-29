@extends('layouts.create')

@section('title', __('messages.edit'))

@section('subContent')
    <form action="{{ route('suppliers.update', $supplier->getId()) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name" label="{{ __('supplier.name') }}" :value="$supplier->getName()" required />
            <x-text-input name="email" label="{{ __('supplier.email') }}" :value="$supplier->getEmail()" required />
            <x-text-input name="phone" label="{{ __('supplier.phone') }}" :value="$supplier->getPhone()" />
            <x-text-input name="address" label="{{ __('supplier.address') }}" :value="$supplier->getAddress()" />
            <x-text-input name="city" label="{{ __('supplier.city') }}" :value="$supplier->getCity()" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.update') }}
            </button>
        </div>
    </form>
@endsection
