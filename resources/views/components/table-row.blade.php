@props(['data', 'columns', 'route'])

<tr class="cursor-pointer hover:bg-gray-100" onclick="window.location='{{ route($route, $data->getId()) }}'">
    @foreach ($columns as $column)
        <td class="py-2 px-4 border-b" align="center">
            @if ($column['type'] === 'image')
                <img src="{{ asset($data->{$column['key']}) }}" alt="{{ $data->{$column['key']} }}" class="w-16">
            @elseif ($column['type'] === 'link')
                <a href="{{ route($column['route'], $data->getId()) }}" class="text-blue-500"
                    onclick="event.stopPropagation();">
                    {{ $data->{$column['key']} }}
                </a>
            @elseif ($column['type'] === 'toggle')
                <x-toggle-switch :checked="$data->{$column['key']}" :route="$column['route']" :id="$data->getId()"
                    onclick="event.stopPropagation();" />
            @elseif ($column['type'] === 'actions')
                <a href="{{ route($column['route'], $data->getId()) }}" class="text-yellow-500"
                    onclick="event.stopPropagation();">
                    {{ __('messages.edit') }}
                </a> |
                <form action="{{ route($column['delete_route'], $data->getId()) }}" method="POST" class="inline-block"
                    onclick="event.stopPropagation();">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
                </form>
            @else
                {{ $data->{$column['key']} }}
            @endif
        </td>
    @endforeach
</tr>
