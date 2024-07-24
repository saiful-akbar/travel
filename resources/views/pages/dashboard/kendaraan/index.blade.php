<x-layouts.dashboard title="Kendaraan">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.kendaraan.create') }}"
            color="primary"
            start-icon="bi-plus-lg"
        >
            Tambah Baru
        </x-button>
    </x-slot:header-action>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="kendaraanTable" class="table table-hover table-thead-bordered table-align-middle w-100"></table>
                </div>
            </div>
        </div>
    </div>

    <x-slot:script>
        <script>

            // Data table
            $('#kendaraanTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('dashboard.kendaraan') }}",
                language: {
                    search: "",
                    searchPlaceholder: 'Search...',
                    lengthMenu: "_MENU_"
                },
                order: {
                    name: 'merek',
                    dir: 'asc'
                },
                columns: [
                    {
                        data: 'merek',
                        name: 'merek',
                        title: 'Merek'
                    },
                    {
                        data: 'tipe',
                        name: 'tipe',
                        title: 'Tipe'
                    },
                    {
                        data: 'kapasitas',
                        name: 'kapasitas',
                        title: 'Kapasitas',
                    },
                    {
                        data: 'jumlah_unit',
                        name: 'jumlah_unit',
                        title: 'Jumlah Unit',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Aksi',
                        searchlabel: false,
                        orderable: false,
                    }
                ],
            })

        </script>
    </x-slot:script>
</x-layouts.dashboard>