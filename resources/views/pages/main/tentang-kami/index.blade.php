<x-layout.main title="Tentang Kami" footer-bg-color="dark" header-bg-color="white">
    <section class="py-15 py-xl-20 pb-xl-15">
        <div class="container mt-10">
            <h1>Tentang {{ perusahaan()->nama }}</h1>
        </div>
    </section>

    {{-- Profil perusahaan --}}
    <section class="py-10 py-xl-15 border-top">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-md-4">
                    <h2 class="fs-5">Profil</h2>
                </div>

                <div class="col-md-8">
                    <p class="text-secondary">{{ perusahaan()->profil }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Visi --}}
    <section class="py-10 py-xl-15 border-top">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-md-4">
                    <h2 class="fs-5">Visi</h2>
                </div>

                <div class="col-md-8">
                    <p class="text-secondary">{{ perusahaan()->visi }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Misi --}}
    <section class="py-10 py-xl-15 border-top">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-md-4">
                    <h2 class="fs-5">Misi</h2>
                </div>

                <div class="col-md-8">
                    <p class="text-secondary">{{ perusahaan()->misi }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kontak --}}
    <section class="py-15 py-xl-20 border-bottom border-top">
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
                            <span class="w-25 text-muted">Telepon</span>
                            {{ perusahaan()?->telepon }}
                        </li>
                    </ul>
                </div>

                <div class="col-lg-5">
                    <div class="media equal-1-1 border border-3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1321.2616360762754!2d106.77016800668781!3d-6.375943507704589!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ef240ec57e7b%3A0x783e87872a51971d!2sAwsy%20Futsal!5e0!3m2!1sid!2sid!4v1726321533040!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
