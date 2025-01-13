@extends('layouts.index')

@section('title', __('messages.warehouse'))
@section('header_link', route('warehouses.create'))

@section('subContent')

    @php
        // Define the columns with their type (text, image, link, or actions)
        $columns = [
            ['key' => 'name', 'type' => 'text'],
            ['key' => 'location', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'warehouses.edit',
                'delete_route' => 'warehouses.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('warehouse.name') }}</x-table-header>
            <x-table-header>{{ __('warehouse.location') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @if (!empty($items['data']))
            @foreach ($items['data'] as $warehouse)
                <x-table-row :data="$warehouse" :columns="$columns" route="warehouses.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>

@endsection
