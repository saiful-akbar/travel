<x-layout.dashboard title="Kendaraan">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.kendaraan.create') }}" start-icon="bi-plus-lg">
            Tambah
        </x-button>
    </x-slot:header-action>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="kendaraanTable" class="table table-hover table-thead-bordered table-align-middle table-nowrap w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form delete --}}
    <form id="formDeleteKendaraan" method="post">
        @csrf @method('delete')
    </form>

    <x-slot:script>

        {{-- Data table --}}
        <script>
            App.dataTable('#kendaraanTable', {
                ajax: "{{ route('dashboard.kendaraan') }}",
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
                        data: 'gambar',
                        name: 'gambar',
                        title: 'Gambar',
                        render: (data, type, row) => {
                            if (data === null) {
                                return `
                                    <img
                                        src="{{ image() }}"
                                        alt="Gambar"
                                        width="100"
                                        height="70"
                                        class="rounded-2 border border-2"
                                        style="object-fit: cover; object-position: center;"
                                    />
                                `;
                            }

                            return `
                                <img
                                    src="${App.url(`/storage/${data}`)}"
                                    alt="Gambar"
                                    width="100"
                                    height="70"
                                    class="rounded-2 border border-3"
                                    style="object-fit: contain; object-position: center;"
                                />
                            `;
                        }
                    },
                    {
                        data: 'kapasitas',
                        name: 'kapasitas',
                        title: 'Kapasitas',
                    },
                    {
                        data: 'jumlah_unit',
                        name: 'jumlah_unit',
                        title: 'Jmlh Unit',
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
                        searchlabel: false,
                        orderable: false,
                    }
                ],
            })
        </script>

        {{-- Handle hapus --}}
        <script>
            function handleDelete(id) {
                App.destroy('Kendaraan', (result) => {
                    if (result) {
                        $('#formDeleteKendaraan').attr('action', App.dashboardUrl(`/kendaraan/${id}`))
                        $('#formDeleteKendaraan').submit();
                    }
                })
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>