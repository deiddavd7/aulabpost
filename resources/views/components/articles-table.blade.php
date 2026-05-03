<div class="mb-5">

    <h2 class="mb-3">{{ $title }}</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Categoria</th>
                    <th>Autore</th>
                    <th>Data</th>
                    <th>Azione</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->category?->name ?? 'Nessuna categoria' }}</td>
                        <td>{{ $article->user?->name ?? 'Utente eliminato' }}</td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>

                        <td>
                            @if ($status === 'pending')
                                <a href="{{ route('article.show', $article) }}" class="btn btn-primary btn-sm">
                                    Revisiona
                                </a>
                            @else
                                <form action="{{ route('revisor.undoArticle', $article) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-warning btn-sm">
                                        Rimetti in revisione
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Nessun articolo presente.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

