@extends('layouts.index')

@section('title', __('messages.user'))
@section('header_link', route('users.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">ID</th>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Email</th>
        <th class="py-2 px-4 border-b">Role</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $user)
    <tr>
        <td class="py-2 px-4 border-b">{{ $user->id }}</td>
        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
        <td class="py-2 px-4 border-b">
            @foreach ($user->roles as $role)
            {{ $role->name }}
            @endforeach
        </td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection