@extends('layouts.index')

@section('title', __('messages.role'))
@section('header_link', route('roles.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">ID</th>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($roles as $role)
    <tr>
        <td class="py-2 px-4 border-b">{{ $role->id }}</td>
        <td class="py-2 px-4 border-b">{{ $role->name }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('roles.edit', $role->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection