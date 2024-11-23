@extends('layouts.index')

@section('title', __('messages.permission'))
@section('header_link', route('permissions.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">ID</th>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($permissions as $permission)
    <tr>
        <td class="py-2 px-4 border-b">{{ $permission->id }}</td>
        <td class="py-2 px-4 border-b">{{ $permission->name }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('permissions.edit', $permission->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection