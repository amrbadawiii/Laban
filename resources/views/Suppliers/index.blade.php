@extends('layouts.index')

@section('title', __('messages.supplier'))
@section('header_link', route('suppliers.create'))

@section('subContent')

    @php
        $columns = [
            ['key' => 'name', 'type' => 'text'],
            ['key' => 'email', 'type' => 'text'],
            ['key' => 'phone', 'type' => 'text'],
            ['key' => 'address', 'type' => 'text'],
            ['key' => 'city', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'suppliers.edit',
                'delete_route' => 'suppliers.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('supplier.name') }}</x-table-header>
            <x-table-header>{{ __('supplier.email') }}</x-table-header>
            <x-table-header>{{ __('supplier.phone') }}</x-table-header>
            <x-table-header>{{ __('supplier.address') }}</x-table-header>
            <x-table-header>{{ __('supplier.city') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>

        @if (!empty($items['data']))
            @foreach ($items['data'] as $supplier)
                <x-table-row :data="$supplier" :columns="$columns" route="suppliers.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>

@endsection
