<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-6 mb-3">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" name="first_name" type="text" class="form-control" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>
        
            <div class="col-md-6 mb-3">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" name="last_name" type="text" class="form-control" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
        
            <div class="col-md-6 mb-3">
                <x-input-label for="middle_name" :value="__('Middle Initial')" />
                <x-text-input id="middle_name" name="middle_name" type="text" class="form-control" :value="old('middle_name', optional($user->profile)->middle_name)" required autofocus autocomplete="middle_name" />
                <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
            </div>
        
            <div class="col-md-6 mb-3">
                <x-input-label for="position" :value="__('Position Title')" />
                <x-text-input id="position" name="position" type="text" class="form-control" :value="old('position', optional($user->profile)->position)" required/>
                <x-input-error class="mt-2" :messages="$errors->get('position')" />
            </div>
        
            <div class="col-md-6 mb-3">
                <x-input-label for="division" :value="__('Division/ Section')" />
                <select id="division" name="division" class="form-control">
                    <option value="">Select Division</option>
                    <option value="Network" {{ old('division', optional($user->profile)->division) == 'Network' ? 'selected' : '' }}>Network</option>
                    <option value="Server" {{ old('division', optional($user->profile)->division) == 'Server' ? 'selected' : '' }}>Server</option>
                    <option value="Infosys" {{ old('division', optional($user->profile)->division) == 'Infosys' ? 'selected' : '' }}>Infosys</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('division')" />
            </div>
        
            <div class="col-md-6 mb-3">
                <x-input-label for="mobile_number" :value="__('Mobile Phone')" />
                <x-text-input id="mobile_number" name="mobile_number" type="text" class="form-control" :value="old('mobile_number', optional($user->profile)->mobile_number)" required pattern="\d{11}" maxlength="11" />
                <x-input-error class="mt-2" :messages="$errors->get('mobile_number')" />
            </div>
        
            <div class="col-md-6 mb-3">
                <x-input-label for="local_number" :value="__('Local Phone')" />
                <x-text-input id="local_number" name="local_number" type="text" class="form-control" :value="old('local_number', optional($user->profile)->local_number)" required pattern="\d{4}" maxlength="4"  />
                <x-input-error class="mt-2" :messages="$errors->get('local_number')" />
            </div>
        
            <div class="col-md-6 mb-3">
                <x-input-label for="birthday" :value="__('Birthday')" />
                <x-text-input id="birthday" name="birthday" type="date" class="form-control" :value="old('birthday', optional($user->profile)->birthday)" />
                <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
            </div>
        
            <div class="col-md-6 mb-3">
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', optional($user->profile)->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', optional($user->profile)->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', optional($user->profile)->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>
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
