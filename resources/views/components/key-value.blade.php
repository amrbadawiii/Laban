@props(['label', 'value'])

<p class="mt-2 text-gray-500">
    <strong>{{ $label }}:</strong>
    @php
        // Check if the value is a URL and prepend "https://" if it starts with 'www.'
        $url =
            filter_var($value, FILTER_VALIDATE_URL) || preg_match('/^www\./', $value)
                ? (preg_match('/^http(s)?:\/\//', $value)
                    ? $value
                    : 'https://' . $value)
                : null;
    @endphp

    @if ($url)
        <a href="{{ $url }}" target="_blank" class="text-indigo-600 hover:underline">{{ $value }}</a>
    @else
        {{ $value }}
    @endif
</p>
