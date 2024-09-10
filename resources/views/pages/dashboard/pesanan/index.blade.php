<x-layout.dashboard title="Pesanan">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <x-button color="primary" start-icon="bi-arrow-clockwise" size="sm" id="btnReload">
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
                        title: 'ID Pesanan'
                    },
                    {
                        data: 'pesanan_status',
                        name: 'pesanan_status',
                        title: 'Status',
                        render: (data) => {
                            let color = 'secondary';

                            if (data === 'Konfirmasi') {
                                color = 'primary';
                            }

                            if (data === 'Proses') {
                                color = 'warning';
                            }

                            if (data === 'Selesai') {
                                color = 'success';
                            }

                            if (data === 'Batalkan') {
                                color = 'danger';
                            }

                            return `
                                <button class="btn btn-xs btn-${color}">
                                    ${data}
                                </button>
                            `;
                        }
                    },
                    {
                        data: 'pesanan_tanggal_keberangkatan',
                        name: 'pesanan.tanggal_keberangkatan',
                        title: 'Tgl Berangkat',
                    },
                    {
                        data: 'pesanan_tanggal_kepulangan',
                        name: 'pesanan.tanggal_kepulangan',
                        title: 'Tgl Pulang',
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