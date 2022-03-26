<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                {{ config('app.name', 'Laravel') }}
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-input-group class="mb-3">
                <x-slot name="icon">
                    <span class="fas fa-user"></span>
                </x-slot>
                <x-input id="name" type="text" name="name" :value="old('name')" placeholder="{{ __('Name') }}" required autofocus />
            </x-input-group>
            <x-input-group class="mb-3">
                <x-slot name="icon">
                    <span class="fas fa-envelope"></span>
                </x-slot>
                <x-input id="email" type="email" name="email" :value="old('email')"  placeholder="{{ __('Email') }}" required autofocus />
            </x-input-group>
            <x-input-group class="mb-3">
                <x-slot name="icon">
                    <span class="fas fa-lock"></span>
                </x-slot>
                <x-input id="password" type="password" name="password" required placeholder="{{ __('Password') }}" />    
            </x-input-group>
            <x-input-group class="mb-3">
                <x-slot name="icon">
                    <span class="fas fa-lock"></span>
                </x-slot>
                <x-input id="password_confirmation" type="password" name="password_confirmation" required placeholder="{{ __('Confirm Password') }}" />    
            </x-input-group>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                    <label for="agreeTerms">
                        I agree to the <a href="#">terms</a>
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <x-button class="btn-block">
                        {{ __('Register') }}
                    </x-button>
                </div>
            <!-- /.col -->
            </div>
            <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
        </form>
    </x-auth-card>
</x-guest-layout>
