@extends('layouts.index')

@section('title', __('messages.supplier'))
@section('header_link', route('suppliers.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Address</th>
        <th class="py-2 px-4 border-b">Phone Number</th>
        <th class="py-2 px-4 border-b">Code</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($suppliers as $supplier)
    <tr>
        <td class="py-2 px-4 border-b"><a href="{{ route('suppliers.show', $supplier->id) }}" class="text-blue-500">{{ $supplier->name }}</a></td>
        <td class="py-2 px-4 border-b">{{ $supplier->address }}</td>
        <td class="py-2 px-4 border-b">{{ $supplier->phone_number }}</td>
        <td class="py-2 px-4 border-b">{{ $supplier->code }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection