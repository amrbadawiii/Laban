@props(['src', 'alt'])

@if ($src)
    <div class="mt-4">
        <strong>{{ $slot }}</strong>
        <img src="{{ asset($src) }}" alt="{{ $alt }}" class="mt-2 w-32 h-32 object-cover rounded-lg shadow">
    </div>
@endif
