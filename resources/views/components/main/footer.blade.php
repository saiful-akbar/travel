<footer class="py-15 py-xl-20 border-top {{ $bgColor }}">
    <div class="container">
        <div class="row justify-content-between g-5 mb-5 mb-lg-10">
            <div class="col-lg-4">
                <a href="{{ route('main.home') }}" class="navbar-brand text-reset">
                    <h1 class="fs-4 fw-bold font-monospace" style="font-weight: 900">
                        {{ perusahaan()?->nama }}
                    </h1>
                </a>
            </div>

            <div class="col-lg-7">
                <div class="row g-3 g-xl-5">
                    <div class="col-6">
                        <span class="eyebrow text-muted mb-1 d-flex">Menu</span>
                        <ul class="list-unstyled">
                            @foreach (main_menu() as $menu)
                                <li class="{{ $loop->iteration < $loop->count ? 'mb-1' : '' }}">
                                    <a href="{{ url($menu['path']) }}" class="text-reset text-primary-hover">
                                        {{ $menu['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-6">
                        <span class="eyebrow text-muted mb-1 d-flex">Ikuti Kami</span>

                        <ul class="list-unstyled">
                            @foreach (media_sosial() as $mediaSosial)
                                <li class="{{ $loop->iteration < $loop->count ? 'mb-1' : '' }}">
                                    <a href="{{ $mediaSosial?->url }}" target="_blank" rel="noreferrer"
                                        class="text-reset text-primary-hover">
                                        <i class="{{ $mediaSosial->icon }} me-1"></i>
                                        <span>{{ $mediaSosial?->nama }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-center justify-content-between g-2 g-lg-5">
            <div class="col-md-6 col-lg-4 order-md-2 text-md-end">
                <span class="small text-muted">{{ perusahaan()?->alamat }}</span>
            </div>

            <div class="col-md-6 col-lg-3 order-md-1">
                <p class="small text-muted">Copyrights © 2024 - {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>
