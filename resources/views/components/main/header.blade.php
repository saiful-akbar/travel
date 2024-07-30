<header id="header" class="navbar navbar-expand-lg navbar-bordered bg-white  ">
    <div class="container">
        <nav class="js-mega-menu navbar-nav-wrap">
            <a class="navbar-brand" href="{{ route('main.home') }}" aria-label="{{ perusahaan()?->nama }}">
                <img class="navbar-brand-logo" src="{{ image(perusahaan()?->logo) }}" alt="{{ perusahaan()?->nama }}" data-hs-theme-appearance="default" style="min-width: 40px; width: 40px;">
                <img class="navbar-brand-logo" src="{{ image(perusahaan()?->logo) }}" alt="{{ perusahaan()?->nama }}" data-hs-theme-appearance="dark" style="min-width: 40px; width: 40px;">
            </a>

            <x-main.header-secondary-content></x-main.header-secondary-content>

            {{-- Button toggler --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContainerNavDropdown" aria-controls="navbarContainerNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-default"><i class="bi-list"></i></span>
                <span class="navbar-toggler-toggled"><i class="bi-x"></i></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="navbarContainerNavDropdown">
                <ul class="navbar-nav justify-content-lg-center">
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-bold {{ Request::is('/') ? 'active' : '' }}" href="{{ route('main.home') }}">
                            <span>Home</span>
                        </a>
                    </li>
                    
                    @foreach ($menus as $menu)
                        <li class="nav-item">
                            <a class="nav-link fs-5 fw-bold {{ Request::is("{$menu['path']}*") ? 'active' : '' }}" href="{{ url($menu['path']) }}">
                                <span>{{ $menu['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</header>