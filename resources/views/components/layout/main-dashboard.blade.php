<x-layout.main title="{{ $title }}" header-bg-color="light" footer-bg-color="light">
    <div class="offcanvas-wrap">
        <section class="split">
            <div class="container">
                <div class="row justify-content-between">
                    <aside class="col-lg-3 split-sidebar">
                        <nav class="sticky-top d-none d-lg-block py-3">
                            <ul class="nav nav-minimal flex-column" id="toc-nav">
                                @foreach (user_menu() as $userMenu)
                                    <li class="nav-item">
                                        <a class="nav-link fs-lg {{ Request::is($userMenu['path'] . '*') ? 'active' : ''}}" href="{{ url($userMenu['path']) }}">
                                            {{ $userMenu['name'] }}
                                        </a>
                                    </li>
                                @endforeach

                                <li class="nav-item">
                                    <a class="nav-link fs-lg text-red" href="#" onclick="return handleLogout(event)">
                                        Keluar
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </aside>

                    <div class="col-lg-9 split-content">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </section>
    </div>

    @isset($script)
        <x-slot:script>
            {{ $script }}
        </x-slot:script>
    @endisset
</x-layout.main>
