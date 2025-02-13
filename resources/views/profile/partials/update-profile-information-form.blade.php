<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>
        <div>
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" :value="old('middle_name', $user->middle_name)" required autofocus autocomplete="middle_name" />
            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
        </div>
        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="position" :value="__('Position Title')" />
            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', optional($user->profile)->position)"/>
            <x-input-error class="mt-2" :messages="$errors->get('position')" />
        </div>
        <div>
            <x-input-label for="division" :value="__('Division/ Section')" />
            <select id="division" name="division" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select Division</option>
                <option value="Network" {{ old('division', optional($user->profile)->division) == 'Network' ? 'selected' : '' }}>Network</option>
                <option value="Server" {{ old('division', optional($user->profile)->division) == 'Server' ? 'selected' : '' }}>Server</option>
                <option value="Infosys" {{ old('division', optional($user->profile)->division) == 'Infosys' ? 'selected' : '' }}>Infosys</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('division')" />
        </div>

        <div>
            <x-input-label for="mobile_number" :value="__('Mobile Phone')" />
            <x-text-input id="mobile_number" name="mobile_number" type="number" class="mt-1 block w-full" :value="old('mobile_number', optional($user->profile)->mobile_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('mobile_number')" />
        </div>
        <div>
            <x-input-label for="local_number" :value="__('Local Phone')" />
            <x-text-input id="local_number" name="local_number" type="number" class="mt-1 block w-full" :value="old('local_number', optional($user->profile)->local_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('local_number')" />
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', optional($user->profile)->birthday)" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender', optional($user->profile)->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', optional($user->profile)->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender', optional($user->profile)->gender) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
