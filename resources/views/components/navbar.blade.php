<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('homepage') }}">The Aulab Post</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('article.index') }}">Articoli</a>
                </li>

                @auth
                    @if (Auth::user()->is_writer)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('article.create') }}">Inserisci articolo</a>
                        </li>
                    @endif
                @endauth

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('careers') }}">Lavora con noi</a>
                </li>

            </ul>

            <form class="d-flex me-3" role="search" action="{{ route('article.search') }}" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Cerca articoli"
                    aria-label="Search" value="{{ request('query') }}">
                <button class="btn btn-outline-success" type="submit">Cerca</button>
            </form>

            <ul class="navbar-nav mb-2 mb-lg-0">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Accedi</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Ciao, {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            @if (Auth::user()->is_admin)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        Dashboard Admin
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->is_revisor)
                                <li>
                                    <a class="dropdown-item" href="{{ route('revisor.dashboard') }}">
                                        Dashboard Revisor
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->is_writer)
                                <li>
                                    <a class="dropdown-item" href="{{ route('writer.dashboard') }}">
                                        Dashboard Writer
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->is_admin || Auth::user()->is_revisor || Auth::user()->is_writer)
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>

