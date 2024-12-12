@extends('layouts.index')

@section('title', __('messages.inbound'))
@section('header_link', route('inbounds.create'))

@section('subContent')
    @php
        $columns = [
            ['key' => 'product.name', 'type' => 'text'], // Nested property for product name
            ['key' => 'quantity', 'type' => 'text'], // Simple text value
            ['key' => 'supplier.name', 'type' => 'text'], // Nested property for supplier name
            ['key' => 'warehouse.name', 'type' => 'text'], // Nested property for warehouse name
            ['key' => 'receivedDate', 'type' => 'date'], // Date formatting
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'inbounds.edit', // Route for edit action
                'delete_route' => 'inbounds.destroy', // Route for delete action
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('inbound.product') }}</x-table-header>
            <x-table-header>{{ __('inbound.quantity') }}</x-table-header>
            <x-table-header>{{ __('inbound.supplier') }}</x-table-header>
            <x-table-header>{{ __('inbound.warehouse') }}</x-table-header>
            <x-table-header>{{ __('inbound.receivedDate') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $inbound)
            <x-table-row :data="$inbound" :columns="$columns" route="inbounds.show" />
        @endforeach
    </tbody>
@endsection
