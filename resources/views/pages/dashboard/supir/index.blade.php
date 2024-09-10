<x-layout.dashboard title="Supir">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.supir.create') }}" start-icon="bi-plus-lg">
            Tambah
        </x-button>
    </x-slot:header-action>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="supirTable" class="table table-thead-bordered table-hover table-nowrap table-align-middle w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form delete --}}
    <form id="formDeleteSupir" method="post" class="d-none">
        @csrf @method('delete')
    </form>

    <x-slot:script>
        
        {{-- data table --}}
        <script>
            App.dataTable('#supirTable', {
                ajax: "{{ route('dashboard.supir') }}",
                columns: [
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                        title: 'Nama',
                    },
                    {
                        data: 'foto',
                        name: 'foto',
                        title: 'Foto',
                        render: (data) => {
                            const url = data === null ? '{{ photo() }}' : App.storageUrl(data);
                            return `
                                <span class="avatar avatar-circle">
                                    <img class="avatar-img" src="${url}" alt="Foto">
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        title: 'Jenis Kelamin',
                        render: (data) => data === 'L' ? 'Laki-Laki' : 'Perempuan',
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir',
                        title: 'Tanggal Lahir',
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
                ]
            })
        </script>

        {{-- Handle delete --}}
        <script>
            function handleDelete(id) {
                App.destroy('Supir', (result) => {
                    if (result) {
                        $('#formDeleteSupir').attr('action', App.dashboardUrl(`/supir/${id}`));
                        $('#formDeleteSupir').submit();
                    }
                })
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>
