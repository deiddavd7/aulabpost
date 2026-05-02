<x-layout>

    <section class="container py-5">
        <h1 class="text-center mb-5">
            Articoli nella categoria: {{ $category->name }}
        </h1>

        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img 
                            src="{{ Storage::url($article->image) }}" 
                            class="card-img-top" 
                            alt="{{ $article->title }}"
                        >

                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->subtitle }}</p>

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
                    <p class="text-center">Non ci sono articoli in questa categoria.</p>
                </div>
            @endforelse
        </div>
    </section>

</x-layout>

