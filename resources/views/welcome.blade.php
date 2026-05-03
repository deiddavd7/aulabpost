<x-layout>
    @if (session('message'))
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    </div>
@endif

    @if (session('message'))
        <div class="alert alert-success text-center mb-0">
            {{ session('message') }}
        </div>
    @endif

    <section class="container min-vh-75 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1 class="display-1 fw-bold">The Aulab Post</h1>
            <p class="lead">Il blog degli sviluppatori Aulab</p>
        </div>
    </section>

    <section class="container py-5">
        <h2 class="text-center mb-5">Ultimi articoli</h2>

        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img 
                            src="{{ Storage::url($article->image) }}" 
                            class="card-img-top" 
                            alt="{{ $article->title }}"
                        >

                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->subtitle }}</p>

                            <p class="small mb-1">
                                Categoria:
                                <a href="{{ route('article.byCategory', $article->category) }}">
                                    {{ $article->category?->name ?? 'Nessuna categoria' }}
                                </a>
                            </p>

                            <p class="small text-muted">
                                Autore:
                                <a href="{{ route('article.byUser', $article->user) }}">
                                    {{ $article->user?->name ?? 'Utente eliminato' }}
                                </a>
                            </p>

                            <a href="{{ route('article.show', $article) }}" class="btn btn-primary">
                                Leggi
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Non ci sono ancora articoli.</p>
                </div>
            @endforelse
        </div>
    </section>

</x-layout>

