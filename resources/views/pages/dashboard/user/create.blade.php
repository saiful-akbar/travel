<x-layouts.dashboard title="Tambah User">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.user') }}" color="dark" start-icon="bi-chevron-left">
            Kembali
        </x-button>
    </x-slot:header-action>

    @if ($errors->any())
        <x-alert variant="danger" class="mb-4">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <form action="{{ route('dashboard.user.store') }}" method="post" enctype="multipart/form-data">
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
                                <label for="foto"
                                    class="avatar avatar-xl avatar-circle avatar-uploader me-5 border-lg">
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
                                <input required type="text" name="nama_lengkap" id="nama_lengkap"
                                    placeholder="Masukan nama lengkap..." value="{{ old('nama_lengkap') }}"
                                    class="form-control form-control-light @error('nama_lengkap') is-invalid @enderror">

                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label form-label">
                                Email <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input required type="email" name="email" id="email"
                                    placeholder="Masukan nama lengkap..." value="{{ old('email') }}"
                                    class="form-control form-control-light @error('email') is-invalid @enderror">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
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
                                    <input required type="password" name="password" id="password"
                                        placeholder="Masukan password..." value="{{ old('password') }}"
                                        class="form-control form-control-light @error('password') is-invalid @enderror">

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
                                <div class="input-group input-group-sm-vertical  @error('role') is-invalid @enderror">
                                    <label class="form-control form-control-light @error('role') is-invalid @enderror"
                                        for="admin">
                                        <span class="form-check">
                                            <input type="radio" class="form-check-input" name="role" value="admin"
                                                id="admin" @checked(old('role') === 'admin') required>

                                            <span class="form-check-label">
                                                Admin
                                            </span>
                                        </span>
                                    </label>

                                    <label class="form-control form-control-light @error('role') is-invalid @enderror"
                                        for="member">
                                        <span class="form-check">
                                            <input type="radio" class="form-check-input" name="role" value="member"
                                                id="member" @checked(old('role') === 'member') required>

                                            <span class="form-check-label">
                                                Member
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label form-label">
                                Status <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div
                                    class="input-group input-group-sm-vertical  @error('status') is-invalid @enderror">
                                    <label
                                        class="form-control form-control-light @error('status') is-invalid @enderror"
                                        for="aktif">
                                        <span class="form-check">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="aktif" value="1" @checked(old('status') == '1') required>

                                            <span class="form-check-label">
                                                Aktif
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        class="form-control form-control-light @error('status') is-invalid @enderror"
                                        for="inactive">
                                        <span class="form-check">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="inactive" value="0" @checked(old('status') == '0') required>

                                            <span class="form-check-label">
                                                Tidak Aktif
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Jenis kelamin --}}
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label form-label">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div
                                    class="input-group input-group-sm-vertical  @error('jenis_kelamin') is-invalid @enderror">
                                    <label
                                        class="form-control form-control-light @error('jenis_kelamin') is-invalid @enderror"
                                        for="L">
                                        <span class="form-check">
                                            <input type="radio" class="form-check-input" name="jenis_kelamin"
                                                id="L" value="L" @checked(old('jenis_kelamin') === 'L') required>

                                            <span class="form-check-label">
                                                Laki - Laki
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        class="form-control form-control-light @error('jenis_kelamin') is-invalid @enderror"
                                        for="P">
                                        <span class="form-check">
                                            <input type="radio" class="form-check-input" name="jenis_kelamin"
                                                id="P" value="P" @checked(old('jenis_kelamin') === 'P') required>

                                            <span class="form-check-label">
                                                Perempuan
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Telepon --}}
                        <div class="row">
                            <label for="telepon" class="col-sm-3 col-form-label form-label">
                                No. Tlp
                            </label>

                            <div class="col-sm-9">
                                <input type="number" name="telepon" id="telepon" placeholder="Masukan no telp..."
                                    value="{{ old('telepon') }}"
                                    class="form-control form-control-light @error('telepon') is-invalid @enderror">

                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <x-button type="submit" color="success" start-icon="bi-save">
                            Simpan
                        </x-button>

                        <x-button type="reset" color="secondary" start-icon="bi-x-lg" class="ms-2">
                            Reset
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-slot:script>

        {{-- foto preview --}}
        <script>
            $('#foto').change(function(e) {
                if (e.target.files.length > 0) {
                    $('#photoPreview').attr('src', URL.createObjectURL(e.target.files[0]));
                }
            });
        </script>

        {{-- fungsi untuk meanmpilkan atau menyembunyikan password --}}
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
