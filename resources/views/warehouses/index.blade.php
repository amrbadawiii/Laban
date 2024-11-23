@extends('layouts.index')

@section('title', __('messages.warehouse'))
@section('header_link', route('warehouses.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Location</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($warehouses as $warehouse)
    <tr>
        <td class="py-2 px-4 border-b"><a href="{{ route('warehouses.show', $warehouse->id) }}" class="text-blue-500">{{ $warehouse->name }}</a></td>
        <td class="py-2 px-4 border-b">{{ $warehouse->location }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection