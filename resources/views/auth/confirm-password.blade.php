<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                {{ config('app.name', 'Laravel') }}
            </a>
        </x-slot>

        <p class="login-box-msg">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <x-input-group class="mb-3">
                <x-slot name="icon">
                    <span class="fas fa-lock"></span>
                </x-slot>
                <x-input id="password" type="password" name="password" required placeholder="{{ __('Password') }}" />    
            </x-input-group>

            <div class="flex justify-end">
                <x-button class="btn-block">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
