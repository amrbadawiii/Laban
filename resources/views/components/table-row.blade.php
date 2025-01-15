@props(['data', 'columns', 'route', 'routeParams' => []])

<tr class="{{ $route !== '#' ? 'hover:bg-gray-100 cursor-pointer' : 'cursor-default' }}"
    @if ($route !== '#') onclick="window.location='{{ route($route, $routeParams ?: ['id' => $data['id']]) }}'" @endif>
    @foreach ($columns as $column)
        <td class="py-2 px-4 border-b" align="center">
            @php
                $keys = explode('.', $column['key']);
                $value = $data;

                foreach ($keys as $key) {
                    if (is_array($value) && array_key_exists($key, $value)) {
                        $value = $value[$key];
                    } elseif (is_object($value) && property_exists($value, $key)) {
                        $value = $value->{$key};
                    } else {
                        $value = null;
                        break;
                    }
                }
            @endphp

            @switch($column['type'])
                @case('image')
                    @if ($value)
                        <img src="{{ asset($value) }}" alt="{{ $value }}" class="w-16">
                    @endif
                @break

                @case('link')
                    <a href="{{ route($column['route'], $data['id']) }}" class="text-blue-500" onclick="event.stopPropagation();">
                        {{ $value }}
                    </a>
                @break

                @case('toggle')
                    <x-toggle-switch :checked="$value" :route="$column['route']" :id="$data['id']" onclick="event.stopPropagation();" />
                @break

                @case('actions')
                    @if ($column['route'] !== '#')
                        <a href="{{ route($column['route'], $data['id']) }}" class="text-yellow-500"
                            onclick="event.stopPropagation();">
                            {{ __('messages.edit') }}
                        </a>
                        |
                    @endif

                    @if ($column['delete_route'] !== '#')
                        <form action="{{ route($column['delete_route'], $data['id']) }}" method="POST" class="inline-block"
                            onclick="event.stopPropagation();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
                        </form>
                    @endif
                @break

                @default
                    {{ is_array($value) ? json_encode($value) : $value }}
            @endswitch
        </td>
    @endforeach
</tr>
