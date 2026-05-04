@props(['items', 'type'])

<div class="card shadow-sm my-4">
    <div class="card-header">
        <h3 class="mb-0">
            Gestione {{ $type === 'tags' ? 'Tags' : 'Categorie' }}
        </h3>
    </div>

    <div class="card-body">

        @if ($items->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Modifica</th>
                            <th>Cancella</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>

                                <td>
                                    @if ($type === 'tags')
                                        #{{ $item->name }}
                                    @else
                                        {{ $item->name }}
                                    @endif
                                </td>

                                <td>
                                    @if ($type === 'tags')
                                        <form action="{{ route('admin.tag.update', $item) }}" method="POST"
                                            class="d-flex gap-2">
                                            @csrf
                                            @method('PATCH')

                                            <input type="text" name="name" class="form-control"
                                                value="{{ $item->name }}">

                                            <button type="submit" class="btn btn-warning">
                                                Modifica
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.category.update', $item) }}" method="POST"
                                            class="d-flex gap-2">
                                            @csrf
                                            @method('PATCH')

                                            <input type="text" name="name" class="form-control"
                                                value="{{ $item->name }}">

                                            <button type="submit" class="btn btn-warning">
                                                Modifica
                                            </button>
                                        </form>
                                    @endif
                                </td>

                                <td>
                                    @if ($type === 'tags')
                                        <form action="{{ route('admin.tag.delete', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                Cancella
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.category.delete', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                Cancella
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="mb-0">
                Nessun elemento presente.
            </p>
        @endif

    </div>
</div>

