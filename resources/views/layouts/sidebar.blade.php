<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route("home") }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            {{ config('app.name', 'Laravel') }}
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <x-sidebar-link href="{{ route('home') }}"><i class="nav-icon fas fa-tachometer-alt"></i><p>{{ __('Dashboard') }}</p></x-sidebar-link>
                <x-sidebar-link :active="(request()->is('recipe*'))" href="{{ route('recipe.index') }}"><i class="nav-icon fas fa-list"></i>{{ __('Recipe') }}</x-sidebar-link>
                <x-sidebar-link :active="(request()->is('category*'))" href="{{ route('category.index') }}"><i class="nav-icon fas fa-list"></i>{{ __('Category') }}</x-sidebar-link>
                <x-sidebar-link :active="(request()->is('ingredient*'))" href="{{ route('ingredient.index') }}"><i class="nav-icon fas fa-list"></i>{{ __('Ingredient') }}</x-sidebar-link>
                <x-sidebar-link :active="(request()->is('user*'))" href="{{ route('user.index') }}"><i class="nav-icon fas fa-user"></i>{{ __('User') }}</x-sidebar-link>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>