<x-layout.dashboard title="Pesanan">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <x-button color="white" start-icon="bi-arrow-clockwise" size="sm" id="btnReload">
                        Segarkan
                    </x-button>
                </div>

                <div class="card-body">
                    <table id="pesananTable" class="table table-hover table-thead-bordered table-nowrap table-align-middle w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Data table --}}
    <x-slot:script>
        <script>
            const pesananTable = App.dataTable('#pesananTable', {
                ajax: "{{ route('dashboard.pesanan') }}",
                columns: [
                    {
                        data: 'pesanan_id',
                        name: 'pesanan.id',
                        title: 'ID Pesanan',
                    },
                    {
                        data: 'user_nama_lengkap',
                        name: 'user.nama_lengkap',
                        title: 'Member',
                    },
                    {
                        data: 'tagihan_jumlah',
                        name: 'tagihan.jumlah',
                        title: 'Jumlah Tagihan',
                        render: (data) => `Rp ${App.numberFormat(parseFloat(data))}`
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

                            if (data === 'Konfirmasi') {
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

            $('#btnReload').click(function (e) { 
                e.preventDefault();
                pesananTable.ajax.reload();
            });
        </script>
    </x-slot:script>
</x-layout.dashboard>