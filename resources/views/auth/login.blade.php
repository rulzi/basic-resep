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

        <form method="POST" action="{{ route('login') }}">
            @csrf
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
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <x-button>
                        {{ __('Login') }}
                    </x-button>
                </div>
            <!-- /.col -->
            </div>
        </form>
        <p class="mb-1 text-center">
            User : admin@gmail.com<br>
            Password : default12
        </p>
        <p class="mb-1">
            <a href="{{ route('password.request') }}">I forgot my password</a>
        </p>
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
        </p>
    </x-auth-card>
</x-guest-layout>
