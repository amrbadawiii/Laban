@extends('layouts.create')

@section('title', isset($user) ? __('messages.edit') : __('messages.create'))

@section('subContent')
    <br>
    <form action="{{ isset($user) ? route('users.update', $user->getId()) : route('users.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <x-text-input name="name" label="{{ __('user.name') }}" :value="old('name', isset($user) ? $user->getName() : '')" required />

            <!-- Email -->
            <x-text-input name="email" label="{{ __('user.email') }}" type="email" :value="old('email', isset($user) ? $user->getEmail() : '')" required />

            <!-- Password -->
            <x-text-input name="password" label="{{ __('user.password') }}" type="password" :value="old('password', '')" />

            <!-- Warehouse -->
            <x-select name="warehouse_id" label="{{ __('user.warehouse') }}" :options="$warehouses" :selected="old('warehouseId', isset($user) ? $user->getWarehouseId() : '')" required />

            <!-- User Type -->
            <x-select name="user_type" label="{{ __('user.type') }}" :options="$userTypes" :selected="old('userType', isset($user) ? $user->getUserType()->value : '')"
                displayKey="name" required />

        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ isset($user) ? __('messages.update') : __('messages.create') }}
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
