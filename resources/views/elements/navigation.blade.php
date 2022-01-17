<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            <i class="fas fa-dumbbell"></i> <span><strong>Hawkers</strong>Gym</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto"></ul>
            <!-- Middle of Navbar -->
            <ul class="navbar-nav mm-auto">
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ Auth::user()->displayname }}/training/diary">Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ Auth::user()->displayname }}/nutrition">Nutrition</a>
                    </li>
                    <li class="nav-item" style="margin-left: 5px;">
                        <form action="/search" method="POST">
                            @csrf
                            <input class='form-control' type='text' name="search" id="id_search" placeholder="Search">
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/notifications">Notifications <small>({{ count(Auth::user()->unreadNotifications) }})</small></a>
                    </li>
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ isset(Auth::user()->displayname) ? Auth::user()->displayname : Auth::user()->name }}
                        </a>
                        <div class="dropdown-content dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdown">
                            @if(isset(Auth::user()->profile))
                                <a class="dropdown-item" href="/profile/{{ Auth::user()->displayname }}">
                                    Profile
                                </a>
                            @endif
                            <a class="dropdown-item" href="/notifications">Notifications <small>({{ count(Auth::user()->unreadNotifications) }})</small></a>
                            <a class="dropdown-item" href="/account">Account</a>
                            @if(Auth::user()->isAdmin())
                                <a class="dropdown-item" href="/admin-dashboard">Admin Dashboard</a>
                                <a class="dropdown-item" href="/users">Users</a>
                            @endif
                            <a class="dropdown-item" href="/logout">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
