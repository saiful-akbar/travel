<x-layout.dashboard title="Perusahaan">
    <form id="formPerusahaan" action="{{ route('dashboard.perusahaan.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <img src="{{ image($perusahaan?->logo) }}" alt="Logo" class="card-img-top p-3" id="logoPreview"
                        loading="lazy" height="250" style="object-fit: contain; object-position: center;">

                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="logo" class="col-sm-3 col-form-label form-label">
                                Logo
                            </label>

                            <div class="col-sm-9">
                                <input type="file" accept=".png,.jpg,.jpeg,.webp" placeholder="Upload logo"
                                    name="logo" id="logo"
                                    class="form-control form-control-light @error('logo') is-invalid @enderror">

                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="row
                                    mb-4">
                            <label for="nama" class="col-sm-3 col-form-label form-label">
                                Nama Perusahaan
                            </label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Masukan nama perusahaan..." name="nama"
                                    id="nama" value="{{ old('nama', $perusahaan?->nama) }}"
                                    class="form-control form-control-light @error('nama') is-invalid @enderror">

                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label form-label">
                                Email
                            </label>

                            <div class="col-sm-9">
                                <input type="email" placeholder="Masukan email..." name="email" id="email"
                                    value="{{ old('email', $perusahaan?->email) }}"
                                    class="form-control form-control-light @error('email') is-invalid @enderror">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Telepon --}}
                        <div class="row mb-4">
                            <label for="telepon" class="col-sm-3 col-form-label form-label">
                                No. Telp
                            </label>

                            <div class="col-sm-9">
                                <input type="number" min="0" placeholder="Masukan no telp..." name="telepon"
                                    id="telepon" value="{{ old('telepon', $perusahaan?->telepon) }}"
                                    class="form-control form-control-light @error('telepon') is-invalid @enderror">

                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="row">
                            <label for="alamat" class="col-sm-3 col-form-label form-label">
                                Alamat
                            </label>

                            <div class="col-sm-9">
                                <textarea rows="5" placeholder="Masukan alamat..." name="alamat" id="alamat"
                                    class="form-control form-control-light @error('alamat') is-invalid @enderror">{{ old('alamat', $perusahaan?->alamat) }}</textarea>

                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Visi --}}
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Visi & Misi</h4>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="visi" class="col-sm-3 col-form-label form-label">Visi</label>

                            <div class="col-sm-9">
                                <textarea name="visi" id="visi" rows="10" placeholder="Masukan visi perusahaan..."
                                    class="form-control form-control-light @error('visi') is-invalid @enderror">{{ old('visi', $perusahaan?->visi) }}</textarea>

                                @error('visi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label for="misi" class="col-sm-3 col-form-label form-label">Misi</label>

                            <div class="col-sm-9">
                                <textarea name="misi" id="misi" rows="10" placeholder="Masukan misi perusahaan..."
                                    class="form-control form-control-light @error('misi') is-invalid @enderror">{{ old('misi', $perusahaan?->misi) }}</textarea>

                                @error('misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profil --}}
        <div class="row justify-content-center mt-5 mb-10">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Profil</h4>
                    </div>

                    <div class="card-body">
                        <textarea name="profil" id="profil" rows="10" placeholder="Masukan profil perusahaan..."
                            class="form-control form-control-light @error('profil') is-invalid @enderror">{{ old('profil', $perusahaan?->profil) }}</textarea>

                        @error('profil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3 zi-999"
            style="max-width: 40rem;">
            <div class="card card-sm bg-dark border-dark mx-2">
                <div class="card-body">
                    <div class="d-flex justify-content-center justify-content-center">
                        <button type="reset" class="btn btn-ghost-light btn-sm me-2">
                            <i class="bi-x-lg me-1"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi-save me-1"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-slot:script>

        {{-- image preview --}}
        <script>
            $('#logo').change(function(e) {
                if (this.files[0]) {
                    App.imagePreview('#logoPreview', this.files[0]);
                }
            });
        </script>

        {{-- Reset image --}}
        <script>
            $('#formPerusahaan button[type=reset]').click(function(e) {
                App.imagePreview('#logoPreview', '{{ image($perusahaan?->logo) }}')
            });
        </script>

    </x-slot:script>
</x-layout.dashboard>
