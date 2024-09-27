<x-layout.main title="Profil">
    <section class="py-20">
        <div class="container mt-10">
            @if (session('alert'))
                <div class="mb-10 alert alert-{{ session('alert')['variant'] }}">
                    {{ session('alert')['message'] }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-10">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-5 justify-content-center justify-content-lg-between">
                <div class="col-lg-6 position-relative">
                    <div class="row g-1">
                        <div class="col-md-10 order-md-2">
                            <img src="{{ photo(user()->foto) }}" alt="foto" width="100%" height="400"
                                style="object-fit: contain; object-position: initial;" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h1 class="mb-5">Profil</h1>

                    {{-- Update profil --}}
                    <section class="border-top py-5">
                        <form action="{{ route('main.profil.update') }}" method="post" id="formEditProfile" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="row">

                                {{-- form Foto --}}
                                <div class="col-12 mb-3">
                                    <label for="foto" class="form-label">Unggah Foto</label>
    
                                    <input type="file" name="foto" id="foto" accept=".jpg,.jpeg,.png,.webp"
                                        class="form-control @error('foto') is-invalid @enderror">
    
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- form nama lengkap --}}
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="nama_lengkap" class="form-label">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
    
                                    <input required type="text" name="nama_lengkap"
                                        id="nama_lengkap" placeholder="Masukan nama lengkap..."
                                        value="{{ old('nama_lengkap', user()->nama_lengkap) }}"
                                        class="form-control @error('nama_lengkap') is-invalid @enderror">
    
                                    @error('nama_lengkap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Form jenis kelamin --}}
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="jenis_kelamin" class="form-label">
                                        Jenis Kelamin <span class="text-danger">*</span>
                                    </label>

                                    <select required name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih jenis kelamin...</option>
                                        <option value="L" @selected(old('jenis_kelamin', user()->jenis_kelamin) == 'L')>Laki-Laki</option>
                                        <option value="P" @selected(old('jenis_kelamin', user()->jenis_kelamin) == 'P')>Perempuan</option>
                                    </select>

                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- email --}}
                                <div class="col-12 mb-3">
                                    <label for="email" class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>

                                    <input type="email" name="email" id="email"
                                        placeholder="Masukan email..." value="{{ old('email', user()->email) }}"
                                        class="form-control @error('email') is-invalid @enderror" required>

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- telepon --}}
                                <div class="col-12 mb-3">
                                    <label for="telepon" class="form-label">
                                        Telepon
                                    </label>

                                    <input type="number" name="telepon" id="telepon" inputmode="number"
                                        placeholder="Masukan nomer telepon..." value="{{ old('telepon', user()->telepon) }}"
                                        class="form-control @error('telepon') is-invalid @enderror">

                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            Perbarui Profil
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </section>

                    {{-- Update password --}}
                    <section class="border-top py-5">
                        <form action="{{ route('main.profil.updatePassword') }}" method="post" id="formEditPassword">
                            @csrf
                            @method('patch')

                            <h3 class="fs-4 mb-5">Ubah Password</h3>
                            
                            <div class="card border">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="password_lama" class="form-label">
                                                Password lama <span class="text-danger">*</span>
                                            </label>
            
                                            <input type="password" name="password_lama" id="password_lama"
                                                class="form-control @error('password_lama') is-invalid @enderror"
                                                placeholder="Masukan password lama anda..." required>
            
                                            @error('password_lama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
        
                                        <div class="col-12 mb-3">
                                            <label for="password_baru" class="form-label">
                                                Password baru <span class="text-danger">*</span>
                                            </label>
            
                                            <input type="password" name="password_baru" id="password_baru"
                                                class="form-control @error('password_baru') is-invalid @enderror"
                                                placeholder="Masukan password baru anda..." required>
            
                                            @error('password_baru')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
        
                                        <div class="col-12 mb-3">
                                            <label for="password_konfirmasi" class="form-label">
                                                Konfirmasi password baru <span class="text-danger">*</span>
                                            </label>
            
                                            <input type="password" name="password_konfirmasi" id="password_konfirmasi"
                                                class="form-control @error('password_konfirmasi') is-invalid @enderror"
                                                placeholder="Ketik ulang password baru anda..." required>
            
                                            @error('password_konfirmasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">
                                                    Perbarui Password
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </section>
</x-layout.main>
