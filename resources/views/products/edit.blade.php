@extends('layouts.create')

@section('title', __('messages.edit'))

@section('subContent')
    <form action="{{ route('products.update', $product['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name" label="{{ __('product.name') }}" :value="$product['name']" required />
            <x-checkbox name="is_production" label="{{ __('product.is_production') }}" :checked="$product['is_production']" />
            <x-checkbox name="is_selling" label="{{ __('product.is_selling') }}" :checked="$product['is_selling']" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.update') }}
            </button>
        </div>
    </form>
@endsection
