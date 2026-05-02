<x-layout>

    <section class="container py-5">

        @if (session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endif

        <h1 class="text-center mb-5">Dashboard Admin</h1>

        <x-requests-table 
            role="admin" 
            :roleRequests="$adminRequests" 
        />

        <x-requests-table 
            role="revisor" 
            :roleRequests="$revisorRequests" 
        />

        <x-requests-table 
            role="writer" 
            :roleRequests="$writerRequests" 
        />

    </section>

</x-layout>

