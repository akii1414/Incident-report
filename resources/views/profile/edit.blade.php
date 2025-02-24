<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
        @if (session('status') === 'profile-updated')
        <!-- Popup Modal -->
        <div x-data="{ show: true }" x-show="show" x-transition.opacity
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
                <h2 class="text-lg font-bold text-gray-900">Profile Updated</h2>
                <p class="text-sm text-gray-600 mt-2">Your profile has been successfully updated.</p>

                <!-- Buttons -->
                <div class="mt-4 flex justify-center gap-3">
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 bg-gray-500 text-white text-sm rounded-md shadow hover:bg-gray-700 transition">
                        Go to Dashboard
                    </a>
                </div>
            </div>
        </div>
    @endif
    <br>

    <div class="flex justify-center items-center min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
