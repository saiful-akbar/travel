<x-layout.dashboard title="Pesanan">

    {{-- form filter --}}
    <div class="row mb-5">
        <div class="col-12">
            <form action="{{ route('dashboard.pesanan') }}" method="get">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Filter Pesanan</h4>
                    </div>
    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 mb-3 mb-md-0">
                                <label for="tanggalAwal" class="form-label">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" id="tanggalAwal"
                                    value="{{ request('tanggal_awal', date('Y-m-01')) }}" class="form-control form-control-light">
                            </div>
    
                            <div class="col-md-4 col-sm-12 mb-3 mb-md-0">
                                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                                    value="{{ request('tanggal_akhir', date('Y-m-t')) }}" class="form-control form-control-light">
                            </div>
    
                            <div class="col-md-4 col-sm-12">
                                <label for="status" class="form-label">Status Pesanan</label>
                                <select name="status" id="status" class="form-select form-select-light">
                                    <option value="Semua" @selected(request('status', 'Semua') == 'Semua')>Semua</option>
                                    <option value="Menunggu Pembayaran" @selected(request('status', 'Semua') == 'Menunggu Pembayaran')>Menunggu Pembayaran</option>
                                    <option value="Dibayar" @selected(request('status', 'Semua') == 'Dibayar')>Dibayar</option>
                                    <option value="Dikonfirmasi" @selected(request('status', 'Semua') == 'Dikonfirmasi')>Dikonfirmasi</option>
                                    <option value="Selesai" @selected(request('status', 'Semua') == 'Selesai')>Selesai</option>
                                    <option value="Dibatalkan" @selected(request('status', 'Semua') == 'Dibatalkan')>Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <x-button type="submit" start-icon="bi-filter">Filter</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel data pesanan --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-header-title">Tabel Data Pesanan</h4>

                    <x-button color="white" start-icon="bi-arrow-clockwise" size="sm" id="btnReload">
                        Segarkan
                    </x-button>
                </div>

                <div class="card-body">
                    <table id="pesananTable"class="table table-hover table-thead-bordered table-nowrap table-align-middle w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal konfirmasi bukti pembayaran --}}
    <form action="" id="formKonfirmasiPembayaran" method="post">
        @csrf @method('patch')

        <div class="modal fade" id="modalKonfirmasiPembayaran" data-bs-backdrop="static" tabindex="-1"
            role="dialog" aria-labelledby="modalKonfirmasiPembayaranLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header pb-4 border-bottom">
                        <h5 class="modal-title" id="modalKonfirmasiPembayaranLabel">Konfirmasi Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
    
                    <div class="modal-body" id="modalBodyKonfirmasiPembayaran"></div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">
                            <i class="bi-x-lg me-1"></i>
                            <span>Tutup</span>
                        </button>
                        
                        <button type="submit" class="btn btn-sm btn-primary" id="submitKonfirmasiPembayaran" disabled>
                            <i class="bi-save me-1"></i>
                            <span>Konfirmasi</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Form delete pesanan --}}
    <form action="" method="post" id="formDeletePesanan" class="d-none">
        @csrf @method('delete')
    </form>

    {{-- Script --}}
    <x-slot:script>

        {{-- Datatable --}}
        <script>
            const pesananTable = App.dataTable('#pesananTable', {
                ajax: {
                    url: "{{ route('dashboard.pesanan') }}",
                    dataSrc: "data",
                    data: {
                        tanggal_awal: "{{ request('tanggal_awal', date('Y-m-01')) }}",
                        tanggal_akhir: "{{ request('tanggal_akhir', date('Y-m-t')) }}",
                        status: "{{ request('status', 'Semua') }}",
                        _token: "{{ csrf_token() }}"
                    }
                },
                columns: [
                    {
                        data: 'pesanan_kode',
                        name: 'pesanan.kode',
                        title: 'Kode Pesanan',
                    },
                    {
                        data: 'user_nama_lengkap',
                        name: 'user.nama_lengkap',
                        title: 'Member',
                    },
                    {
                        data: 'pesanan_status',
                        name: 'pesanan.status',
                        title: 'Status',
                        render: (data) => {
                            let color = 'secondary';

                            if (data === 'Dibayar') {
                                color = 'warning';
                            }

                            if (data === 'Dikonfirmasi') {
                                color = 'primary';
                            }

                            if (data === 'Selesai') {
                                color = 'success';
                            }

                            if (data === 'Dibatalkan') {
                                color = 'danger';
                            }

                            return `
                                <span class="badge bg-soft-${color} text-${color}">
                                    <span class="legend-indicator bg-${color}"></span>
                                    ${data}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'tagihan_id',
                        name: 'tagihan.id',
                        title: 'Konfirmasi Pembayaran',
                        render: (data, type, row) => {
                            if (row.pesanan_status === 'Menunggu Pembayaran') {
                                return `
                                    <button class="btn btn-xs btn-secondary" disabled>
                                        Konfirmasi
                                    </button>
                                `;
                            }

                            if (row.pesanan_status === 'Dibayar') {
                                return `
                                    <button class="btn btn-xs btn-warning" onclick="return showModalKonfirmasiPembayaran('${data}')">
                                        Konfirmasi
                                    </button>
                                `;
                            }

                            return `
                                <button class="btn btn-xs btn-success" disabled>
                                    Dikonfirmasi
                                </button>
                            `;
                        }
                    },
                    {
                        data: 'tagihan_jumlah',
                        name: 'tagihan.jumlah',
                        title: 'Jumlah Tagihan',
                        render: (data) => `Rp ${App.numberFormat(parseFloat(data))}`
                    },
                    {
                        data: 'kendaraan_merek',
                        name: 'kendaraan.merek',
                        title: 'Kendaraan',
                        render: (data, type, row) => `${data} ${row.kendaraan_tipe}`,
                    },
                    {
                        data: 'destinasi_wilayah',
                        name: 'destinasi.wilayah',
                        title: 'Destinasi',
                    },
                    {
                        data: 'pesanan_created_at',
                        name: 'pesanan.created_at',
                        title: 'Tanggal',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Aksi',
                        searchlable: false,
                        orderable: false,
                    },
                ],
            })

            $('#btnReload').click(function(e) {
                e.preventDefault();
                pesananTable.ajax.reload();
            });
        </script>

        {{-- Show modal konfirmasi pembayaran --}}
        <script>
            function showModalKonfirmasiPembayaran(tagihanId) {
                const baseUrl = $('meta[name=base-url]').attr('content');
                const modal = new bootstrap.Modal('#modalKonfirmasiPembayaran', {});

                // Show modal
                modal.show();

                // loading konten saat untuk menunggu peroses request
                $('#modalBodyKonfirmasiPembayaran').html(`
                    <div class="d-flex justify-content-center align-item-center">
                        <span>Loading...</span>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                `); 

                // request data tagihan
                $.ajax({
                    type: "get",
                    url: `${baseUrl}/dashboard/pesanan/json/tagihan/${tagihanId}/bukti-pembayaran`,
                    dataType: "json",
                    success: function (res) {
                        const {
                            catatan,
                            bukti_pembayaran: buktiPembayaran,
                            jumlah,
                        } = res.data;

                        $('#submitKonfirmasiPembayaran').removeAttr('disabled');

                        $('#modalBodyKonfirmasiPembayaran').html(`
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="text-secondary">Catatan</h5>
                                </div>

                                <div class="col-12">
                                    <p><small>${catatan}</small></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5 class="text-secondary">Jumlah yang harus dibayar</h5>
                                </div>

                                <div class="col-12">
                                    <p><small>Rp ${App.numberFormat(parseFloat(jumlah))}</small></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-secondary">Bukti Pembayaran</h5>
                                </div>

                                <div class="col-12 p-1">
                                    <img src="${baseUrl}/storage/${buktiPembayaran}" height="100" class="img-fluid border border-3 rounded-2" />
                                </div>
                            </div>
                        `);

                        $('#formKonfirmasiPembayaran').attr(
                            'action',
                            `${baseUrl}/dashboard/pesanan/tagihan/${tagihanId}/konfirmasi-pembayaran`,
                        );
                    },
                    error: function(err) {
                        alert(`Error - ${err.status} ${err.sttausText}`)
                    }
                });
            }
        </script>

        {{-- Menampilkan preloader saat form bukti pembayaran di-submit --}}
        <script>
            $('#formKonfirmasiPembayaran').submit(function (e) { 
                $('#preloader').fadeIn();
            });
        </script>

        {{-- Hapus pesanan --}}
        <script>
            function deletePesanan(pesananId) {
                App.destroy('Pesanan', (deleted) => {
                    if (deleted) {
                        const baseUrl = $('meta[name=base-url]').attr('content');
                        const formDelete = $('#formDeletePesanan');

                        formDelete.attr('action', `${baseUrl}/dashboard/pesanan/${pesananId}`);
                        formDelete.submit();
                    }
                })
            }
        </script>

    </x-slot:script>

</x-layout.dashboard>
