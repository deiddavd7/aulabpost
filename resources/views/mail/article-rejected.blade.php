<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Articolo rifiutato</title>
</head>
<body>
    <h1>Il tuo articolo è stato rifiutato</h1>

    <p>
        Ciao {{ $article->user ? $article->user->name : 'utente' }},
    </p>

    <p>
        Il tuo articolo è stato revisionato e purtroppo non è stato approvato.
    </p>

    <h2>{{ $article->title }}</h2>

    <p>
        <strong>Sottotitolo:</strong> {{ $article->subtitle }}
    </p>

    <p>
        Puoi scrivere un nuovo articolo e inviarlo nuovamente alla redazione.
    </p>

    <p>
        Grazie,<br>
        The Aulab Post
    </p>
</body>
</html>
