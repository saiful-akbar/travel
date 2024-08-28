<x-layout.main title="Layanan" bg-color="light" footer-bg-color="dark">

    {{-- Daftar layanan --}}
    <section class="py-15 py-xl-20">
        <div class="container mt-5 mt-xl-10">
            <div class="row justify-content-center mb-5 mb-xl-10">
                <div class="col-lg-8 text-center">
                    <h1 class="fw-light mb-5">
                        <span class="fw-bold">Paket destinasi</span> yang tersedia sekarang.
                    </h1>

                    <button class="btn btn-filter rounded-pill current mb-1 mb-md-0" data-filter="*"
                        data-target="#grid1">
                        semua
                    </button>

                    @foreach ($pakets as $paket)
                        <button class="btn btn-filter rounded-pill mb-1 mb-md-0" data-target="#grid1"
                            data-filter=".filter-{{ $paket->id }}">
                            {{ $paket->nama }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="row g-1" id="grid1" data-isotope>
                @foreach ($pakets as $paket)
                    @foreach ($paket->destinasi as $destinasi)
                        <div class="col-12 filter-{{ $destinasi->paket_id }}">
                            <a href="{{ url()->query('/pemesanan', ['destinasi' => $destinasi->id]) }}"
                                class="card bg-white card-hover-border">
                                <div class="card-body">
                                    <div class="row align-items-center g-2 g-md-4 text-center text-md-start">
                                        <div class="col-md-8">
                                            <p class="fs-lg mb-0">{{ $destinasi->wilayah }}</p>

                                            <ul class="list-inline list-inline-separated text-muted">
                                                <li class="list-inline-item">{{ $paket->nama }}</li>
                                                <li class="list-inline-item">{{ $destinasi->jumlah_hari }} Hari</li>
                                            </ul>
                                        </div>

                                        <div class="col-md-4 text-lg-end">
                                            Rp{{ number_format($destinasi->harga_minimum) }} k –
                                            Rp{{ number_format($destinasi->harga_maksimum) }} k
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endforeach
            </div>

        </div>
    </section>

    {{-- Daftar Kendaraan --}}
    <section class="py-15 py-xl-20 overflow-hidden bg-white">
        <div class="container">
            <div class="row align-items-end mb-6">
                <div class="col-lg-8">
                    <h2 class="fw-bold">Armada Kami</h2>
                </div>
            </div>

            <div class="carousel carousel-visible">
                <div
                    data-carousel='{
                        "nav": false,
                        "mouseDrag": true,
                        "gutter": 32,
                        "loop": true,
                        "responsive": {
                            "0": {"items": 1},
                            "768": {"items": 2},
                            "992": {"items": 2},
                            "1200": {"items": 3}
                        }
                    }'>
                    @foreach ($kendaraans as $kendaraan)
                        <div>
                            <div class="product">
                                <figure class="product-image bg-light p-2">
                                    <img src="{{ image($kendaraan->gambar) }}" alt="{{ $kendaraan->tipe }}"
                                        width="100%" height="370"
                                        style="object-fit: contain; object-position: initial;" />
                                </figure>

                                <span class="product-title fw-bold">
                                    {{ $kendaraan->merek }} - {{ $kendaraan->tipe }}
                                </span>

                                <small class="product-price text-muted">
                                    Kapasitas {{ $kendaraan->kapasitas }} penumpang
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</x-layout.main>
