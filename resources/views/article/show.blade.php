<x-layout>

    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">

                <h1 class="display-4 fw-bold">{{ $article->title }}</h1>
                <h2 class="h4 text-muted mb-4">{{ $article->subtitle }}</h2>

                <img 
                    src="{{ Storage::url($article->image) }}" 
                    alt="{{ $article->title }}" 
                    class="img-fluid rounded shadow-sm mb-4"
                >

                <div class="mb-4">
                    <p>
                        Categoria:
                        <a href="{{ route('article.byCategory', $article->category) }}">
                            {{ $article->category?->name ?? 'Nessuna categoria' }}
                        </a>
                    </p>

                    <p>
                        Autore:
                        <a href="{{ route('article.byUser', $article->user) }}">
                            {{ $article->user?->name ?? 'Utente eliminato' }}
                        </a>
                    </p>

                    <p class="text-muted">
                        Pubblicato il {{ $article->created_at->format('d/m/Y') }}
                    </p>
                </div>

                <p class="fs-5">
                    {{ $article->body }}
                </p>

                @auth
                    @if (Auth::user()->is_revisor)
                        <div class="d-flex gap-2 mt-5">
                            <form action="{{ route('revisor.acceptArticle', $article) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-success">
                                    Accetta articolo
                                </button>
                            </form>

                            <form action="{{ route('revisor.rejectArticle', $article) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-danger">
                                    Rifiuta articolo
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth

                <a href="{{ route('article.index') }}" class="btn btn-secondary mt-4">
                    Torna agli articoli
                </a>

            </div>
        </div>
    </section>

</x-layout>

