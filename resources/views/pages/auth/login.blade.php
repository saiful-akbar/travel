<x-layout.auth title="Login">
    <div class="card card-lg shadow">
        <div class="card-body">
            <form
                id="formLogin"
                method="post"
                action="{{ route('login.store', ['redirect' => request('redirect', '/')]) }}"
            >
                @csrf

                <div class="text-center">
                    <div class="mb-5">
                        <h1 class="display-5">Log In</h1>

                        <p>Belum punya akun? <a class="link" href="{{ url('/registrasi') }}">registrasi disini</a></p>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="email">Email</label>

                    <input
                        required
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Masukan email..."
                        value="{{ old('email') }}"
                        @class([
                            'form-control',
                            'form-control-lg',
                            'form-control-light',
                            'is-invalid' => $errors->has('email'),
                        ])
                    >

                    @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>

                    <div class="input-group input-group-merge @error('password') is-invalid @enderror">
                        <input
                            required
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Masukan password..."
                            @class([
                                'form-control',
                                'form-control-lg',
                                'form-control-light',
                                'is-invalid' => $errors->has('password'),
                            ])
                        >

                        <a id="togglePassword" class="input-group-append input-group-text" href="javascript:;">
                            <i id="togglePasswordIcon" class="bi-eye-slash"></i>
                        </a>
                    </div>

                    @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" value="1" id="remember" name="remember" class="form-check-input form-check-light">
                    <label class="form-check-label" for="remember">Remeber me</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Log In</button>
                </div>
            </form>
        </div>
    </div>

    <x-slot:script>
        <script>
            $('#togglePassword').click(function (e) { 
                e.preventDefault();
                
                const icon = $('#togglePasswordIcon');
                const password = $('#password')
                const currentType = password.attr('type');

                if (currentType === 'password') {
                    password.attr('type', 'text');
                    icon.removeClass('bi-eye-slash');
                    icon.addClass('bi-eye');
                } else {
                    password.attr('type', 'password');
                    icon.removeClass('bi-eye');
                    icon.addClass('bi-eye-slash');
                }
            });
        </script>
    </x-slot:script>
</x-layout.auth>
