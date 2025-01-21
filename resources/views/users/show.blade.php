@extends('layouts.create')

@section('title', __('messages.details'))

@section('subContent')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- User Details -->
        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-lg font-medium text-gray-700">{{ __('messages.user_details') }}:</h3>

            <x-key-value label="{{ __('user.id') }}" :value="$user['id']" />
            <x-key-value label="{{ __('user.name') }}" :value="$user['name']" />
            <x-key-value label="{{ __('user.email') }}" :value="$user['email']" />
            <x-key-value label="{{ __('user.type') }}" :value="$user['userTypeName']" />
        </div>

        <!-- Warehouse Details -->
        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-lg font-medium text-gray-700">{{ __('messages.details') }}:</h3>

            <x-key-value label="{{ __('warehouse.id') }}" :value="$user['warehouse']['id']" />
            <x-key-value label="{{ __('warehouse.name') }}" :value="$user['warehouse']['name']" />
            <x-key-value label="{{ __('warehouse.location') }}" :value="$user['warehouse']['location']" />
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('users.index') }}"
            class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition duration-300">
            {{ __('messages.back') }}
        </a>
    </div>

@endsection
