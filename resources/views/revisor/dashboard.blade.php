<x-layout>
    <div class="container my-5">

        <div class="row">
            <div class="col-12 text-center">
                <h1>Dashboard Revisor</h1>
                <p class="lead">Qui puoi revisionare gli articoli inseriti dagli utenti.</p>
            </div>
        </div>

        @if (session('message'))
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="alert alert-success text-center">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row my-5">
            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h3>{{ $articles_to_check->count() }}</h3>
                        <p class="mb-0">Articoli da revisionare</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h3>{{ $accepted_articles->count() }}</h3>
                        <p class="mb-0">Articoli accettati</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h3>{{ $rejected_articles->count() }}</h3>
                        <p class="mb-0">Articoli rifiutati</p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row my-5">
            <div class="col-12 text-center">
                <h2>Articoli da revisionare</h2>
            </div>
        </div>

        @if ($articles_to_check->isEmpty())
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h4>Non ci sono articoli da revisionare.</h4>
                    <a href="{{ route('homepage') }}" class="btn btn-primary mt-3">Torna alla homepage</a>
                </div>
            </div>
        @else
            @foreach ($articles_to_check as $article)
                <div class="row justify-content-center my-5">
                    <div class="col-12 col-md-10">
                        <div class="card shadow">
                            <div class="row g-0">
                                <div class="col-12 col-md-4">
                                    @if ($article->image)
                                        <img src="{{ Storage::url($article->image) }}" class="img-fluid rounded-start" alt="{{ $article->title }}">
                                    @else
                                        <img src="https://picsum.photos/400/300" class="img-fluid rounded-start" alt="Immagine casuale">
                                    @endif
                                </div>

                                <div class="col-12 col-md-8">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $article->title }}</h3>
                                        <h5 class="card-subtitle mb-3 text-muted">{{ $article->subtitle }}</h5>

                                        <p class="card-text">
                                            {{ Illuminate\Support\Str::limit($article->body, 250) }}
                                        </p>

                                        <p class="small text-muted">
                                            Categoria:
                                            <strong>{{ $article->category ? $article->category->name : 'Nessuna categoria' }}</strong>
                                        </p>

                                        <p class="small text-muted">
                                            Autore:
                                            <strong>{{ $article->user ? $article->user->name : 'Autore non disponibile' }}</strong>
                                        </p>

                                        <div class="d-flex gap-2 mt-4">
                                            <form action="{{ route('revisor.acceptArticle', $article) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success">
                                                    Accetta
                                                </button>
                                            </form>

                                            <form action="{{ route('revisor.rejectArticle', $article) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger">
                                                    Rifiuta
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <hr class="my-5">

        <div class="row my-5">
            <div class="col-12 text-center">
                <h2>Ultimi articoli accettati</h2>
            </div>
        </div>

        @if ($accepted_articles->isEmpty())
            <div class="row">
                <div class="col-12 text-center">
                    <p>Nessun articolo accettato.</p>
                </div>
            </div>
        @else
            <div class="row">
                @foreach ($accepted_articles->take(3) as $article)
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            @if ($article->image)
                                <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                            @else
                                <img src="https://picsum.photos/400/300" class="card-img-top" alt="Immagine casuale">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ Illuminate\Support\Str::limit($article->body, 100) }}</p>
                                <span class="badge bg-success">Accettato</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <hr class="my-5">

        <div class="row my-5">
            <div class="col-12 text-center">
                <h2>Ultimi articoli rifiutati</h2>
            </div>
        </div>

        @if ($rejected_articles->isEmpty())
            <div class="row">
                <div class="col-12 text-center">
                    <p>Nessun articolo rifiutato.</p>
                </div>
            </div>
        @else
            <div class="row">
                @foreach ($rejected_articles->take(3) as $article)
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            @if ($article->image)
                                <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                            @else
                                <img src="https://picsum.photos/400/300" class="card-img-top" alt="Immagine casuale">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ Illuminate\Support\Str::limit($article->body, 100) }}</p>
                                <span class="badge bg-danger">Rifiutato</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-layout>

