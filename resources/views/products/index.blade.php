@extends('layouts.index')

@section('title', __('messages.product'))
@section('header_link', route('products.create'))

@section('subContent')

    @php
        $columns = [
            ['key' => 'name', 'type' => 'text'],
            ['key' => 'type', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'products.edit',
                'delete_route' => 'products.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('product.name') }}</x-table-header>
            <x-table-header>{{ __('product.type') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($items['data'] as $product)
            <x-table-row :data="$product" :columns="$columns" route="products.show" />
        @endforeach
    </tbody>

@endsection
