@extends('layouts.index')

@section('title', __('messages.user'))
@section('header_link', route('users.create'))

@section('subContent')

    @php
        // Define the columns with their type (text, image, link, or toggle)
        $columns = [
            ['key' => 'name', 'type' => 'text'],
            ['key' => 'email', 'type' => 'text'],
            ['key' => 'warehouse_id', 'type' => 'text'],
            ['key' => 'user_type', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'users.edit',
                'delete_route' => 'users.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('user.name') }}</x-table-header>
            <x-table-header>{{ __('user.email') }}</x-table-header>
            <x-table-header>{{ __('user.warehouse') }}</x-table-header>
            <x-table-header>{{ __('user.type') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($items['data'] as $user)
            <x-table-row :data="$user" :columns="$columns" route="users.show" />
        @endforeach
    </tbody>

@endsection