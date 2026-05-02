<div class="mb-5">

    <h2 class="mb-3">
        Richieste per diventare {{ ucfirst($role) }}
    </h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ruolo richiesto</th>
                    <th>Azione</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($roleRequests as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($role) }}</td>
                        <td>
                            @switch($role)

                                @case('admin')
                                    <form action="{{ route('admin.makeAdmin', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success btn-sm">
                                            Rendi admin
                                        </button>
                                    </form>
                                    @break

                                @case('revisor')
                                    <form action="{{ route('admin.makeRevisor', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success btn-sm">
                                            Rendi revisor
                                        </button>
                                    </form>
                                    @break

                                @case('writer')
                                    <form action="{{ route('admin.makeWriter', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success btn-sm">
                                            Rendi writer
                                        </button>
                                    </form>
                                    @break

                            @endswitch
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            Nessuna richiesta per questo ruolo.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

