<x-layout.main title="Pemesanan">
    <form id="formPemesanan">
        <section class="py-15 py-xl-20">
            <div class="container mt-5">
                <div class="row justify-content-between">
                    <div class="col-xl-7 mb-5 mb-xl-0">
                        <section class="mt-4">
                            <h2 class="fw-bold">Pesan Kendaraan</h2>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="paket" class="form-label">
                                        Paket <span class="text-danger">*</span>
                                    </label>

                                    <select name="paket" id="paket"
                                        class="form-select @error('paket') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih Paket...</option>

                                        @foreach ($paket as $paketItem)
                                            <option value="{{ $paketItem->id }}" @selected(old('paket') == $paketItem->id)>
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

                                    <select name="destinasi" id="destinasi"
                                        class="form-select @error('destinasi') is-invalid @enderror" disabled
                                        required></select>
                                </div>

                                <div class="col-12">
                                    <label for="alamatTujuan" class="form-label">
                                        Alamat Tujuan <span class="text-danger">*</span>
                                    </label>

                                    <textarea name="alamat_tujuan" id="alamatTujuan" rows="3" placeholder="Masukan alamat tujuan anda..."
                                        class="form-control @error('alamat_tujuan') is-invalid @enderror">{{ old('alamat_tujuan') }}</textarea>

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
                                        class="form-control @error('tanggal_keberangkatan') is-invalid @enderror"
                                        required>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <label for="tanggalKepulangan" class="form-label">
                                        Tanggal Kepulangan <span class="text-danger">*</span>
                                    </label>

                                    <input type="date" name="tanggal_kepulangan" id="tanggalKepulangan"
                                        value="{{ old('tanggal_kepulangan') }}"
                                        class="form-control @error('tanggal_kepulangan') is-invalid @enderror" required>
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
                                </div>

                                <div class="col-12 d-grid gap-2">
                                    <button type="button" class="btn btn-dark btn-block" id="cekKetersediaan">
                                        Cek Ketersedian
                                    </button>

                                    <div id="alert"></div>
                                </div>
                            </div>
                        </section>

                        <section class="mt-10">
                            <h2 class="fw-bold">Penjemputan</h2>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="waktuPenjemputan" class="form-label">
                                        Waktu Penjemputan <span class="text-danger">*</span>
                                    </label>

                                    <input type="time" id="waktuPenjemputan" name="waktu_penjemputan"
                                        value="{{ old('waktu_penjemputan') }}"
                                        placeholder="Masukan waktu penjemputan..."
                                        class="form-control @error('waktu_penjemputan') is-invalid @enderror" required>

                                    @error('waktu_penjemputan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="lokasiPenjemputan" class="form-label">
                                        Alamat Penjemputan <span class="text-danger">*</span>
                                    </label>

                                    <textarea name="lokasi_penjemputan" id="lokasiPenjemputan" rows="3" placeholder="Masukan alamat penjemputan..."
                                        class="form-control @error('lokasi_penjemputan') is-invalid @enderror">{{ old('lokasi_penjemputan') }}</textarea>

                                    @error('lokasi_penjemputan')
                                        <div class="invalid-feelback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="col-xl-5 ps-xl-10">
                        <div class="card bg-light sticky-top">
                            <div class="card-body">
                                <h3 id="total">Rp 0</h3>
                            </div>

                            <div class="card-footer">
                                <div class="d-grid text-center">
                                    <a href="#" class="btn btn-lg btn-primary rounded-pill">Proceed to
                                        Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <x-slot:script>

        {{-- mengambil data destinasi dari paket yang dipilih --}}
        <script>
            $('#paket').change(function(e) {
                e.preventDefault();

                const paketId = $(this).val();
                const baseUrl = $('meta[name=base-url]').attr('content');
                const url = `${baseUrl}/pemesanan/json/destinasi/${paketId}`;

                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        const {
                            data
                        } = response;
                        let options = `<option value="" selected disabled>Pilih Destinasi...</option>`

                        options += data.map((destinasi) => {
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

                if (kendaraanId === null || tanggalKeberangkatan === '' || tanggalKepulangan === '') {
                    alert('Form kendaraan, Tanggal Keberangkatan dan Tanggal Kepulangan harus diisi.')
                } else {
                    $('#preloader').fadeIn();

                    const baseUrl = $('meta[name=base-url]').attr('content');
                    const request = $.ajax({
                        type: "get",
                        url: `${baseUrl}/pemesanan/json/ketersediaan`,
                        dataType: "json",
                        data: {
                            kendaraan_id: kendaraanId,
                            tanggal_keberangkatan: tanggalKeberangkatan,
                            tanggal_kepulangan: tanggalKepulangan,
                        },
                    });

                    request.done(function(response) {
                        const data = response.data;

                        $('#preloader').fadeOut();

                        $('#alert').html(`
                            <div class="mt-1 alert alert-${data === 0 ? 'success' : 'danger'}">
                                ${data === 0 ? 'Kendaraan tersedia' : 'Kendaraan tidak tersedia'}
                            </div>
                        `);
                    });

                    request.fail(function(error) {
                        $('#preloader').fadeOut();

                        alert(`${error.status} - ${error.statusText}`);
                    });
                }
            });
        </script>

        {{-- Ambil harga --}}
        <script>
            const cekHarga = (destinasi = null, kendaraan = null) => {
                const baseUrl = $('meta[name=base-url]').attr('content');

                $.ajax({
                    type: "get",
                    url: `${baseUrl}/pemesanan/json/harga`,
                    dataType: "json",
                    data: {
                        destinasi,
                        kendaraan,
                    },
                    success: function(response) {
                        $('#total').text(`Rp ${parseInt(response.data).toLocaleString()}`);
                    }
                });
            }

            $('#destinasi').change(function(e) {
                cekHarga($(this).val(), $('#kendaraan').val())
            });

            $('#kendaraan').change(function(e) {
                cekHarga($('#destinasi').val(), $(this).val())
            });
        </script>

    </x-slot:script>
</x-layout.main>
