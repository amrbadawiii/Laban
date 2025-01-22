@extends('layouts.index')

@section('title', __('messages.manufacture'))
@section('header_link', '#')

@section('subContent')
    <div class="grid grid-cols-2 gap-4 md:grid-cols-2 sm:grid-cols-1">
        <x-large-button text="{{ app()->getLocale() === 'en' ? $stagesEn[0] : $stagesAr[0] }}"
            route="{{ route('manufacture.stage', 0) }}" type="primary" />
        <x-large-button text="{{ app()->getLocale() === 'en' ? $stagesEn[1] : $stagesAr[1] }}"
            route="{{ route('manufacture.stage', 1) }}" type="primary" />
        <x-large-button text="{{ app()->getLocale() === 'en' ? $stagesEn[2] : $stagesAr[2] }}"
            route="{{ route('manufacture.stage', 2) }}" type="primary" />
        <x-large-button text="{{ app()->getLocale() === 'en' ? $stagesEn[3] : $stagesAr[3] }}"
            route="{{ route('manufacture.stage', 3) }}" type="primary" />
        <x-large-button text="{{ app()->getLocale() === 'en' ? $stagesEn[4] : $stagesAr[4] }}"
            route="{{ route('manufacture.stage', 4) }}" type="primary" />
        <x-large-button text="{{ app()->getLocale() === 'en' ? $stagesEn[5] : $stagesAr[5] }}"
            route="{{ route('manufacture.stage', 5) }}" type="primary" />

    </div>
@endsection
