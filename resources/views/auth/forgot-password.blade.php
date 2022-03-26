<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                {{ config('app.name', 'Laravel') }}
            </a>
        </x-slot>

        <p class="login-box-msg">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <x-input-group class="mb-3">
                <x-slot name="icon">
                    <span class="fas fa-envelope"></span>
                </x-slot>
                <x-input id="email" type="email" name="email" :value="old('email')"  placeholder="{{ __('Email') }}" required autofocus />
            </x-input-group>

            <div class="flex items-center">
                <x-button class="btn-block">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
