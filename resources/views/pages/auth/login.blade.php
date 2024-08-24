<x-layout.main title="Login" header-bg-color="dark" footer-bg-color="dark">
    <section class="bg-black overflow-hidden">
        <div class="py-15 py-xl-20 d-flex flex-column container level-3 min-vh-100">
            <div class="row align-items-center justify-content-center my-auto">
                <div class="col-md-10 col-lg-8 col-xl-5">
                    <div class="card">
                        <div class="card-header bg-white text-center pb-0">
                            <h5 class="fs-4 mb-1">Masuk</h5>
                        </div>

                        <div class="card-body bg-white">
                            <form
                                action="{{ route('login.store', ['redirect' => request('redirect', route('main.home'))]) }}"
                                method="post" id="formLogin">
                                @csrf

                                <div class="mb-3">
                                    <div class="form-floating @error('email') is-invalid @enderror">
                                        <input required type="email" name="email" id="email"
                                            placeholder="Alamat Email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror">

                                        <label for="email">Email</label>
                                    </div>

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-floating @error('password') is-invalid @enderror">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password">

                                        <label for="password">Password</label>
                                    </div>

                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="remember"
                                            id="remember">

                                        <label class="form-check-label small text-secondary" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid mb-2">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        Masuk
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-opaque-black inverted text-center">
                            <p class="text-secondary">
                                Belum punya akun? <a class="underline"
                                    href="{{ route('register', ['redirect' => request('redirect', route('main.home'))]) }}">Daftar
                                    disini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <figure class="bg-overlay" style="background-image: url('{{ main_asset('images/bg-4.jpg') }}')"></figure>
    </section>

    <x-slot:script>
        <script>
            $('#formLogin').submit(function(e) {
                $('#preloader').fadeIn();
            });
        </script>
    </x-slot:script>
</x-layout.main>
