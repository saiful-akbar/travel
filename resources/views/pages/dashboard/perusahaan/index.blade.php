<x-layouts.dashboard title="Perusahaan">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="{{ route('dashboard.perusahaan.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    @isset($perusahaan?->logo)
                        <img
                            src="{{ storage($perusahaan?->logo) }}"
                            alt="Logo"
                            class="card-img-top"
                            id="logoPreview"
                            loading="lazy"
                            height="250"
                            style="object-fit: contain; object-position: center;"
                        >
                    @else
                        <img
                            src="{{ dashboard_asset('images/image_empty.jpg') }}"
                            alt="Logo"
                            class="card-img-top"
                            id="logoPreview"
                            loading="lazy"
                            height="250"
                            style="object-fit: cover; object-position: center;"
                        >
                    @endisset
    
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="logo" class="col-sm-4 col-form-label form-label">
                                Logo
                            </label>
    
                            <div class="col-sm-8">
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
                            <label for="nama" class="col-sm-4 col-form-label form-label">
                                Nama Perusahaan <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-sm-8">
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
                            <label for="email" class="col-sm-4 col-form-label form-label">
                                Email <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-sm-8">
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
                            <label for="telepon" class="col-sm-4 col-form-label form-label">
                                No. Telp <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-sm-8">
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
                            <label for="alamat" class="col-sm-4 col-form-label form-label">
                                Alamat <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-sm-8">
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
                        <x-button
                            type="submit"
                            color="success"
                            start-icon="bi-save"
                        >
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
                if (e.target.files.length > 0) {
                    $('#logoPreview').attr('src', URL.createObjectURL(e.target.files[0]));
                    $('#logoPreview').attr('style', 'object-fit: contain; object-position: center;');
                }
            });
        </script>
    </x-slot:script>
</x-layouts.dashboard>