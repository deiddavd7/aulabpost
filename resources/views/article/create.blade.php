<x-layout>

    <header class="container-fluid py-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-3">Inserisci un nuovo articolo</h1>
                <p class="lead">Compila il form per inviare il tuo articolo alla revisione</p>
            </div>
        </div>
    </header>

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">

                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data"
                    class="card p-4 shadow-sm">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">

                        @error('title')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sottotitolo</label>
                        <input type="text" name="subtitle" id="subtitle"
                            class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle') }}">

                        @error('subtitle')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine di copertina</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoria</label>
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Seleziona una categoria</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
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
                            class="form-control @error('tags') is-invalid @enderror" value="{{ old('tags') }}"
                            placeholder="Esempio: sport, calcio, serie a">

                        <p class="form-text">
                            Inserisci i tags separati da virgola.
                        </p>

                        @error('tags')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Corpo dell'articolo</label>
                        <textarea name="body" id="body" rows="8" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>

                        @error('body')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Invia articolo
                    </button>
                </form>

            </div>
        </div>
    </section>

</x-layout>

