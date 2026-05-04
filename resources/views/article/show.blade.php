<x-layout>

    <article class="container my-5">

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">

                <h1 class="display-4 mb-3">{{ $article->title }}</h1>

                <p class="lead">
                    {{ $article->subtitle }}
                </p>

                <div class="mb-3">
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

                    <p class="small mb-1">
                        Tempo di lettura:
                        <strong>{{ $article->reading_time }} min</strong>
                    </p>

                    <p class="small text-muted">
                        Pubblicato il {{ $article->created_at->format('d/m/Y') }}
                    </p>
                </div>

                @if ($article->tags->count())
                    <div class="mb-4">
                        <h6>Tags:</h6>
                        @foreach ($article->tags as $tag)
                            <span class="badge text-bg-secondary me-1">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                @if ($article->image)
                    <img src="{{ Storage::url($article->image) }}" class="img-fluid rounded shadow-sm mb-4"
                        alt="{{ $article->title }}">
                @else
                    <img src="https://picsum.photos/900/500" class="img-fluid rounded shadow-sm mb-4"
                        alt="Immagine articolo">
                @endif

                <div class="fs-5 lh-lg">
                    {!! nl2br(e($article->body)) !!}
                </div>

                @auth
                    @if (Auth::user()->is_revisor)
                        <div class="mt-5 p-4 border rounded bg-light">
                            <h4 class="mb-3">Area revisore</h4>

                            <div class="d-flex flex-wrap gap-2">

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

                                <form action="{{ route('revisor.undoArticle', $article) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning">
                                        Riporta in revisione
                                    </button>
                                </form>

                            </div>
                        </div>
                    @endif
                @endauth

                <div class="mt-5">
                    <a href="{{ route('article.index') }}" class="btn btn-outline-primary">
                        Torna agli articoli
                    </a>
                </div>

            </div>
        </div>

    </article>

</x-layout>

