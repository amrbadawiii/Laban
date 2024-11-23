@extends('layouts.index')

@section('title', __('messages.product'))
@section('header_link', route('products.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Code</th>
        <th class="py-2 px-4 border-b">Barcode</th>
        <th class="py-2 px-4 border-b">Measurement Code</th>
        <th class="py-2 px-4 border-b">Type</th>
        <th class="py-2 px-4 border-b">Category</th>
        <th class="py-2 px-4 border-b">Supplier</th>
        <th class="py-2 px-4 border-b">Colour</th>
        <th class="py-2 px-4 border-b">Total Quantity</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($products as $product)
    <tr>
        <td class="py-2 px-4 border-b"><a href="{{ route('products.show', $product->id) }}" class="text-blue-500">{{ $product->name }}</a></td>
        <td class="py-2 px-4 border-b">{{ $product->code }}</td>
        <td class="py-2 px-4 border-b"><img src="{{ asset($product->barcode) }}" alt="barcode" /></td>
        <td class="py-2 px-4 border-b">{{ $product->measurement_code->code }}</td>
        <td class="py-2 px-4 border-b">{{ $product->type }}</td>
        <td class="py-2 px-4 border-b">{{ $product->category->name_en }}</td>
        <td class="py-2 px-4 border-b">{{ $product->supplier->name }}</td>
        <td class="py-2 px-4 border-b">{{ $product->colour }}</td>
        <td class="py-2 px-4 border-b">{{ $product->total_quantity }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection