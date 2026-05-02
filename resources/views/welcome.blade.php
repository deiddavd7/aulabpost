<x-layout>
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

</x-layout>

