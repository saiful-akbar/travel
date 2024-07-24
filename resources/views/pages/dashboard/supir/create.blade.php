<x-layouts.dashboard title="Tambah Supir">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.supir') }}"
            color="dark"
            start-icon="bi-chevron-left"
        >
            Kembali
        </x-button>
    </x-slot:header-action>

    {{-- Form --}}
    <form action="{{ route('dashboard.supir.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Form Tambah Supir</h4>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label form-label">
                                Foto
                            </label>

                            <div class="col-sm-9">
                                <label for="foto" class="avatar avatar-xl avatar-circle avatar-uploader me-3 border-lg">
                                    <img src="{{ avatar() }}" alt="foto" class="avatar-img" id="photoPreview">
                                    <input type="file" id="foto" name="foto" class="d-none">
                                </label>

                                @error('foto')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                        </div>

                        {{-- Nama lengkap --}}
                        <div class="row mb-4">
                            <label for="" class="col-sm-3 col-form-label form-label">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="text"
                                    placeholder="Masukan nama lengkap..."
                                    name="nama_lengkap"
                                    id="nama_lengkap"
                                    value="{{ old('nama_lengkap') }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('nama_lengkap')
                                    ])
                                >

                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Jenis kelamin --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label form-label">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div
                                    @class([
                                        "input-group",
                                        "input-group-sm-vertical",
                                        "is-invalid" => $errors->has('jenis_kelamin')
                                    ])
                                >
                                    <label
                                        for="L"
                                        @class([
                                            'form-control',
                                            'form-control-light',
                                            'is-invalid' => $errors->has('jenis_kelamin'),
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                required
                                                type="radio"
                                                name="jenis_kelamin"
                                                id="L"
                                                value="L"
                                                @checked(old('jenis_kelamin') === 'L')
                                                class="form-check-input"
                                            >
        
                                            <span class="form-check-label">
                                                Laki-Laki
                                            </span>
                                        </span>
                                    </label>
                                    
                                    <label
                                        for="P"
                                        @class([
                                            'form-control',
                                            'form-control-light',
                                            'is-invalid' => $errors->has('jenis_kelamin'),
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                required
                                                type="radio"
                                                name="jenis_kelamin"
                                                id="P"
                                                value="P"
                                                class="form-check-input"
                                                @checked(old('jenis_kelamin') === 'P')
                                            >
                                            
                                            <span class="form-check-label">
                                                Perempuan
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="row mb-4">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label form-label">
                                Tanggal Lahir
                            </label>

                            <div class="col-sm-9">
                                <input
                                    type="date"
                                    name="tanggal_lahir"
                                    id="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('jenis_kelamin'),
                                    ])
                                >

                                @error('jenis_kelamin')
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
                            class="me-2"
                        >
                            Simpan
                        </x-button>

                        <x-button
                            type="reset"
                            color="secondary"
                            start-icon="bi-x-lg"
                        >
                            Reset
                        </x-button>
                    </div>
                </div>                
            </div>
        </div>
    </form>

    <x-slot:script>
        <script>
            $('#foto').change(function (e) {
                if (e.target.files.length > 0) {
                    $('#photoPreview').attr('src', URL.createObjectURL(e.target.files[0]));
                }
            });
        </script>
    </x-slot:script>
</x-layouts.dashboard>