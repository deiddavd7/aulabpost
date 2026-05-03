<x-layout>
    <div class="container my-5">

        <div class="row">
            <div class="col-12 text-center">
                <h1>Lavora con noi</h1>
                <p class="lead">Richiedi un ruolo nella piattaforma The Aulab Post.</p>
            </div>
        </div>

        @auth
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-md-6">
                    <form action="{{ route('careers.submit') }}" method="POST" class="card shadow p-4">
                        @csrf

                        <div class="mb-3">
                            <label for="role" class="form-label">Scegli il ruolo che vuoi richiedere</label>
                            <select name="role" id="role" class="form-select">
                                <option value="">Seleziona un ruolo</option>
                                <option value="writer">Writer</option>
                                <option value="revisor">Revisor</option>
                                <option value="admin">Admin</option>
                            </select>

                            @error('role')
                                <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Invia richiesta
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-md-8 text-center">
                    <h3>Devi effettuare il login per richiedere un ruolo.</h3>
                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Accedi</a>
                </div>
            </div>
        @endauth

    </div>
</x-layout>

