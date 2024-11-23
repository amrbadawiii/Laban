@extends('layouts.index')

@section('title', __('messages.category'))
@section('header_link', route('categories.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">Image</th>
        <th class="py-2 px-4 border-b">Name (EN)</th>
        <th class="py-2 px-4 border-b">Name (AR)</th>
        <th class="py-2 px-4 border-b">Activate</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($categories as $category)
    <tr>
        <td class="py-2 px-4 border-b"><img src="{{ asset($category->image) }}" alt="{{ $category->name_en }}" class="w-16"></td>
        <td class="py-2 px-4 border-b">{{ $category->name_en }}</td>
        <td class="py-2 px-4 border-b">{{ $category->name_ar }}</td>
        <td class="py-2 px-4 border-b">{{ $category->activate ? 'Active' : 'Inactive' }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection