@props(['bgColor' => 'dark'])

<nav id="mainNav" @class([
    'navbar',
    'navbar-expand-lg',
    'navbar-sticky',
    'navbar-dark' => $bgColor === 'dark',
    'navbar-light' => $bgColor === 'light' || $bgColor === 'white',
    'border-bottom' => $bgColor === 'light' || $bgColor === 'white',
    'bg-light' => $bgColor === 'light',
])>
    <div class="container">
        <a href="{{ route('main.home') }}" class="navbar-brand">
            <h1 class="fs-5 font-monospace" style="font-weight: 900">
                {{ perusahaan()?->nama }}
            </h1>
        </a>

        {{-- desktop user menu --}}
        <ul class="navbar-nav navbar-nav-secondary order-lg-3">
            @auth
                <li class="nav-item d-lg-none">
                    <a class="nav-link nav-icon" href="#" role="button" data-bs-toggle="collapse"
                        data-bs-target="#userNav" aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </a>
                </li>

                <li class="nav-item dropdown dropdown-hover d-none d-lg-block">
                    <a class="nav-link nav-icon" role="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach (user_menu() as $userMenu)
                            <li>
                                <a class="dropdown-item" href="{{ url($userMenu['path']) }}">
                                    {{ $userMenu['name'] }}
                                </a>
                            </li>
                        @endforeach

                        <li>
                            <a class="dropdown-item text-red" href="#" onclick="return handleLogout(event)">
                                Keluar
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item d-block">
                    <a href="{{ route('login', ['redirect' => url()->full()]) }}" @class([
                        'rounded-pill',
                        'btn',
                        'btn-sm',
                        'btn-outline-white' => $bgColor === 'dark',
                        'btn-outline-dark' => $bgColor === 'light',
                        'btn-outline-dark' => $bgColor === 'white',
                    ])>
                        Masuk
                    </a>
                </li>
            @endauth

            <li class="nav-item d-lg-none">
                <a class="nav-link nav-icon" data-bs-toggle="offcanvas" href="#offcanvasNav" role="button"
                    aria-controls="offcanvasNav">
                    <span class="bi bi-list"></span>
                </a>
            </li>
        </ul>

        {{-- mobile user menu --}}
        @auth
            <div class="collapse account-collapse" id="userNav" data-bs-parent="#mainNav">
                <ul class="navbar-nav">
                    @foreach (user_menu() as $userMenu)
                        <li class="nav-item">
                            <a class="nav-link " href="{{ url($userMenu['path']) }}">
                                {{ $userMenu['name'] }}
                            </a>
                        </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link text-red" href="#" onclick="return handleLogout(event)">
                            Keluar
                        </a>
                    </li>
                </ul>
            </div>
        @endauth

        {{-- primary menu --}}
        <div class="collapse navbar-collapse" id="navbar" data-bs-parent="#mainNav">
            <ul class="navbar-nav">
                @foreach (main_menu() as $menu)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url($menu['path']) }}">
                            {{ $menu['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
