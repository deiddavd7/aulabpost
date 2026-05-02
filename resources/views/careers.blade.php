<x-layout>

    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7">

                <h1 class="text-center mb-4">Lavora con noi</h1>

                <form action="{{ route('careers.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="role" class="form-label">Per quale ruolo vuoi candidarti?</label>
                        <select name="role" id="role" class="form-select">
                            <option value="">Scegli un ruolo</option>

                            @if (!Auth::user()->is_admin)
                                <option value="admin">Admin</option>
                            @endif

                            @if (!Auth::user()->is_revisor)
                                <option value="revisor">Revisor</option>
                            @endif

                            @if (!Auth::user()->is_writer)
                                <option value="writer">Writer</option>
                            @endif
                        </select>

                        @error('role')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">La tua email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control" 
                            value="{{ Auth::user()->email }}"
                            readonly
                        >

                        @error('email')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Messaggio di presentazione</label>
                        <textarea 
                            name="message" 
                            id="message" 
                            cols="30" 
                            rows="8" 
                            class="form-control"
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Invia candidatura
                    </button>
                </form>

            </div>
        </div>
    </section>

</x-layout>

