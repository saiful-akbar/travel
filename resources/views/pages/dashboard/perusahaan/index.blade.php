<x-layout.dashboard title="Perusahaan">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="{{ route('dashboard.perusahaan.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <img
                        src="{{ image($perusahaan?->logo) }}"
                        alt="Logo"
                        class="card-img-top"
                        id="logoPreview"
                        loading="lazy"
                        height="250"
                        style="object-fit: cover; object-position: center;"
                    >
    
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="logo" class="col-sm-3 col-form-label form-label">
                                Logo
                            </label>
    
                            <div class="col-sm-9">
                                <input
                                    type="file"
                                    accept=".png,.jpg,.jpeg,.webp"
                                    placeholder="Upload logo"
                                    name="logo"
                                    id="logo"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('logo')
                                    ])
                                >

                                @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="row mb-4">
                            <label for="nama" class="col-sm-3 col-form-label form-label">
                                Nama Perusahaan <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-sm-9">
                                <input
                                    required
                                    type="text"
                                    placeholder="Masukan nama perusahaan..."
                                    name="nama"
                                    id="nama"
                                    value="{{ old('nama', $perusahaan?->nama) }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('nama')
                                    ])
                                >

                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label form-label">
                                Email <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-sm-9">
                                <input
                                    required
                                    type="email"
                                    placeholder="Masukan email..."
                                    name="email"
                                    id="email"
                                    value="{{ old('email', $perusahaan?->email) }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
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

                        {{-- Telepon --}}
                        <div class="row mb-4">
                            <label for="telepon" class="col-sm-3 col-form-label form-label">
                                No. Telp <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-sm-9">
                                <input
                                    required
                                    type="number"
                                    min="0"
                                    placeholder="Masukan no telp..."
                                    name="telepon"
                                    id="telepon"
                                    value="{{ old('telepon', $perusahaan?->telepon) }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('telepon')
                                    ])
                                >

                                @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="row">
                            <label for="alamat" class="col-sm-3 col-form-label form-label">
                                Alamat <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-sm-9">
                                <textarea
                                    required
                                    rows="5"
                                    placeholder="Masukan alamat..."
                                    name="alamat"
                                    id="alamat"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('alamat')
                                    ])
                                >{{ old('alamat', $perusahaan?->alamat) }}</textarea>

                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <x-button type="submit" start-icon="bi-save">
                            Simpan
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-slot:script>
        <script>
            $('#logo').change(function (e) { 
                if (this.files[0]) {
                    App.imagePreview('#logoPreview', this.files[0]);
                }
            });
        </script>
    </x-slot:script>
</x-layout.dashboard>