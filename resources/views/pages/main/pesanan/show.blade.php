<x-layout.main title="Detail Pesanan" footer-bg-color="dark">
    <section class="py-20">
        <div class="container mt-10">
            @if (session('alert'))
                <div class="mb-10 alert alert-{{ session('alert')['variant'] }}">
                    {{ session('alert')['message'] }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-10">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-5 justify-content-center justify-content-lg-between">
                <div class="col-lg-6 position-relative">
                    <div class="row g-1">
                        <div class="col-md-10 order-md-2">
                            <figure class="product-image bg-light p-2">
                                <img src="{{ image($pesanan->unitKendaraan->kendaraan->gambar) }}" alt="Kendaraan" width="100%" height="450" style="object-fit: contain; object-position: initial;" />
                            </figure>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h1 class="mb-5">{{ $pesanan->destinasi->wilayah }}</h1>

                    {{-- Deskripsi --}}
                    <section class="border-top py-5">
                        <div class="accordion accordion-minimal" id="detailPesanan">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingDeskripsi">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#bodyDeskripsi" aria-expanded="false" aria-controls="bodyDeskripsi">
                                        Deskripsi
                                    </button>
                                </h2>
    
                                <div id="bodyDeskripsi" class="accordion-collapse collapse" aria-labelledby="headingDeskripsi" data-bs-parent="#detailPesanan">
                                    <div class="accordion-body">
                                        <ul class="list-group list-group-minimal">
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Keberangkatan</span>
                                                {{ date('d M Y', strtotime($pesanan->tanggal_keberangkatan)) }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Kepulangan</span>
                                                {{ date('d M Y', strtotime($pesanan->tanggal_kepulangan)) }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Jumlah Hari</span>
                                                {{ $pesanan->destinasi->jumlah_hari }} Hari
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Alamat Tujuan</span>
                                                {{ $pesanan->alamat_tujuan }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Waktu Penjemputan</span>
                                                {{ $pesanan->waktu_penjemputan }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Status</span>
                                                <span
                                                    @class([
                                                        'badge',
                                                        'bg-secondary' => $pesanan->status == 'Menunggu Pembayaran',
                                                        'bg-warning' => $pesanan->status == 'Dibayar',
                                                        'bg-primary' => $pesanan->status == 'Dikonfirmasi',
                                                        'bg-success' => $pesanan->status == 'Selesai',
                                                        'bg-danger' => $pesanan->status == 'Dibatalkan',
                                                    ])
                                                >
                                                    {{ $pesanan->status }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
    
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingKendaraan">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#bodyKendaraan" aria-expanded="false" aria-controls="bodyKendaraan">
                                        Kendaraan
                                    </button>
                                </h2>
    
                                <div id="bodyKendaraan" class="accordion-collapse collapse" aria-labelledby="headingKendaraan" data-bs-parent="#detailPesanan">
                                    <div class="accordion-body">
                                        <ul class="list-group list-group-minimal">
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Jenis Kendaraan</span>
                                                {{ $pesanan->unitKendaraan->kendaraan->merek }} {{ $pesanan->unitKendaraan->kendaraan->tipe }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">No Polisi</span>
                                                {{ $pesanan->unitKendaraan->nomor }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Kapasitas</span>
                                                {{ $pesanan->unitKendaraan->kendaraan->kapasitas }} Penumpang
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
    
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTagihan">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#bodyTagihan" aria-expanded="false" aria-controls="bodyTagihan">
                                        Tagihan
                                    </button>
                                </h2>
    
                                <div id="bodyTagihan" class="accordion-collapse collapse" aria-labelledby="headingTagihan" data-bs-parent="#detailPesanan">
                                    <div class="accordion-body">
                                        <ul class="list-group list-group-minimal">
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Jumlah</span>
                                                Rp {{ number_format($pesanan->tagihan->jumlah) }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Tanggal Pembayaran</span>
                                                {{ date('d M Y, H:i', strtotime($pesanan->tagihan->tanggal_pembayaran)) }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Catatan</span>
                                                {{ $pesanan->tagihan->catatan }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Metode Pembayaran --}}
                    <section class="border-top py-5">
                        <h3 class="fs-4 mb-5">Metode Pembayaran</h3>

                        <div class="row p-4 border">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="text-secondary">No. Rekening</div>
                                    <div class="h5 mt-1">014 - 2040264127</div>
                                </div>

                                <div class="mb-3">
                                    <div class="text-secondary">Atas Nama</div>
                                    <div class="h5 mt-1">Saipul Aji</div>
                                </div>

                                <div class="mb-3">
                                    <div class="text-secondary">Jumlah yang harus dibayar</div>
                                    <div class="h5 mt-1">Rp {{ number_format($pesanan->tagihan->jumlah) }}</div>
                                </div>
                            </div>

                            <div class="col-lg-6 d-flex justify-content-center align-item-center">
                                <img src="{{ main_asset('images/bca-logo.svg') }}" alt="BCA" width="250" height="100%">
                            </div>
                        </div>
                    </section>

                    {{-- Upload bukti pembayaran --}}
                    @if ($pesanan->status == 'Menunggu Pembayaran')
                        <section class="border-top pt-5">
                            <div class="d-grid">
                                <button data-bs-toggle="modal" data-bs-target="#modalUploadBuktiPembayaran" class="btn btn-dark">
                                    Unggah Bukti Pembayaran
                                </button>
                            </div>
                        </section>
                    @endif

                </div>
            </div>
        </div>
    </section>

    {{-- Modal form upload bukti pembayaran --}}
    @if ($pesanan->status == 'Menunggu Pembayaran')
        <form method="post" action="{{ route('main.pesanan.buktiPembayaran', ['pesanan' => $pesanan->id]) }}"
            autocomplete="off" id="formUploadBuktiPembayaran" enctype="multipart/form-data">
            @csrf @method('post')

            <div class="modal fade" id="modalUploadBuktiPembayaran" tabindex="-1" aria-labelledby="modalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h5 class="modal-title mb-5">Unggah Bukti Pembayaran</h5>
                            
                            <div class="mb-3">
                                <label for="file" class="form-label">Unggah File</label>
                                <input type="file" id="file" name="file"
                                    accept=".jpeg,.jpg,.png,.pdf,.docx"
                                    value="{{ old('file') }}"
                                    class="form-control form-control-sm @error('file') is-invalid @enderror">

                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea name="catatan" id="catatan" rows="3"
                                    class="form-control @error('catatan') is-invalid @enderror"
                                    placeholder="Masukan catatan...">{{ old('catatan') }}</textarea>

                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                                <button type="submit" class="btn btn-sm btn-primary ms-1">Kirim</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    @endif

    {{-- Javascript --}}
    <x-slot:script>
        <script>
            $('#formUploadBuktiPembayaran').submit(function (e) { 
                $('#preloader').fadeIn();
            });
        </script>
    </x-slot:script>
</x-layout.main>
