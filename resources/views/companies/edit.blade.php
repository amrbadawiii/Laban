@extends('layouts.create')

@section('title', __('messages.edit'))

@section('subContent')
    <form action="{{ route('companies.update', $company['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-text-input name="name" label="{{ __('company.name') }}" :value="$company['name']" required />
            <x-text-input name="email" label="{{ __('company.email') }}" :value="$company['email']" required />
            <x-text-input name="phone" label="{{ __('company.phone') }}" :value="$company['phone']" />
            <x-text-input name="address" label="{{ __('company.address') }}" :value="$company['address']" />
            <x-text-input name="website" label="{{ __('company.website') }}" :value="$company['website']" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.update') }}
            </button>
        </div>
    </form>
@endsection
