<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <x-navbar-link :href="route('profile.index')">{{ __('Profile') }}</x-navbar-link>
        <li class="nav-item d-sm-inline-block">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-navbar-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Logout') }}
                </x-navbar-link>
            </form>
        </li>
    </ul>
</nav>