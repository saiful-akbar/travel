<x-layouts.dashboard title="Tambah User">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.user') }}" color="dark" start-icon="bi-chevron-left">
            Kembali
        </x-button>
    </x-slot:header-action>

    <form action="{{ route('dashboard.user.store') }}" method="post" enctype="multipart/form-data" id="formCreateUser">
        @csrf

        <div class="row justify-content-lg-center">
            <div class="col-lg-10">
                <div class="card card-lg">
                    <div class="card-header">
                        <h4 class="card-header-title">Form tambah user</h4>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label form-label">Foto</label>

                            <div class="col-sm-9">
                                <label for="foto" class="avatar avatar-xl avatar-circle avatar-uploader me-5 border-lg">
                                    <img src="{{ avatar() }}" alt="foto" class="avatar-img" id="photoPreview">
                                    <input type="file" id="foto" name="foto" class="d-none">
                                </label>

                                @error('foto')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama lengkap --}}
                        <div class="row mb-4">
                            <label for="nama_lengkap" class="col-sm-3 col-form-label form-label">
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
                                        'is-invalid' => $errors->has('nama_lengkap'),
                                    ])
                                >

                                @error('nama_lengkap')
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
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    placeholder="Masukan alamat email..."
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('email'),
                                    ])
                                >

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="row mb-4">
                            <label for="password" class="col-sm-3 col-form-label form-label">
                                Password <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div class="input-group @error('password') is-invalid @enderror">
                                    <input
                                        required
                                        type="password"
                                        name="password"
                                        id="password"
                                        value="{{ old('password') }}"
                                        placeholder="Masukan password..."
                                        @class([
                                            'form-control',
                                            'form-control-light',
                                            'is-invalid' => $errors->has('password'),
                                        ])
                                    >

                                    <button id="togglePassword" type="button" class="input-group-text">
                                        <i id="togglePasswordIcon" class="bi-eye-slash"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label form-label">
                                Role <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div class="input-group input-group-sm-vertical @error('role') is-invalid @enderror">
                                    <label
                                        for="admin"
                                        @class([
                                            'form-control',
                                            'form-control-light',
                                            'is-invalid' => $errors->has('role'),
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                required
                                                type="radio"
                                                name="role"
                                                id="admin"
                                                value="admin"
                                                class="form-check-input"
                                                @checked(old('role') === 'admin')
                                            >

                                            <span class="form-check-label">
                                                Admin
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        for="member"
                                        @class([
                                            'form-control',
                                            'form-control-light',
                                            'is-invalid' => $errors->has('role'),
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                required
                                                type="radio"
                                                name="role"
                                                id="member"
                                                value="member"
                                                class="form-check-input"
                                                @checked(old('role') === 'member')
                                            >

                                            <span class="form-check-label">
                                                Member
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label form-label">
                                Status <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div class="input-group input-group-sm-vertical  @error('status') is-invalid @enderror">
                                    <label
                                        for="active"
                                        @class([
                                            "form-control",
                                            "form-control-light",
                                            "is-invalid" => $errors->has('status')
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                required
                                                type="radio"
                                                name="status"
                                                id="active"
                                                value="1"
                                                class="form-check-input"
                                                @checked(old('status') == '1')
                                            >

                                            <span class="form-check-label">
                                                Aktif
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        for="inactive"
                                        @class([
                                            "form-control",
                                            "form-control-light",
                                            "is-invalid" => $errors->has('status')
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                required
                                                type="radio"
                                                name="status"
                                                id="inactive"
                                                value="0"
                                                class="form-check-input"
                                                @checked(old('status') == '0')
                                            >

                                            <span class="form-check-label">
                                                Tidak Aktif
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Jenis kelamin --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label form-label">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div class="input-group input-group-sm-vertical @error('jenis_kelamin') is-invalid @enderror">
                                    <label
                                        for="L"
                                        @class([
                                            "form-control",
                                            "form-control-light",
                                            "is-invalid" => $errors->has('jenis_kelamin')
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                required
                                                type="radio"
                                                name="jenis_kelamin"
                                                id="L"
                                                value="L"
                                                class="form-check-input"
                                                @checked(old('jenis_kelamin') === 'L')
                                            >

                                            <span class="form-check-label">
                                                Laki - Laki
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        for="P"
                                        @class([
                                            "form-control",
                                            "form-control-light",
                                            "is-invalid" => $errors->has('jenis_kelamin')
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

                        {{-- Telepon --}}
                        <div class="row">
                            <label for="telepon" class="col-sm-3 col-form-label form-label">
                                No. Tlp
                            </label>

                            <div class="col-sm-9">
                                <input
                                    type="number"
                                    name="telepon"
                                    id="telepon"
                                    value="{{ old('telepon') }}"
                                    placeholder="Masukan no telp..."
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('telepon'),
                                    ])
                                >

                                @error('telepon')
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
                        
                        <x-button
                            type="reset"
                            color="secondary"
                            start-icon="bi-x-lg"
                            class="ms-2"
                        >
                            Reset
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-slot:script>

        {{-- image preview --}}
        <script>
            $('#foto').change(function(e) {
                if (e.target.files.length > 0) {
                    $('#photoPreview').attr('src', URL.createObjectURL(e.target.files[0]));
                }
            });
        </script>

        {{-- reset foto --}}
        <script>
            $('#formCreateUser button[type=reset]').click(function (e) {
                $('#photoPreview').attr('src', '{{ avatar() }}');
            });
        </script>

        {{-- Toggle password --}}
        <script>
            $('#togglePassword').click(function(e) {
                e.preventDefault();

                const type = $('#password').attr('type');

                if (type === 'text') {
                    $('#password').attr('type', 'password');
                    $('#togglePasswordIcon').removeClass('bi-eye');
                    $('#togglePasswordIcon').addClass('bi-eye-slash');
                } else {
                    $('#password').attr('type', 'text');
                    $('#togglePasswordIcon').removeClass('bi-eye-slash');
                    $('#togglePasswordIcon').addClass('bi-eye');
                }
            });
        </script>

    </x-slot:script>
</x-layouts.dashboard>
