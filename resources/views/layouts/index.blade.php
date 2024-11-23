<x-app-layout>
    <div class="flex">
        <div class="w-full bg-gray-100 p-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <h2 class="text-2xl font-bold">@yield('title', 'Default Title')</h2>
                                <input type="text" placeholder="{{ __('messages.search') }}..."
                                    class="border-gray-300 dark:border-gray-600 focus:border-blue-500 
                                            dark:focus:border-blue-500 focus:ring focus:ring-blue-200 
                                            dark:focus:ring-blue-600 rounded-md shadow-sm w-48 px-3 py-2"
                                    style="{{ app()->getLocale() === 'ar' ? 'margin-right: 5rem;' : 'margin-left: 5rem;' }}">

                            </div>
                            <div class="flex items-center">
                                <a href="@yield('header_link', '#')" class="bg-blue-500 text-white px-4 py-2 rounded ml-auto">
                                    {{ __('messages.add_new') }}
                                </a>
                            </div>
                        </div>

                        <table class="min-w-full bg-white dark:bg-gray-800 text-center">
                            @yield('subContent')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>