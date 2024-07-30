<div class="navbar-nav-wrap-secondary-content">
    <ul class="navbar-nav">
        <li class="nav-item">
            <div class="dropdown ">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation></button>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                    <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                        <i class="bi-moon-stars me-2"></i>
                        <span class="text-truncate" title="Auto (system default)">Auto</span>
                    </a>
                    <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                        <i class="bi-brightness-high me-2"></i>
                        <span class="text-truncate" title="Default (light mode)">Terang</span>
                    </a>
                    <a class="dropdown-item active" href="#" data-icon="bi-moon"data-value="dark">
                        <i class="bi-moon me-2"></i>
                        <span class="text-truncate" title="Dark">Gelap</span>
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            @auth
                <div class="dropdown">
                    <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                        <div class="avatar avatar-sm avatar-circle">
                            <img class="avatar-img" src="{{ avatar(user()?->foto) }}" alt="{{ user()?->nama_lengkap }}">
                            <span class="avatar-status avatar-sm-status avatar-status-{{ empty(user()) ? 'danger' : 'success' }}"></span>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                        <div class="dropdown-item-text">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm avatar-circle">
                                    <img class="avatar-img" src="{{ avatar(user()?->foto) }}" alt="Foto">
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">{{ user()->nama_lengkap }}</h5>
                                    <p class="card-text text-body">{{ user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#">
                            <i class="bi-person dropdown-item-icon"></i>
                            Profil & Akun
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" id="logout">
                            <i class="bi-box-arrow-right dropdown-item-icon"></i>
                            Log Out
                        </a>
                    </div>
                </div>
            @else
                <x-button size="sm" color="primary" type="link" href="{{ route('login', ['redirect' => url('/')]) }}">
                    Log In
                </x-button>
            @endauth
        </li>
    </ul>
</div>