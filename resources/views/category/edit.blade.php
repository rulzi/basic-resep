<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Category') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                
            </div><!-- /.col -->
        </div><!-- /.row -->
    </x-slot>
    @if(session('success'))
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
    @endif
    <form class="form-horizontal" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        <x-card-navbar>
            <x-slot name="header">
                <li class="pt-2 px-3"><h3 class="card-title">{{ __('Category') }}</h3></li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-home-tab" href="{{ route('category.index') }}">{{ __('List') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" href="{{ route('category.create') }}">{{ __('Add') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-messages-tab" href="#">{{ __('Edit') }}</a>
                </li>
            </x-slot>
            @csrf
            @method("PUT")
            <div class="form-group row">
                <x-label class="col-sm-2">{{ __('Name') }}</x-label>
                <div class="col-sm-10">
                    <x-input id="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" :value="old('name', $category->name)"/>
                    @if ($errors->has('name'))
                        <small class="error invalid-feedback">{{ $errors->first('name') }}</small>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <x-label class="col-sm-2">{{ __('Description') }}</x-label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description">{{ old('description', $category->description) }}</textarea>
                    @if ($errors->has('description'))
                        <small class="error invalid-feedback">{{ $errors->first('description') }}</small>
                    @endif
                </div>
            </div>
            <x-slot name="footer">
                <x-button class="float-right">{{ __('Save') }}</x-button>
            </x-slot>
        </x-card-navbar>
    </form>
</x-app-layout>
