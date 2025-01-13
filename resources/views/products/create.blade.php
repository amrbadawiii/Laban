@extends('layouts.create')

@section('title', __('messages.create'))

@section('subContent')
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name" label="{{ __('product.name') }}" required />
            <x-checkbox name="is_production" label="{{ __('product.is_production') }}" />
            <x-checkbox name="is_selling" label="{{ __('product.is_selling') }}" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.create') }}
            </button>
        </div>
    </form>
@endsection
