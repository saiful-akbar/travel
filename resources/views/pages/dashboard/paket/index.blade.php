<x-layout.dashboard title="Paket Perjalanan">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.paket.create') }}" start-icon="bi-plus-lg">
            Tambah
        </x-button>
    </x-slot:header-action>

    {{-- Table --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table id="paketTable" class="table table-hover table-thead-bordered table-nowrap table-align-middle w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form delete --}}
    <form method="post" id="formDeletePaket" class="d-none">
        @csrf @method('delete')
    </form>

    <x-slot:script>

        {{-- Datatable --}}
        <script>
            App.dataTable('#paketTable', {
                ajax: "{{ route('dashboard.paket') }}",
                columns: [
                    {
                        data: 'nama',
                        name: 'nama',
                        title: 'Nama Paket',
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        title: 'Deskripsi',
                        render: (data) => data === null ? '-' : data,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        title: 'Dibuat',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
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

        {{-- Handle delete --}}
        <script>
            function handleDelete(id) {
                App.destroy('Paket', function(deleted) {
                    if (deleted) {
                        const form = $('#formDeletePaket');

                        form.attr('action', App.dashboardUrl(`/paket/${id}`));
                        form.submit();
                    }
                })
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>