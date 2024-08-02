<x-layout.main title="Home" bg-color="white" header-bg-color="dark" footer-bg-color="dark">
    <div class="offcanvas-wrap">

        {{-- Header --}}
        <section class="bg-black inverted overflow-hidden">
            <div class="container py-20 d-flex flex-column min-vh-100 foreground">
                <div class="row my-auto justify-content-center">
                    <div class="col-lg-6 text-center" data-center-center="transform: translateY(0%);"
                        data-top-bottom="transform: translateY(10%);">
                        <span class="badge bg-opaque-red rounded-pill text-red mb-4">
                            {{ perusahaan()?->nama }} v1.0.0
                        </span>

                        <h1 class="display-1 text-shadow">Perjalanan Terbaik Dimulai di Sini</h1>
                    </div>
                </div>
            </div>

            <figure class="background background-gradient-vertical" data-aos="zoom-out" data-aos-delay="400">
                <img class="w-40 shadow position-absolute top-10 end-70" src="{{ main_asset('images/home-1.jpg') }}"
                    alt="" data-center-top="transform: translateY(0%);"
                    data-top-bottom="transform: translateY(-80%);">

                <img class="w-40 shadow position-absolute top-80 start-20" src="{{ main_asset('images/home-2.jpg') }}"
                    alt="" data-bottom-top="transform: translateY(0%);"
                    data-top-bottom="transform: translateY(-50%);">

                <img class="w-40 shadow position-absolute top-0 start-60" src="{{ main_asset('images/home-3.jpg') }}"
                    alt="" data-bottom-top="transform: translateY(0%);"
                    data-top-bottom="transform: translateY(-50%);">

                <img class="w-40 shadow position-absolute top-60 start-80" src="{{ main_asset('images/home-4.jpg') }}"
                    alt="" data-bottom-top="transform: translateY(0%);"
                    data-top-bottom="transform: translateY(-120%);">

                <img class="w-40 shadow position-absolute top-100 start-50" src="{{ main_asset('images/home-5.jpg') }}"
                    alt="" data-bottom-top="transform: translateY(0%);"
                    data-top-bottom="transform: translateY(-60%);">

                <img class="w-40 shadow position-absolute top-60 end-90" src="{{ main_asset('images/home-6.jpg') }}"
                    alt="" data-bottom-top="transform: translateY(0%);"
                    data-top-bottom="transform: translateY(-80%);">
            </figure>
            <span class="scroll-down"></span>
        </section>

        {{-- Step Acordion --}}
        <section class="py-15 py-xl-20 overflow-hidden">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                        <h2>Layanan yang kami tawarkan</h2>
                    </div>

                    <div class="col-lg-6">
                        <div class="accordion accordion-steps" id="accordion-steps" style="--bs-primary: #1d4b40;">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-steps-1">
                                    <button class="accordion-button fs-5 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-steps-1"
                                        aria-expanded="false" aria-controls="collapse-steps-1">
                                        Penyewaan Mobil Harian
                                    </button>
                                </h2>
                                <div id="collapse-steps-1" class="accordion-collapse collapse"
                                    aria-labelledby="heading-steps-1" data-bs-parent="#accordion-steps">
                                    <div class="accordion-body">
                                        <p class="text-secondary">
                                            Pilih dari berbagai jenis mobil sesuai kebutuhan Anda. Layanan penyewaan
                                            mobil harian dengan harga terjangkau.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-steps-2">
                                    <button class="accordion-button fs-5 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-steps-2"
                                        aria-expanded="false" aria-controls="collapse-steps-2">
                                        Paket Wisata
                                    </button>
                                </h2>
                                <div id="collapse-steps-2" class="accordion-collapse collapse"
                                    aria-labelledby="heading-steps-2" data-bs-parent="#accordion-steps">
                                    <div class="accordion-body">
                                        <p class="text-secondary">
                                            Paket wisata ke berbagai destinasi populer. Termasuk transportasi,
                                            akomodasi, dan pemandu wisata.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-steps-3">
                                    <button class="accordion-button fs-5 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-steps-3"
                                        aria-expanded="false" aria-controls="collapse-steps-3">
                                        Transportasi Bandara
                                    </button>
                                </h2>
                                <div id="collapse-steps-3" class="accordion-collapse collapse"
                                    aria-labelledby="heading-steps-3" data-bs-parent="#accordion-steps">
                                    <div class="accordion-body">
                                        <p class="text-secondary">
                                            Layanan antar jemput dari dan ke bandara. Jadwal yang fleksibel dan tepat
                                            waktu.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-steps-4">
                                    <button class="accordion-button fs-5 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-steps-4"
                                        aria-expanded="false" aria-controls="collapse-steps-4">
                                        Sewa Mobil dengan Sopir
                                    </button>
                                </h2>
                                <div id="collapse-steps-4" class="accordion-collapse collapse"
                                    aria-labelledby="heading-steps-4" data-bs-parent="#accordion-steps">
                                    <div class="accordion-body">
                                        <p class="text-secondary">
                                            Layanan sewa mobil lengkap dengan sopir berpengalaman. Nikmati perjalanan
                                            tanpa perlu khawatir tentang rute.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-15 py-xl-20 bg-light">
            <div class="container">
                <div class="row align-items-center justify-content-center justify-content-lg-between">
                    <div class="col-md-10 col-lg-6 mb-5 mb-lg-0">
                        <h2 class="lh-sm mb-5">Mengapa Memilih Kami?</h2>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <ul class="list-group list-group-minimal">
                                    <li class="list-group-item d-flex align-items-center mb-1">
                                        <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                            <i class="bi bi-check2 text-green"></i>
                                        </div>
                                        Armada kendaraan yang terawat dan bersih.
                                    </li>

                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                            <i class="bi bi-check2 text-green"></i>
                                        </div>
                                        Layanan pelanggan 24/7.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-minimal">
                                    <li class="list-group-item d-flex align-items-center mb-1">
                                        <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                            <i class="bi bi-check2 text-green"></i>
                                        </div>
                                        Sopir profesional dan berlisensi.
                                    </li>

                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="icon-box icon-box-sm bg-opaque-green rounded-circle me-2">
                                            <i class="bi bi-check2 text-green"></i>
                                        </div>
                                        Harga kompetitif dengan berbagai pilihan paket.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 col-lg-5 position-relative" data-aos='fade-up'>
                        <div class="equal-1-1 rounded-circle">
                            <figure class="background"
                                style="background-image: url('{{ main_asset('images/home-6.jpg') }}')">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-layout.main>
