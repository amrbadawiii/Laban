<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="login-form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-text-input label="{{ __('Email') }}" id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input label="{{ __('Password') }}" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Login and Autofill Buttons -->
        <div class="flex flex-col items-center justify-center mt-4">
            <!-- Login Button -->
            <div class="w-full flex justify-end">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Autofill Buttons -->
            <div class="mt-6 flex justify-around w-full">
                <button type="button" onclick="autofill('admin@example.com', 'password')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                    Admin
                </button>
                <button type="button" onclick="autofill('user@example.com', 'password')"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
                    User
                </button>
            </div>
        </div>
    </form>

    <!-- Autofill Script -->
    <script>
        function autofill(email, password) {
            // Populate the email and password fields
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>
</x-guest-layout>
