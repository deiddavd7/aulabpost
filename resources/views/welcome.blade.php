@if (session('message'))
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="alert alert-success text-center">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    </div>
@endif

  