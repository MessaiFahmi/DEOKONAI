<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 sticky-top">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">{{ config('app.name') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                @if(Route::has('posts.index'))
                    <li class="nav-item">
                        <a href="{{ route('posts.index') }}" class="nav-link">Blog</a>
                    </li>
                @endif 
                <li class="nav-item dropdown dropstart">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        @if(Auth::check())
                            @if(Route::has('profiles.me'))
                                <li>
                                    <a href="{{ route('profiles.me') }}" class="dropdown-item">
                                        <i class="bi mx-1 bi-person-circle"></i> 
                                        Mon profil
                                    </a>
                                </li>
                            @endif
                            @if(Route::has('logout'))
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-clear-light p-0 text-danger">
                                            <i class="bi mx-1 bi-box-arrow-right"></i>
                                            Déconnexion
                                        </button>
                                    </form>
                                </li>
                            @endif
                            @if(Route::has('admin.index'))
                                @can('admin-pannel')
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a href="{{ route('admin.index') }}" class="dropdown-item">
                                            <i class="bi mx-1 bi-speedometer2"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                @endcan
                            @endif
                        @else
                            @if(Route::has('login'))
                                <li>
                                    <a href="{{ route('login') }}" class="dropdown-item">
                                    <i class="bi mx-1 bi-box-arrow-in-left"></i>
                                        Connexion
                                    </a>
                                </li>
                            @endif
                            @if(Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}" class="dropdown-item">
                                        <i class="bi mx-1 bi-person-plus"></i>
                                        Inscription
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>