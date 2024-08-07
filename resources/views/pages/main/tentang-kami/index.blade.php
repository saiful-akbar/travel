<x-layout.main title="Tentang Kami" footer-bg-color="dark">
    <section class="overflow-hidden py-15 py-xl-20">
        <div class="container">
            <div class="row align-items-end mt-5">
                <div class="col-lg-8 mb-1 mb-md-0">
                    <h1>Tentang {{ perusahaan()?->nama }}</h1>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <p class="fs-lg text-muted">
                        Nikmati Setiap Perjalanan <span class="d-block">Bersama Kami</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-15 pb-xl-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <span class="eyebrow text-primary mb-4">Tentang Kami</span>
                    <h3 class="fs-4">{{ perusahaan()?->profil }}</h3>
                </div>
            </div>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <div class="py-15 py-xl-20 bg-light" data-center-top="@class: py-15 py-xl-20 bg-color-active;"
        data-top-bottom="@class: py-15 py-xl-20 bg-color-active;" data-edge-strategy="reset">
        <span class="bg-color bg-light"></span>

        <section class="mb-10" data-aos="fade-up" data-aos-delay="150">
            <div class="container">
                <div class="row g-0 bg-white">
                    <div class="col-lg-6 p-4 p-md-10 order-lg-2">
                        <h3 class="fw-bold">Visi</h3>
                        <p class="fs-lg text-secondary">{{ perusahaan()?->visi }}</p>
                    </div>

                    <div class="col-lg-6 order-lg-1 position-relative">
                        <span class="background"
                            style="background-image: url('{{ main_asset('images/bg-1.jpg') }}')"></span>
                    </div>
                </div>
            </div>
        </section>

        <section data-aos="fade-up" data-aos-delay="150">
            <div class="container">
                <div class="row g-0 bg-white">
                    <div class="col-lg-6 order-lg-2 position-relative">
                        <span class="background"
                            style="background-image: url('{{ main_asset('images/bg-6.jpg') }}')"></span>
                    </div>

                    <div class="col-lg-6 p-4 p-md-10 order-lg-1">
                        <h3 class="fw-bold">Misi</h3>
                        <p class="fs-lg text-secondary">{{ perusahaan()?->misi }}</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Kontak --}}
    <section class="py-15 py-xl-20 border-bottom">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1>Kontak Kami</h1>
                    <p>{{ perusahaan()?->profil }}</p>
                    <hr class="my-4 fw-25 ml-0">
                    <ul class="list-group list-group-minimal">
                        <li class="list-group-item d-flex align-items-center">
                            <span class="w-25 text-muted">Email</span>
                            {{ perusahaan()?->email }}
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <span class="w-25 text-muted">Phone</span>
                            {{ perusahaan()?->telepon }}
                        </li>
                    </ul>
                </div>

                <div class="col-lg-5">
                    <div class="media equal-1-1 border border-3">
                        <iframe width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1048.2725071993561!2d106.72015427715367!3d-6.3303649371991915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e56307403f2d%3A0x7dc5996b20197dd9!2sMP9C%2BP2C%2C%20Benda%20Baru%2C%20Kec.%20Pamulang%2C%20Kota%20Tangerang%20Selatan%2C%20Banten%2015415!5e0!3m2!1sid!2sid!4v1723040549297!5m2!1sid!2sid"></iframe>
                    </div>

                    <div class="card bg-black text-white">
                        <div class="card-body">
                            <h5>{{ perusahaan()?->alamat }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout.main>
