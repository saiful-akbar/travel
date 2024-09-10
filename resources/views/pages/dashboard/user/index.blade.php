<x-layout.dashboard title="User">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.user.create') }}" start-icon="bi-person-plus-fill">
            Tambah
        </x-button>
    </x-slot:header-action>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="userTable" class="table table-hover table-thead-bordered table-nowrap table-align-middle"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form delete --}}
    <form id="formDeleteUser" method="post">
        @csrf @method('delete')
    </form>

    <x-slot:script>

        {{-- Datatable --}}
        <script>
            App.dataTable('#userTable', {
                ajax: "{{ route('dashboard.user') }}",
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
                            const url = data === null ? "{{ photo() }}" : App.storageUrl(data);
                            return `
                                <span class="avatar avatar-circle">
                                    <img class="avatar-img" src="${url}" alt="Foto">
                                </span>
                          `;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        title: 'Email',
                    },
                    {
                        data: 'role',
                        name: 'role',
                        title: 'Role',
                        render: (data) => {
                            const color = data === 'admin' ? 'danger' : 'primary';
                            const content = data === 'admin' ? 'Administrator' : 'Member';
                            
                            return `
                                <span class="badge bg-soft-${color} text-${color}">
                                    ${content}
                                </span>
                            `;
                        }
                    },
                    {
                        data: 'aktif',
                        name: 'aktif',
                        title: 'Status',
                        render: (data) => {
                            const color = data ? 'success' : 'danger';
                            const content = data ? 'Aktif' : 'Tidak Aktif';
                            
                            return `
                                <span class="badge bg-soft-${color} text-${color}">
                                    ${content}
                                </span>
                            `;
                        },
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        title: 'Jenis Kelamin',
                        render: (data, type) => data === 'L' ? 'Laki-Laki' : 'Perempuan',
                    },
                    {
                        data: 'telepon',
                        name: 'telepon',
                        title: 'Telepon',
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
            const handleDelete = (id) => {
                App.destroy('User', (result) => {
                    if (result) {
                        $('#formDeleteUser').attr('action', App.dashboardUrl(`/user/${id}`));
                        $('#formDeleteUser').submit();
                    }
                });
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>
