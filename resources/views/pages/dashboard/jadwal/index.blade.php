<x-layout.dashboard title="Jadwal">
    <x-slot:sub-title>
        <p class="page-header-text">Daftar jadwal keberangkatan</p>
    </x-slot:sub-title>

    {{-- Form filter --}}
    <section class="mb-7">
        <form action="{{ route('dashboard.jadwal') }}" method="get" id="formFilterJadwal">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Filter Jadwal</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 mb-lg-0 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-select form-select-light">
                                <option value="tanggal_keberangkatan" @selected(request('kategori', 'tanggal_keberangkatan') == 'tanggal_keberangkatan')>Tanggal Keberangkatan</option>
                                <option value="tanggal_kepulangan" @selected(request('kategori') == 'tanggal_kepulangan')>Tanggal Kepulangan</option>
                                <option value="created_at" @selected(request('kategori') == 'created_at')>Tanggal Pemesanan</option>
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-12 mb-lg-0 mb-3">
                            <label for="tanggalAwal" class="form-label">Tanggal awal</label>
                            <input type="date" name="tanggal_awal" id="tanggalAwal"
                                value="{{ request('tanggal_awal', date('Y-m-01')) }}"
                                class="form-control form-control-light">
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <label for="tanggalAkhir" class="form-label">Tanggal akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggalAkhir"
                                value="{{ request('tanggal_akhir', date('Y-m-t')) }}"
                                class="form-control form-control-light">
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <x-button type="submit" color="primary" start-icon="bi-filter">
                        Filter
                    </x-button>
                </div>
            </div>
        </form>
    </section>

    {{-- Tabel jadwal --}}
    <section>
        <div class="card">
            <div class="card-header card-header-content-between">
                <h4 class="card-header-title mb-2 mb-sm-0">Tabel Jadwal</h4>
                <x-button type="button" color="white" start-icon="bi-arrow-clockwise" id="btnReload" size="sm">
                    Segarkan
                </x-button>
            </div>

            <div class="card-body">
                <table id="jadwalTable"class="table table-hover table-thead-bordered table-nowrap table-align-middle w-100"></table>
            </div>
        </div>
    </section>

    {{-- javascript --}}
    <x-slot:script>

        {{-- dataTable --}}
        <script>
            const jadwalTable = App.dataTable('#jadwalTable', {
                responsive: false,
                scrollX: true,
                ajax: {
                    url: "{{ route('dashboard.jadwal') }}",
                    dataSrc: 'data',
                    data: {
                        kategori: "{{ request('kategori', 'tanggal_keberangkatan') }}",
                        tanggal_awal: "{{ request('tanggal_awal', date('Y-m-01')) }}",
                        tanggal_akhir: "{{ request('tanggal_akhir', date('Y-m-t')) }}",
                    },
                },
                columns: [
                    {
                        data: 'pesanan_tanggal_pemesanan',
                        name: 'pesanan.tanggal_pemesanan',
                        title: 'TANGGAL PEMESANAN',
                    },
                    {
                        data: 'pesanan_tanggal_keberangkatan',
                        name: 'pesanan.tanggal_keberangkatan',
                        title: 'KEBERANGKATAN',
                    },
                    {
                        data: 'pesanan_tanggal_kepulangan',
                        name: 'pesanan.tanggal_kepulangan',
                        title: 'KEPULANGAN',
                    },
                    {
                        data: 'pesanan_jumlah_hari',
                        name: 'pesanan.jumlah_hari',
                        title: 'JUMLAH HARI',
                        render: (data) => `${data} Hari`
                    },
                    {
                        data: 'kendaraan_merek',
                        name: 'kendaraan.merek',
                        title: 'KENDARAAN',
                        render: (data, type, row) => `${data} - ${row.kendaraan_tipe}`,
                    },
                    {
                        data: 'unit_kendaraan_nomor',
                        name: 'unit_kendaraan.nomor',
                        title: 'NOMOR KENDARAAN',
                    },
                    {
                        data: 'destinasi_wilayah',
                        name: 'destinasi.wilayah',
                        title: 'DESTINASI',
                    },
                ],
            })
        </script>

        {{-- Reload dataTable --}}
        <script>
            $('#btnReload').click(function (e) { 
                e.preventDefault();
                jadwalTable.ajax.reload();
            });
        </script>

    </x-slot:script>
</x-layout.dashboard>