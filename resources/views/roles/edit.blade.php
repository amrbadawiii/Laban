@extends('layouts.create')

@section('title', 'Edit Role')

@section('subContent')

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block text-sm font-medium text-gray-700">Role Name</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name', $role->name) }}" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Assign Permissions</label>
            @foreach($permissions as $permission)
            <div>
                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission_{{ $permission->id }}"
                    @if($role->permissions->contains($permission)) checked @endif>
                <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
            </div>
            @endforeach
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Role Name</label>
            <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name', $role->name) }}" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Assign Permissions</label>
            @foreach($permissions as $permission)
            <div>
                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission_{{ $permission->id }}"
                    @if($role->permissions->contains($permission)) checked @endif>
                <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Submit Button -->
    <div class="mt-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Update
        </button>
    </div>
</form>
@endsection