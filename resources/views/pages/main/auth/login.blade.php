<x-layouts.main title="Login">
    <div class="d-lg-flex position-relative h-100">
        <div class="d-flex align-items-center justify-content-center w-lg-50 h-100 px-4 px-lg-5 pt-5">
            <div class="w-100" style="max-width: 526px;">
                <h1>Masuk</h1>

                <p class="pb-3 mb-3 mb-lg-4">
                    Belum punya akun? <a href="#">Daftar disini</a>
                </p>

                <form action="{{ route('login.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ request('redirect', '/') }}">
                    
                    <div class="pb-3 mb-3">
                        <div class="position-relative">
                            <input class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" type="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                            
                            @error('email')
                                <div class="invalid-feedback ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" placeholder="Kata Sandi" required>

                        @error('password')
                            <div class="invalid-feedback ms-3">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                        <div class="form-check my-1">
                            <input class="form-check-input" type="checkbox" id="keep-signedin">
                            <label class="form-check-label ms-1" for="keep-signedin">Ingat saya</label>
                        </div>
                    </div>

                    <button class="btn btn-lg btn-primary w-100 mb-4" type="submit">Masuk</button>
                </form>
            </div>
        </div>

        {{-- Cover image --}}
        <div class="w-50 bg-size-cover bg-repeat-0 bg-position-center" id="bgLogin"></div>
    </div>

    <x-slot:style>
        <style>
            #bgLogin {
                background-image: url({{ main_asset('img/account/cover.jpg') }});
            }
        </style>
    </x-slot:style>
</x-layouts.main>
