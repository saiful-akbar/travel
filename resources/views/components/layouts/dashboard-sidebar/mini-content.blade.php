@props(['perusahaan'])

<div class="splitted-content-mini navbar-dark bg-dark h-100 py-3">
  <a class="navbar-brand d-flex justify-content-center" href="{{ route('dashboard.home') }}">
    @isset($perusahaan->logo)
      <img
        class="navbar-brand-logo-short"
        src="{{ storage($perusahaan->logo) }}"
        alt="{{ $perusahaan->nama }}"
        style="object-fit: contain; object-position: center;"
      >
    @else
      <img
        class="navbar-brand-logo-short"
        src="{{ asset('assets/dashboard/images/image_empty.jpg') }}"
        alt="{{ $perusahaan->logo ?? 'Logo' }}"
      >
    @endisset
  </a>

  <ul class="nav nav-compact-icon nav-compact-icon-circle">
    <li class="nav-item">
      <a class="nav-icon {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
        <i class="bi-house-door"></i>
      </a>
    </li>

    <li class="nav-item">
      <div class="dropdown dropright">
        <button
          type="button"
          class="btn btn-ghost-secondary btn-icon rounded-circle"
          id="selectThemeDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          data-bs-dropdown-animation></button>

        <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
          <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
            <i class="bi-moon-stars me-2"></i>

            <span class="text-truncate" title="Bawaan Sistem">
              Bawaan Sistem
            </span>
          </a>

          <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
            <i class="bi-brightness-high me-2"></i>
            <span class="text-truncate" title="Terang">Terang</span>
          </a>

          <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
            <i class="bi-moon me-2"></i>
            <span class="text-truncate" title="Gelap">Gelap</span>
          </a>
        </div>
      </div>
    </li>
  </ul>

  <ul class="nav nav-compact-icon nav-compact-icon-circle mt-auto">
    <li class="nav-item">
      <div class="dropdown dropupend">
        <a
          class="navbar-dropdown-account-wrapper"
          href="javascript:;"
          id="accountNavbarDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          data-bs-auto-close="outside"
          data-bs-dropdown-animation
        >
          <div class="avatar avatar-sm avatar-circle">
            <img class="avatar-img" src="{{ avatar(user()->foto) }}" alt="Image Description">
            <span class="avatar-status avatar-sm-status avatar-status-success"></span>
          </div>
        </a>

        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown">
          <div class="dropdown-item-text">
            <div class="d-flex align-items-center">
              <div class="avatar avatar-sm avatar-circle">
                <img class="avatar-img" src="{{ avatar(user()->foto) }}" alt="Foto">
              </div>

              <div class="flex-grow-1 ms-3">
                <h5 class="mb-0">{{ user()->nama_lengkap }}</h5>
                <p class="card-text text-body">{{ user()->email }}</p>
              </div>
            </div>
          </div>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="#">Profil</a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="#" id="logout">Log Out</a>
        </div>
      </div>
    </li>
  </ul>
</div>
