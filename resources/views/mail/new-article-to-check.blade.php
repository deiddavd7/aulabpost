<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuovo articolo da revisionare</title>
</head>
<body>
    <h1>Nuovo articolo da revisionare</h1>

    <p>
        È stato inserito un nuovo articolo su <strong>The Aulab Post</strong>.
    </p>

    <h2>{{ $article->title }}</h2>

    <p>
        <strong>Sottotitolo:</strong> {{ $article->subtitle }}
    </p>

    <p>
        <strong>Autore:</strong> {{ $article->user ? $article->user->name : 'Autore non disponibile' }}
    </p>

    <p>
        <strong>Categoria:</strong> {{ $article->category ? $article->category->name : 'Nessuna categoria' }}
    </p>

    <p>
        Accedi alla Dashboard Revisor per accettare o rifiutare l’articolo.
    </p>

    <p>
        <a href="{{ route('revisor.dashboard') }}">
            Vai alla Dashboard Revisor
        </a>
    </p>
</body>
</html>
