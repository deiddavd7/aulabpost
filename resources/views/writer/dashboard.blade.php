<x-layout>

    <header class="container-fluid py-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-3">Dashboard Writer</h1>
                <p class="lead">Gestisci i tuoi articoli</p>
            </div>
        </div>
    </header>

    @if (session('message'))
        <div class="container mt-4">
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <section class="container my-5">

        <div class="row mb-4">
            <div class="col-12 text-end">
                <a href="{{ route('article.create') }}" class="btn btn-primary">
                    Inserisci nuovo articolo
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                @if ($articles->count())
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Titolo</th>
                                    <th>Categoria</th>
                                    <th>Stato</th>
                                    <th>Tags</th>
                                    <th>Data</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>
                                            {{ $article->title }}
                                        </td>

                                        <td>
                                            {{ $article->category->name }}
                                        </td>

                                        <td>
                                            @if ($article->is_accepted === null)
                                                <span class="badge text-bg-warning">
                                                    In revisione
                                                </span>
                                            @elseif ($article->is_accepted)
                                                <span class="badge text-bg-success">
                                                    Accettato
                                                </span>
                                            @else
                                                <span class="badge text-bg-danger">
                                                    Rifiutato
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($article->tags->count())
                                                @foreach ($article->tags as $tag)
                                                    <span class="badge text-bg-secondary me-1">
                                                        #{{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">Nessun tag</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $article->created_at->format('d/m/Y') }}
                                        </td>

                                        <td>
                                            <div class="d-flex flex-wrap gap-2">

                                                <a href="{{ route('writer.article.edit', $article) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Modifica
                                                </a>

                                                <form action="{{ route('writer.article.delete', $article) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Sei sicuro di voler cancellare questo articolo?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Cancella
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center">
                        <h2>Non hai ancora scritto articoli</h2>
                        <p>Inizia subito creando il tuo primo articolo.</p>

                        <a href="{{ route('article.create') }}" class="btn btn-primary">
                            Inserisci articolo
                        </a>
                    </div>
                @endif

            </div>
        </div>

    </section>

</x-layout>

