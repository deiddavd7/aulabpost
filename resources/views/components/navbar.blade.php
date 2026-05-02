<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('homepage') }}">The Aulab Post</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('homepage') }}">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Accedi</a>
                    </li>
                @endguest

                @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ route('article.create') }}">Inserisci articolo</a>
    </li>

    <li class="nav-item">
        <span class="nav-link">Ciao, {{ Auth::user()->name }}</span>
    </li>

    <li class="nav-item">
        <a 
            class="nav-link" 
            href="#"
            onclick="event.preventDefault(); document.querySelector('#form-logout').submit();"
        >
            Logout
        </a>

        <form id="form-logout" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
@endauth
            </ul>
        </div>
    </div>
</nav>



