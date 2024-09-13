<x-layout.main title="Detail Pesanan" footer-bg-color="dark">
    <section class="py-20">
        <div class="container mt-10">
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
                                                        'rounded-pill',
                                                        'bg-primary' => $pesanan->status == 'Dipesan',
                                                        'bg-secondary' => $pesanan->status == 'Dikonfirmasi',
                                                        'bg-warning' => $pesanan->status == 'Dalam Perjalanan',
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
                                                Rp {{ number_format($pesanan->tagihan?->jumlah) }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Status</span>
                                                <span
                                                    @class([
                                                    'badge',
                                                    'rounded-pill',
                                                    'bg-danger' => $pesanan->tagihan?->status == 'Belum Bayar',
                                                    'bg-success' => $pesanan->tagihan?->status == 'Lunas',
                                                    ])
                                                >
                                                    {{ $pesanan->tagihan?->status }}
                                                </span>
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Tanggal Pembayaran</span>
                                                {{ $pesanan->tagihan?->tanggal_pembayaran }}
                                            </li>
    
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="w-50 text-muted">Catatan</span>
                                                {{ $pesanan->tagihan?->catatan }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="border-top py-5">
                        <h3 class="fs-4 mb-5">Metode Pembayaran</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex p-4 border align-items-center">
                                    <div class="col">
                                        <span class="text-secondary">
                                            <span class="d-block fw-bold text-primary">Mastercard</span>
                                            <small>ending in</small>
                                        </span>
                                    </div>

                                    <div class="col-auto text-end">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-white btn-icon rounded-circle" href="#" role="button" id="dropdownMenuLink-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
            
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex p-4 border align-items-center">
                                    <div class="col">
                                        <span class="text-secondary">
                                            <span class="d-block fw-bold text-primary">Paypal</span>
                                            <small>example@example.com</small>
                                        </span>
                                    </div>

                                    <div class="col-auto text-end">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-white btn-icon rounded-circle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
            
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="border-top pt-5">
                        <div class="d-grid">
                            <button data-bs-toggle="modal" data-bs-target="#modalUploadBuktiPembayaran" class="btn btn-dark">
                                Unggah Bukti Pembayaran
                            </button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal form upload bukti pembayaran --}}
    <form action="post" action="#" autocomplete="off" id="formUploadBuktiPembayaran">
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
                        </div>

                        <div class="mb-5">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea name="catatan" id="catatan" rows="3"
                                class="form-control @error('catatan') is-invalid @enderror"
                                placeholder="Masukan catatan...">{{ old('catatan') }}</textarea>
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
</x-layout.main>
