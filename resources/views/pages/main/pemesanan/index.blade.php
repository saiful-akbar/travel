<x-layout.main title="Pemesanan">
    <form id="formPemesanan" method="post" action="{{ route('main.pemesanan.store') }}">
        @csrf @method('post')

        <section class="py-15 py-xl-20">
            <div class="container mt-5">
                @session('alert')
                    <div class="row mb-10">
                        <div class="col-12">
                            <div class="alert alert-{{ session('alert')['variant'] }}">
                                {{ session('alert')['message'] }}
                            </div>
                        </div>
                    </div>
                @endsession

                <div class="row justify-content-between">
                    <div class="col-xl-7 mb-5 mb-xl-0">

                        {{-- Form pemesanan kendaraan --}}
                        <section class="mt-4">
                            <h2 class="fw-bold">Pesan Kendaraan</h2>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="paket" class="form-label">
                                        Paket <span class="text-danger">*</span>
                                    </label>

                                    <select name="paket" id="paket" class="form-select @error('paket') is-invalid @enderror"
                                        required>
                                        <option value="" disabled selected>Pilih Paket...</option>

                                        @foreach ($paket as $paketItem)
                                            <option value="{{ $paketItem->id }}" @selected(old('paket') == $paketItem->id || request('paket') == $paketItem->id)>
                                                {{ $paketItem->nama }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('paket')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="destinasi" class="form-label">
                                        Destinasi <span class="text-danger">*</span>
                                    </label>

                                    <select disabled required name="destinasi" id="destinasi"
                                        class="form-select @error('destinasi') is-invalid @enderror">
                                        <option disabled selected>Pilih Destinasi...</option>
                                    </select>

                                    @error('destinasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="alamatTujuan" class="form-label">
                                        Alamat Tujuan <span class="text-danger">*</span>
                                    </label>

                                    <textarea name="alamat_tujuan" id="alamatTujuan" rows="3" placeholder="Masukan alamat tujuan..."
                                        class="form-control @error('alamat_tujuan') is-invalid @enderror" required>{{ old('alamat_tujuan') }}</textarea>

                                    @error('alamat_tujuan')
                                        <div class="invalid-feelback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-12">
                                    <label for="tanggalKeberangkatan" class="form-label">
                                        Tanggal Keberangkatan <span class="text-danger">*</span>
                                    </label>

                                    <input type="date" name="tanggal_keberangkatan" id="tanggalKeberangkatan"
                                        value="{{ old('tanggal_keberangkatan') }}"
                                        class="form-control @error('tanggal_keberangkatan') is-invalid @enderror" required>

                                    @error('tanggal_keberangkatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-12">
                                    <label for="tanggalKepulangan" class="form-label">
                                        Tanggal Kepulangan <span class="text-danger">*</span>
                                    </label>

                                    <input type="date" name="tanggal_kepulangan" id="tanggalKepulangan"
                                        value="{{ old('tanggal_kepulangan') }}"
                                        class="form-control @error('tanggal_kepulangan') is-invalid @enderror" required>

                                    @error('tanggal_kepulangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="kendaraan" class="form-label">
                                        Kendaraan <span class="text-danger">*</span>
                                    </label>

                                    <select name="kendaraan" id="kendaraan"
                                        class="form-select @error('kendaraan') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih Kendaraan...</option>

                                        @foreach ($kendaraan as $kendaraanItem)
                                            <option value="{{ $kendaraanItem->id }}" @selected(old('kendaraan') == $kendaraanItem->id)>
                                                {{ $kendaraanItem->merek }} - {{ $kendaraanItem->tipe }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 d-grid gap-2">
                                    <button type="button" class="btn btn-dark btn-block" id="cekKetersediaan">
                                        Cek Ketersedian
                                    </button>

                                    <div id="alert"></div>
                                </div>
                            </div>
                        </section>
                        {{-- end form pemesanan kendaraan --}}

                        {{-- form penjemputan --}}
                        <section class="mt-10">
                            <h2 class="fw-bold">Penjemputan</h2>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="waktuPenjemputan" class="form-label">
                                        Waktu Penjemputan <span class="text-danger">*</span>
                                    </label>

                                    <input type="time" id="waktuPenjemputan" name="waktu_penjemputan"
                                        value="{{ old('waktu_penjemputan') }}" placeholder="Masukan waktu penjemputan..."
                                        class="form-control @error('waktu_penjemputan') is-invalid @enderror" required>

                                    @error('waktu_penjemputan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="alamatPenjemputan" class="form-label">
                                        Alamat Penjemputan <span class="text-danger">*</span>
                                    </label>

                                    <textarea name="alamat_penjemputan" id="alamatPenjemputan" rows="3" placeholder="Masukan alamat penjemputan..."
                                        class="form-control @error('alamat_penjemputan') is-invalid @enderror" required>{{ old('alamat_penjemputan') }}</textarea>

                                    @error('alamat_penjemputan')
                                        <div class="invalid-feelback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </section>
                        {{-- end form penjemputan --}}

                    </div>

                    {{-- Harga --}}
                    <div class="col-xl-5 ps-xl-10">
                        <div class="card bg-light sticky-top">
                            <div class="card-body">
                                <h3 id="total">Rp 0</h3>
                            </div>

                            <div class="card-footer">
                                <div class="d-grid text-center">
                                    <button type="submit" class="btn btn-lg btn-primary">Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end harga --}}

                </div>
            </div>
        </section>
    </form>

    <x-slot:script>

        @if (old('paket') || request('paket'))
            @php
                $paketId = old('paket') ?? request('paket');
            @endphp

            <script>
                $(document).ready(function() {
                    const destinasiId = "{{ request('destinasi') }}";

                    $.ajax({
                        type: "get",
                        url: "{{ route('main.pemesanan.json.destinasi', ['paket' => $paketId]) }}",
                        dataType: "json",
                        success: function(response) {
                            let options = `<option value="" selected disabled>Pilih Destinasi...</option>`

                            options += response.data.map((destinasi) => {
                                return `
                                    <option value="${destinasi.id}" ${destinasi.id === destinasiId ? 'selected' : ''}>
                                        ${destinasi.wilayah}
                                    </option>
                                `;
                            });

                            $('#destinasi').removeAttr('disabled');
                            $('#destinasi').html(options);
                        },
                        error: function(error) {
                            alert(`${error.status} - ${error.statusText}`)
                        }
                    });
                });
            </script>
        @endif

        {{-- mengambil data destinasi dari paket yang dipilih --}}
        <script>
            $('#paket').change(function(e) {
                e.preventDefault();

                const paketId = $(this).val();
                const baseUrl = $('meta[name=base-url]').attr('content');
                const url = `${baseUrl}/pemesanan/json/destinasi/${paketId}`;

                $('#destinasi').attr('disabled', 'disabled');

                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        let options = `<option value="" selected disabled>Pilih Destinasi...</option>`

                        options += response.data.map((destinasi) => {
                            return `<option value="${destinasi.id}">${destinasi.wilayah}</option>`
                        });

                        $('#destinasi').removeAttr('disabled');
                        $('#destinasi').html(options);
                    },
                    error: function(error) {
                        alert(`${error.status} - ${error.statusText}`)
                    }
                });
            });
        </script>

        {{-- Periksa ketersediaan kendaraan --}}
        <script>
            $('#cekKetersediaan').click(function(e) {
                e.preventDefault();

                const kendaraanId = $('#kendaraan').val();
                const tanggalKeberangkatan = $('#tanggalKeberangkatan').val();
                const tanggalKepulangan = $('#tanggalKepulangan').val();

                if (tanggalKeberangkatan === '') {
                    return alert('Form Tanggal Keberangkatan harus diisi.')
                }

                if (tanggalKepulangan === '') {
                    return alert('Form Tanggal Kepulangan harus diisi.')
                }

                if (kendaraanId === null) {
                    return alert('Form kendaraan harus diisi.')
                }

                $('#preloader').fadeIn();

                const request = $.ajax({
                    type: "get",
                    url: `{{ route('main.pemesanan.json.ketersediaan') }}`,
                    dataType: "json",
                    data: {
                        kendaraan_id: kendaraanId,
                        tanggal_keberangkatan: tanggalKeberangkatan,
                        tanggal_kepulangan: tanggalKepulangan,
                    },
                    success: function(response) {
                        $('#alert').html(`
                            <div class="mt-1 alert alert-${response.data ? 'success' : 'danger'}">
                                ${response.data ? 'Kendaraan tersedia.' : 'Kendaraan tidak tesedia.'}
                            </div>
                        `);
                    },
                    error: function(error) {
                        alert(`${error.status} - ${error.statusText}`);
                    },
                    complete: function() {
                        $('#preloader').fadeOut();
                    }
                });
            });
        </script>

        {{-- Ambil harga --}}
        <script>
            const cekHarga = () => {
                const destinasiId = $('#destinasi').val();
                const tanggalKeberangkatan = $('#tanggalKeberangkatan').val();
                const tanggalKepulangan = $('#tanggalKepulangan').val();
                const kendaraanId = $('#kendaraan').val();

                $.ajax({
                    type: "GET",
                    url: '<?= route('main.pemesanan.json.harga') ?>',
                    dataType: "json",
                    data: {
                        destinasi_id: destinasiId,
                        tanggal_keberangkatan: tanggalKeberangkatan,
                        tanggal_kepulangan: tanggalKepulangan,
                        kendaraan_id: kendaraanId,
                    },
                    success: function(response) {
                        $('#total').text(`Rp ${parseInt(response.data.total).toLocaleString()}`);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching price:', status, error);
                    }
                });
            }

            $('#destinasi').change(function(e) {
                e.preventDefault();
                cekHarga();
            });

            $('#tanggalKeberangkatan').change(function(e) {
                e.preventDefault();
                cekHarga();
            });

            $('#tanggalKepulangan').change(function(e) {
                e.preventDefault();
                cekHarga();
            });

            $('#kendaraan').change(function(e) {
                e.preventDefault();
                cekHarga();
            });
        </script>

    </x-slot:script>
</x-layout.main>
