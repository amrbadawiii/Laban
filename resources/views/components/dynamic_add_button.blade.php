<!-- resources/views/components/dynamic-add-button.blade.php -->
@props([
    'usePopup' => false, // Flag to determine behavior
    'popupEvent' => 'open-popup', // Event to dispatch for popup
    'link' => '#', // Link URL when not using popup
])

@if ($usePopup)
    <button @click="$dispatch('{{ $popupEvent }}')" class="bg-blue-500 text-white px-4 py-2 rounded ml-auto">
        {{ __('messages.add_new') }}
    </button>
@else
    <a href="{{ $link }}" class="bg-blue-500 text-white px-4 py-2 rounded ml-auto">
        {{ __('messages.add_new') }}
    </a>
@endif
