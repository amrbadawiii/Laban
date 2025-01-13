@extends('layouts.index')

@section('title', __('messages.product'))
@section('header_link', route('products.create'))

@section('subContent')

    @php
        $columns = [
            ['key' => 'name', 'type' => 'text'],
            ['key' => 'is_production', 'type' => 'text'],
            ['key' => 'is_selling', 'type' => 'text'],
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
            <x-table-header>{{ __('product.is_production') }}</x-table-header>
            <x-table-header>{{ __('product.is_selling') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>

        @if (!empty($items['data']))
            @foreach ($items['data'] as $product)
                <x-table-row :data="$product" :columns="$columns" route="products.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>

@endsection
