<x-layout>
    <div class="container my-5">

        <div class="row">
            <div class="col-12 text-center">
                <h1>Dashboard Admin</h1>
                <p class="lead">Gestisci le richieste di ruolo degli utenti.</p>
            </div>
        </div>

        @if (session('message'))
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="alert alert-success text-center">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row my-5">
            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h3>{{ $admin_requests->count() }}</h3>
                        <p class="mb-0">Richieste Admin</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h3>{{ $revisor_requests->count() }}</h3>
                        <p class="mb-0">Richieste Revisor</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h3>{{ $writer_requests->count() }}</h3>
                        <p class="mb-0">Richieste Writer</p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row my-5">
            <div class="col-12">
                <h2>Richieste Admin</h2>
            </div>
        </div>

        @if ($admin_requests->isEmpty())
            <p>Nessuna richiesta Admin.</p>
        @else
            <div class="table-responsive mb-5">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin_requests as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('admin.makeAdmin', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Rendi Admin
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <hr>

        <div class="row my-5">
            <div class="col-12">
                <h2>Richieste Revisor</h2>
            </div>
        </div>

        @if ($revisor_requests->isEmpty())
            <p>Nessuna richiesta Revisor.</p>
        @else
            <div class="table-responsive mb-5">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revisor_requests as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('admin.makeRevisor', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Rendi Revisor
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <hr>

        <div class="row my-5">
            <div class="col-12">
                <h2>Richieste Writer</h2>
            </div>
        </div>

        @if ($writer_requests->isEmpty())
            <p>Nessuna richiesta Writer.</p>
        @else
            <div class="table-responsive mb-5">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($writer_requests as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('admin.makeWriter', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Rendi Writer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-layout>
  