@extends('layouts.index')

@section('title', __('messages.inbound'))
@section('header_link', route('inbounds.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">Product</th>
        <th class="py-2 px-4 border-b">Type</th>
        <th class="py-2 px-4 border-b">Quantity</th>
        <th class="py-2 px-4 border-b">Price</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($inbounds as $inbound)
    <tr>
        <td class="py-2 px-4 border-b">{{ $inbound->product->name }}</td>
        <td class="py-2 px-4 border-b">{{ ucfirst(str_replace('_', ' ', $inbound->type)) }}</td>
        <td class="py-2 px-4 border-b">{{ $inbound->quantity }}</td>
        <td class="py-2 px-4 border-b">{{ $inbound->price }}</td>
        <td class="py-2 px-4 border-b">
            <form action="{{ route('inbounds.destroy', $inbound->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection