@extends('layouts.index')

@section('title', __('messages.Manufacture'))
@section('header_link', route('measurementUnits.create'))

@section('subContent')
    <div class="grid grid-cols-2 gap-4 md:grid-cols-2 sm:grid-cols-1">
        <x-large-button text="Milling" route="{{ route('manufacture.stage', 0) }}" type="primary" />
        <x-large-button text="Butter Production" route="{{ route('manufacture.stage', 1) }}" type="primary" />
        <x-large-button text="Ghee Production" route="{{ route('manufacture.stage', 2) }}" type="primary" />
        <x-large-button text="Thrombosis Production" route="{{ route('manufacture.stage', 3) }}" type="primary" />
        <x-large-button text="Mozzarella Production" route="{{ route('manufacture.stage', 4) }}" type="primary" />
        <x-large-button text="Butter Mixture Production" route="{{ route('manufacture.stage', 5) }}" type="primary" />
    </div>
@endsection
