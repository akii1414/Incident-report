<x-guest-layout class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <!-- Logo or Title -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Login</h2>
            <p class="text-gray-500">Sign in to continue</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700" />
                <x-text-input id="email" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                <x-text-input id="password" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <x-primary-button class="py-2 px-6 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Register Link -->
            @if (Route::has('register'))
                <p class="mt-4 text-sm text-center text-gray-600">
                    {{ __("Don't have an account?") }}
                    <a class="text-indigo-600 hover:underline" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                </p>
            @endif
        </form>
</x-guest-layout>
