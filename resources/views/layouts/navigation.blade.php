<style>
    @media only screen and (max-width: 800px) {
        #sidebar {
            display: none;
        }

        #lgSidebarToggle {
            display: none;
        }
    }

    @media only screen and (min-width: 799px) {
        #mobileSidebarToggle {
            display: none;
        }
    }
</style>

<nav x-data="{ open: false, langOpen: false }">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Sidebar Toggle Button (Large Screens) -->
            <div class="flex">
                <button id="lgSidebarToggle" class="text-gray-500 focus:outline-none dark:text-gray-300 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Toggle Button (Mobile) -->
            <div class="flex">
                <button id="mobileSidebarToggle" class="text-gray-500 focus:outline-none dark:text-gray-300 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Center area (Logo or Title) -->
            <div class="flex items-center mx-auto">

            </div>

            <!-- Profile & Language Dropdown Toggle Button -->
            <div class="flex sm:hidden">
                <button @click="open = ! open" class="text-gray-500 focus:outline-none dark:text-gray-300 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                        </path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Full-screen view: Language & Profile -->
            <div class="hidden sm:flex sm:items-center {{ app()->getLocale() == 'ar' ? 'sm:mr-6' : 'sm:ml-6' }}">
                <!-- Language Dropdown -->
                <div class="relative">
                    <button id="languageSelector"
                        class="inline-flex items-center px-3 py-2 text-gray-500 dark:text-gray-400">
                        {{ app()->getLocale() === 'en' ? 'English' : 'العربية' }}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="languageDropdown"
                        class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                        <a href="{{ route('language.set', 'en') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">English</a>
                        <a href="{{ route('language.set', 'ar') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">العربية</a>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div x-data="{ profileOpen: false }" class="relative ml-4">
                    <button @click="profileOpen = ! profileOpen"
                        class="inline-flex items-center text-gray-500 dark:text-gray-400">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="profileOpen" @click.away="profileOpen = false"
                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
                        style="display: none;">
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('messages.profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                             this.closest('form').submit();">
                                {{ __('messages.logout') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <!-- Responsive Language Dropdown -->
            <div class="border-t border-gray-200 dark:border-gray-600">
                <div class="px-4 py-1">
                    <button @click="langOpen = ! langOpen" class="w-full text-left text-gray-500 dark:text-gray-400">
                        {{ app()->getLocale() === 'en' ? 'English' : 'العربية' }}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div :class="{ 'block': langOpen, 'hidden': !langOpen }"
                        class="hidden mt-2 bg-white dark:bg-gray-800 shadow-lg rounded-md py-1 w-full">
                        <a href="{{ route('language.set', 'en') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">English</a>
                        <a href="{{ route('language.set', 'ar') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">العربية</a>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')">
                    {{ __('messages.profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('messages.logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    // Toggle sidebar on both large and small screens
    const lgSidebarToggle = document.getElementById('lgSidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const mobileSidbar = document.getElementById('mobile-sidebar');

    lgSidebarToggle.addEventListener('click', () => {
        if (screen.width < 640) {
            // Mobile behavior: show overlay and sidebar
            mobileSidbar.classList.toggle('hidden');
        } else {
            // Desktop behavior: toggle sidebar visibility
            sidebar.classList.toggle('hidden');
        }
    });

    // Toggle language dropdown
    const languageSelector = document.getElementById('languageSelector');
    const languageDropdown = document.getElementById('languageDropdown');
    languageSelector.addEventListener('click', () => {
        languageDropdown.classList.toggle('hidden');
    });
</script>
<script src="//unpkg.com/alpinejs" defer></script>
