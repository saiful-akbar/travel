<x-layout.main title="Register" header-bg-color="dark" footer-bg-color="dark">
    <section class="bg-black overflow-hidden">
        <div class="py-15 py-xl-20 d-flex flex-column container level-3 min-vh-100">
            <div class="row align-items-center justify-content-center my-auto">
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="card">
                        <div class="card-header bg-white text-center pb-0">
                            <h5 class="fs-4 mb-1">Register</h5>
                        </div>

                        <div class="card-body bg-white">
                            <form id="formRegister"
                                action="{{ route('register.store', ['redirect' => request('redirect', route('main.home'))]) }}"
                                method="post">
                                @csrf

                                {{-- field nama lengkap --}}
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama_lengkap" id="nama_lengkap"
                                        value="{{ old('nama_lengkap') }}" placeholder="Masukan nama lengkap..."
                                        class="form-control @error('nama_lengkap') is-invalid @enderror">

                                    <label for="nama_lengkap">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>

                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- field jenis kelamin --}}
                                <div class="form-floating mb-3">
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih Jenis Kelamin...</option>
                                        <option value="Laki-Laki" @selected(old('jenis_kelamin') == 'Laki-Laki')>Laki-Laki</option>
                                        <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                                    </select>

                                    <label for="jenis_kelamin">
                                        Jenis Kelamin <span class="text-danger">*</span>
                                    </label>

                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- field nomer telepon --}}
                                <div class="form-floating mb-3">
                                    <input type="tel" name="telepon" id="telepon" value="{{ old('telepon') }}"
                                        placeholder="Masukan no. telp..."
                                        class="form-control @error('telepon') is-invalid @enderror">

                                    <label for="telepon">Telepon</label>

                                    @error('telepon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- field email --}}
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        placeholder="Masukan email..."
                                        class="form-control @error('email') is-invalid @enderror">

                                    <label for="email">
                                        Email <span class="text-danger">*</span>
                                    </label>

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- field password --}}
                                <div class="form-floating">
                                    <input type="password" name="password" id="password"
                                        placeholder="Masukan password..."
                                        class="form-control @error('password') is-invalid @enderror">

                                    <label for="password">
                                        Password <span class="text-danger">*</span>
                                    </label>

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-opaque-black inverted text-center">
                            <p class="text-secondary">
                                Sudah punya akun? <a href="{{ url('/login') }}" class="underline">Login disini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <figure class="bg-overlay" style="background-image: url('{{ main_asset('images/bg-1.jpg') }}')"></figure>
    </section>
</x-layout.main>
