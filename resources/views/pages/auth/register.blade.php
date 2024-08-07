<x-layout.main title="Register" header-bg-color="dark" footer-bg-color="dark">
    <section class="bg-black overflow-hidden">
        <div class="py-15 py-xl-20 d-flex flex-column container level-3 min-vh-100">
            <div class="row align-items-center justify-content-center my-auto">
                <div class="col-md-10 col-lg-8">
                    <div class="card">
                        <div class="card-header bg-white text-center pb-0">
                            <h5 class="fs-4 mb-1">Register</h5>
                        </div>

                        <div class="card-body bg-white">
                            <form
                                id="formRegister"
                                method="post"
                                action="{{ route('register.store', ['redirect' => request('redirect', route('main.home'))]) }}"
                            >
                                @csrf

                                {{-- field nama lengkap dan jenis kelamin --}}
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-2">
                                        <label for="nama_lengkap" class="form-label">
                                            Nama Lengkap <span class="text-danger">*</span>
                                        </label>
    
                                        <input
                                            type="text"
                                            name="nama_lengkap"
                                            id="nama_lengkap"
                                            value="{{ old('nama_lengkap') }}"
                                            placeholder="Nama lengkap..."
                                            @class([
                                                'form-control',
                                                'is-invalid' => $errors->has('nama_lengkap')
                                            ])
                                        >
    
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <label for="jenis_kelamin" class="form-label">
                                            Jenis Kelamin <span class="text-danger">*</span>
                                        </label>

                                        <select
                                            name="jenis_kelamin"
                                            id="jenis_kelamin"
                                            @class([
                                                'form-select',
                                                'is-invalid' => $errors->has('jenis_kelamin')
                                            ])
                                        >
                                            <option value="" selected disabled>Jenis Kelamin...</option>
                                            <option value="Laki-Laki" @selected(old('jenis_kelamin') == 'Laki-Laki')>Laki-Laki</option>
                                            <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                                        </select>
    
    
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- field nomer telepon dan email --}}
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-2">
                                        <label for="telepon" class="form-label">No. Telepon</label>

                                        <input
                                            type="tel"
                                            name="telepon"
                                            id="telepon"
                                            value="{{ old('telepon') }}"
                                            placeholder="No. telepon..."
                                            @class([
                                                'form-control',
                                                'is-invalid' => $errors->has('telepon')
                                            ])
                                        >
    
                                        @error('telepon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <label for="email" class="form-label">
                                            Email <span class="text-danger">*</span>
                                        </label>
    
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            value="{{ old('email') }}"
                                            placeholder="Email..."
                                            @class([
                                                'form-control',
                                                'is-invalid' => $errors->has('email')
                                            ])
                                        >
    
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- field password --}}
                                <div class="row">
                                    <div class="col-12">
                                        <label for="password" class="form-label">
                                            Password <span class="text-danger">*</span>
                                        </label>
    
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            placeholder="Password..."
                                            @class([
                                                'form-control',
                                                'is-invalid' => $errors->has('password')
                                            ])
                                        >
    
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
