<x-app-layout>
    <div class="flex">
        <div class="w-full bg-gray-100 p-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <h2 class="text-2xl font-bold">@yield('title', 'Default Title')</h2>
                                <input type="text" id="tableSearch" placeholder="{{ __('messages.search') }}..."
                                    class="border-gray-300 dark:border-gray-600 focus:border-blue-500
                                    dark:focus:border-blue-500 focus:ring focus:ring-blue-200
                                    dark:focus:ring-blue-600 rounded-md shadow-sm w-48 px-3 py-2"
                                    style="{{ app()->getLocale() === 'ar' ? 'margin-right: 5rem;' : 'margin-left: 5rem;' }}">
                            </div>

                            @if (Session::get('role') === 'admin')

                                <div class="flex items-center" x-data="{ openPopup: false }">
                                    @if ($usePopup ?? false)
                                        <x-popup-form x-show="openPopup" @click.away="openPopup = false"
                                            :title="$title" :action="$action" :inputs="$inputs" />
                                    @else
                                        @if (!empty($__env->yieldContent('header_link', '#')) && $__env->yieldContent('header_link') !== '#')
                                            <a href="@yield('header_link', '#')" class="bg-blue-500 text-white px-4 py-2 rounded ml-auto">
                                                {{ __('messages.add_new') }}
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
                        <table id="dataTable" class="min-w-full bg-white dark:bg-gray-800 text-center">
                            @yield('subContent')
                        </table>
                        @if (!empty($items['data']))
                            <div class="mt-4 flex justify-center items-center">
                                @foreach ($items['links'] as $link)
                                    @if ($link['url'])
                                        <a href="{{ $link['url'] }}"
                                            class="px-4 py-2 {{ $link['active'] ? 'bg-blue-500 text-white' : 'bg-gray-200' }} rounded-md mx-1">
                                            {!! $link['label'] !!} {{-- Use {!! !!} to render HTML entities like &raquo; properly --}}
                                        </a>
                                    @else
                                        <span class="px-4 py-2 bg-gray-100 rounded-md mx-1 text-gray-400">
                                            {!! $link['label'] !!} {{-- Use {!! !!} here as well --}}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
