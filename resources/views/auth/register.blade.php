<x-guest-layout class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Register</h2>
            <p class="text-gray-500">Create your account to get started</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- First Name -->
            <div class="mb-4">
                <x-input-label for="first_name" :value="__('First Name')" class="text-gray-700" />
                <x-text-input id="first_name" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <!-- Last Name -->
            <div class="mb-4">
                <x-input-label for="last_name" :value="__('Last Name')" class="text-gray-700" />
                <x-text-input id="last_name" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
            
            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                <x-text-input id="email" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                <x-text-input id="password" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            
            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                <x-text-input id="password_confirmation" class="block w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            
            <div class="flex flex-col items-center space-y-4">
                <a class="text-sm text-indigo-600 hover:underline" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <br>
                <div class="flex justify-center">
                    <x-primary-button class="py-2 px-6 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </div>
        </form>

</x-guest-layout>
