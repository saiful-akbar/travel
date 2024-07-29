<x-layouts.dashboard title="Harga">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.harga.create') }}"
            color="primary"
            start-icon="bi-plus-lg"
        >
            Tambah Harga
        </x-button>
    </x-slot:header-action>

    {{-- Table --}}
    <div class="card">
        <div class="card-body">
            <table id="hargaTable" class="table table-hover table-thead-bordered table-align-middle table-nowrap w-100"></table>
        </div>
    </div>

    {{-- form delete --}}
    <form id="formDeleteHarga" method="post">
        @csrf @method('delete')
    </form>

    <x-slot:script>

        {{-- Datatable --}}
        <script>
            App.dataTable('#hargaTable', {
                ajax: '{{ route("dashboard.harga") }}',
                columns: [
                    {
                        data: 'kendaraan_merek',
                        name: 'kendaraan.merek',
                        title: 'Kendaraan',
                        render: (data, type, row) => {
                            return `${row.kendaraan_merek} - ${row.kendaraan_tipe}`;
                        },
                    },
                    {
                        data: 'destinasi_wilayah',
                        name: 'destinasi.wilayah',
                        title: 'Destinasi',
                        render: (data, type, row) => {
                            return `${row.destinasi_wilayah} - ${row.destinasi_jumlah_hari} Hari`;
                        },
                    },
                    {
                        data: 'nominal',
                        name: 'harga.nominal',
                        title: 'Nominal Harga',
                        render: (data, type, row) => {
                            return `Rp ${App.numberFormat(parseFloat(data), 2)}`;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'harga.created_at',
                        title: 'Dibuat',
                    },
                    {
                        data: 'updated_at',
                        name: 'harga.updated_at',
                        title: 'Diubah',
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
        </script>

        {{-- handle delete --}}
        <script>
            function handleDelete(id) {
                App.destroy('Harga', function(deleted) {
                    const form = $('#formDeleteHarga');

                    form.attr('action', App.dashboardUrl(`/harga/${id}`));
                    form.submit();
                })
            }
        </script>

    </x-slot:script>
</x-layouts.dashboard>