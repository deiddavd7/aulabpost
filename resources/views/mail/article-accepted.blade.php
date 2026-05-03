<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Articolo accettato</title>
</head>
<body>
    <h1>Il tuo articolo è stato accettato</h1>

    <p>
        Ciao {{ $article->user ? $article->user->name : 'utente' }},
    </p>

    <p>
        Il tuo articolo è stato revisionato e accettato su <strong>The Aulab Post</strong>.
    </p>

    <h2>{{ $article->title }}</h2>

    <p>
        <strong>Sottotitolo:</strong> {{ $article->subtitle }}
    </p>

    <p>
        Ora il tuo articolo è visibile pubblicamente sul sito.
    </p>

    <p>
        <a href="{{ route('article.show', $article) }}">
            Visualizza articolo
        </a>
    </p>
</body>
</html>
