@extends('layouts.create')

@section('title', __('messages.edit'))

@section('subContent')
    <form action="{{ route('products.update', $product->getId()) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name" label="{{ __('product.name') }}" :value="$product->getName()" required />
            <x-select name="type" label="{{ __('product.type') }}" :options="['0' => __('product.row'), '1' => __('product.product')]" :selected="$product->getType()" required />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.update') }}
            </button>
        </div>
    </form>
@endsection
