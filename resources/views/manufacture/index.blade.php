@extends('layouts.index')

@section('title', __('messages.Manufacture'))
@section('header_link', '#')

@section('subContent')
    <div class="grid grid-cols-2 gap-4 md:grid-cols-2 sm:grid-cols-1">
        <x-large-button text="{{$stages[0]}}" route="{{ route('manufacture.stage', 0) }}" type="primary" />
        <x-large-button text="{{$stages[1]}}" route="{{ route('manufacture.stage', 1) }}" type="primary" />
        <x-large-button text="{{$stages[2]}}" route="{{ route('manufacture.stage', 2) }}" type="primary" />
        <x-large-button text="{{$stages[3]}}" route="{{ route('manufacture.stage', 3) }}" type="primary" />
        <x-large-button text="{{$stages[4]}}" route="{{ route('manufacture.stage', 4) }}" type="primary" />
        <x-large-button text="{{$stages[5]}}" route="{{ route('manufacture.stage', 5) }}" type="primary" />
    </div>
@endsection
