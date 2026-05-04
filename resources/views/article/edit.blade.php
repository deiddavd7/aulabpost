<x-layout>

    <header class="container-fluid py-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-3">Modifica articolo</h1>
                <p class="lead">Dopo la modifica, l'articolo tornerà in revisione</p>
            </div>
        </div>
    </header>

    @if ($errors->any())
        <div class="container mt-4">
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">

                <form action="{{ route('writer.article.update', $article) }}" method="POST"
                    enctype="multipart/form-data" class="card p-4 shadow-sm">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $article->title) }}">

                        @error('title')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sottotitolo</label>
                        <input type="text" name="subtitle" id="subtitle"
                            class="form-control @error('subtitle') is-invalid @enderror"
                            value="{{ old('subtitle', $article->subtitle) }}">

                        @error('subtitle')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoria</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Seleziona una categoria</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id', $article->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" name="tags" id="tags"
                            class="form-control @error('tags') is-invalid @enderror"
                            value="{{ old('tags', $articleTags) }}"
                            placeholder="Esempio: sport, calcio, serie a">

                        <p class="form-text">
                            Inserisci i tags separati da virgola.
                        </p>

                        @error('tags')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine di copertina</label>

                        @if ($article->image)
                            <div class="mb-3">
                                <p class="small text-muted">Immagine attuale:</p>
                                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                                    class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                            </div>
                        @endif

                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">

                        <p class="form-text">
                            Carica una nuova immagine solo se vuoi sostituire quella attuale.
                        </p>

                        @error('image')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Corpo dell'articolo</label>
                        <textarea name="body" id="body" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body', $article->body) }}</textarea>

                        @error('body')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Salva modifiche
                        </button>

                        <a href="{{ route('writer.dashboard') }}" class="btn btn-outline-secondary">
                            Annulla
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </section>

</x-layout>

