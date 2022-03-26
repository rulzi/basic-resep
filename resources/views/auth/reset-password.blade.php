<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                {{ config('app.name', 'Laravel') }}
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-input-group class="mb-3">
                <x-slot name="icon">
                    <span class="fas fa-envelope"></span>
                </x-slot>
                <x-input id="email" type="email" name="email" :value="old('email', $request->email)"  placeholder="{{ __('Email') }}" required autofocus />
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
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <x-button class="btn-block">
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            <!-- /.col -->
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
