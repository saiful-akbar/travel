<x-layout.dashboard title="Destinasi">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.destinasi.create') }}" start-icon="bi-plus-lg">
            Tambah
        </x-button>
    </x-slot:header-action>

    {{-- Tabel destinasi --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="destinasiTable" class="table table-hover table-thead-bordered table-align-middle table-nowrap w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form delete --}}
    <form id="formDeleteDestinasi" method="post" class="d-none">
        @csrf @method('delete')
    </form>

    <x-slot:script>

        {{-- Datatable --}}
        <script>
            App.dataTable('#destinasiTable', {
                ajax: "{{ route('dashboard.destinasi') }}",
                columns: [
                    {
                        data: 'paket_nama',
                        name: 'paket.nama',
                        title: 'Paket',
                    },
                    {
                        data: 'wilayah',
                        name: 'destinasi.wilayah',
                        title: 'Wilayah',
                    },
                    {
                        data: 'jumlah_hari',
                        name: 'destinasi.jumlah_hari',
                        title: 'Jumlah Hari',
                    },
                    {
                        data: 'aktif',
                        name: 'destinasi.aktif',
                        title: 'Status',
                        render: (data) => {
                            const color = data ? 'success' : 'danger'
                            return `
                                <span class="badge bg-soft-${color} text-${color}">
                                    ${data ? 'Aktif' : 'Tidak Aktif'}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'destinasi.created_at',
                        title: 'Dibuat',
                    },
                    {
                        data: 'updated_at',
                        name: 'destinasi.updated_at',
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
                App.destroy('Destinasi', function(deleted) {
                    if (deleted) {
                        const form = $('#formDeleteDestinasi');

                        form.attr('action', App.dashboardUrl(`/destinasi/${id}`));
                        form.submit();
                    }
                })
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>