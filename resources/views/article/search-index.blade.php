<x-layout>

    <header class="container-fluid py-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-3">Risultati ricerca</h1>

                @if ($query)
                    <p class="lead">
                        Hai cercato: <strong>{{ $query }}</strong>
                    </p>
                @endif
            </div>
        </div>
    </header>

    <section class="container my-5">
        <div class="row justify-content-center">

            @forelse ($articles as $article)
                <div class="col-12 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">

                        @if ($article->image)
                            <img src="{{ Storage::url($article->image) }}" class="card-img-top"
                                alt="{{ $article->title }}">
                        @else
                            <img src="https://picsum.photos/300/200" class="card-img-top" alt="Immagine articolo">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>

                            <p class="card-text">
                                {{ $article->subtitle }}
                            </p>

                            <p class="small mb-1">
                                Categoria:
                                <a href="{{ route('article.byCategory', $article->category) }}">
                                    {{ $article->category->name }}
                                </a>
                            </p>

                            <p class="small mb-1">
                                Autore:
                                <a href="{{ route('article.byUser', $article->user) }}">
                                    {{ $article->user->name }}
                                </a>
                            </p>

                            <p class="small text-muted">
                                Pubblicato il {{ $article->created_at->format('d/m/Y') }}
                            </p>

                            @if ($article->tags->count())
                                <div class="mb-3">
                                    @foreach ($article->tags as $tag)
                                        <span class="badge text-bg-secondary me-1">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <a href="{{ route('article.show', $article) }}" class="btn btn-primary mt-auto">
                                Leggi
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <h2>Nessun articolo trovato</h2>
                    <p>Prova a cercare un altro titolo, sottotitolo o categoria.</p>
                    <a href="{{ route('homepage') }}" class="btn btn-primary">
                        Torna alla homepage
                    </a>
                </div>
            @endforelse

        </div>
    </section>

</x-layout>

