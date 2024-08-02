<x-layout.main title="Tentang Kami">
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

    <div class="py-15 py-xl-20 bg-light" data-center-top="@class: py-15 py-xl-20 bg-color-active;"
        data-top-bottom="@class: py-15 py-xl-20 bg-color-active;" data-edge-strategy="reset">
        <span class="bg-color bg-light"></span>

        <section class="mb-10" data-aos="fade-right" data-aos-delay="150">
            <div class="container">
                <div class="row g-0 bg-white">
                    <div class="col-lg-6 p-4 p-md-10 order-lg-2">
                        <h3 class="fw-bold">Visi</h3>
                        <p class="fs-lg text-secondary">{{ perusahaan()?->visi }}</p>
                    </div>

                    <div class="col-lg-6 order-lg-1 position-relative">
                        <span class="background"
                            style="background-image: url('{{ main_asset('images/home-1.jpg') }}')"></span>
                    </div>
                </div>
            </div>
        </section>

        <section data-aos="fade-left" data-aos-delay="150">
            <div class="container">
                <div class="row g-0 bg-white">
                    <div class="col-lg-6 order-lg-2 position-relative">
                        <span class="background"
                            style="background-image: url('{{ main_asset('images/home-6.jpg') }}')"></span>
                    </div>

                    <div class="col-lg-6 p-4 p-md-10 order-lg-1">
                        <h3 class="fw-bold">Misi</h3>
                        <p class="fs-lg text-secondary">{{ perusahaan()?->misi }}</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout.main>
