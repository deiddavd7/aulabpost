<x-layout>

    <header class="container-fluid py-5 bg-light">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-3">Dashboard Admin</h1>
                <p class="lead">Gestisci richieste, ruoli, tags e categorie</p>
            </div>
        </div>
    </header>

    @if (session('message'))
        <div class="container mt-4">
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        </div>
    @endif

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

        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Richieste ruoli</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <x-requests-table :roleRequests="$adminRequests" role="admin" />
            </div>

            <div class="col-12">
                <x-requests-table :roleRequests="$revisorRequests" role="revisor" />
            </div>

            <div class="col-12">
                <x-requests-table :roleRequests="$writerRequests" role="writer" />
            </div>
        </div>

    </section>

    <section class="container my-5">

        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Gestione contenuti</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <x-metainfo-table :items="$tags" type="tags" />
            </div>

            <div class="col-12">
                <x-metainfo-table :items="$categories" type="categories" />
            </div>
        </div>

    </section>
 
</x-layout>

