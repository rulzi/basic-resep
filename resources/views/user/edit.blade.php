<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('User') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </x-slot>
    @if(session('success'))
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
    @endif
    <form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST">
        <x-card class="col-sm-12">
            <x-slot name="title">{{ __('Edit') }} {{ __('User') }}</x-slot>
            @csrf
            @method('PUT')
            <div class="form-group row">
                <x-label class="col-sm-2">{{ __('Name') }}</x-label>
                <div class="col-sm-10">
                    <x-input id="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" :value="old('name', $user->name)"/>
                    @if ($errors->has('name'))
                        <small class="error invalid-feedback">{{ $errors->first('name') }}</small>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <x-label class="col-sm-2">{{ __('Email') }}</x-label>
                <div class="col-sm-10">
                    <x-input id="email" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="email" name="email" :value="old('email', $user->email)"/>
                    @if ($errors->has('email'))
                        <small class="error invalid-feedback">{{ $errors->first('email') }}</small>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <x-label class="col-sm-2">{{ __('Password') }}</x-label>
                <div class="col-sm-10">
                    <x-input id="password" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="password" name="password" :value="old('password')"/>
                    <small>{{ __('Empty If not Change') }}</small>
                    @if ($errors->has('password'))
                        <small class="error invalid-feedback">{{ $errors->first('password') }}</small>
                    @endif
                </div>
            </div>
            <x-slot name="footer">
                <x-button>{{ __('Save') }}</x-button>
            </x-slot>
        </x-card>
    </form>
</x-app-layout>
