<x-guest-layout>
    <div class="form-container">
        <h2 class="text-center mb-4">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="error-message" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
            </div>

            <!-- Role -->
            <div class="mb-4">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role" class="form-control" required>
                    <option value="">{{ __('Select Role') }}</option>
                    @foreach(['Buyer', 'Seller', 'Driver'] as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('role')" class="error-message" />
            </div>

            <!-- District -->
            <div class="mb-4">
                <x-input-label for="district" :value="__('District')" />
                <select id="district" name="district" class="form-control" required>
                    <option value="">{{ __('Select District') }}</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->district_id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('district')" class="error-message" />
            </div>

            <div class="flex items-center justify-between mt-4">
                {{ __('Already registered?') }}
                <a class="register-link" href="{{ route('login') }}">
                   {{__('Login')}}
                </a>

                <x-primary-button class="primary-button">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
