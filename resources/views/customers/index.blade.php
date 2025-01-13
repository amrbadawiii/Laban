@extends('layouts.index')

@section('title', __('messages.customer'))
@section('header_link', route('customers.create'))

@section('subContent')

    @php
        $columns = [
            ['key' => 'first_name', 'type' => 'text'],
            ['key' => 'last_name', 'type' => 'text'],
            ['key' => 'email', 'type' => 'text'],
            ['key' => 'phone', 'type' => 'text'],
            ['key' => 'city', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'customers.edit',
                'delete_route' => 'customers.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('customer.firstName') }}</x-table-header>
            <x-table-header>{{ __('customer.lastName') }}</x-table-header>
            <x-table-header>{{ __('customer.email') }}</x-table-header>
            <x-table-header>{{ __('customer.phone') }}</x-table-header>
            <x-table-header>{{ __('customer.city') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @if (!empty($items['data']))
            @foreach ($items['data'] as $customer)
                <x-table-row :data="$customer" :columns="$columns" route="customers.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
            </tr>
        @endif
    </tbody>

@endsection
