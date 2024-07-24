<x-layouts.dashboard title="User">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.user.create') }}"
            color="primary"
            start-icon="bi-person-plus-fill"
        >
            Tambah User
        </x-button>
    </x-slot:header-action>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="userTable"
                        class="table table-hover table-thead-bordered table-nowrap table-align-middle w-100">
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form id="formDeleteUser" method="post">
        @csrf @method('delete')
    </form>

    <x-slot:script>
        <script>
            $("#userTable").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('dashboard.user') }}",
                language: {
                    search: "",
                    searchPlaceholder: 'Search...',
                    lengthMenu: "_MENU_"
                },
                order: {
                    name: 'nama_lengkap',
                    dir: 'asc'
                },
                columns: [
                    {
                        data: 'foto',
                        name: 'foto',
                        title: 'Foto',
                        render: (data) => {
                            const baseUrl = $('meta[name=base-url]').attr('content');
                            const url = data === null ? "{{ avatar() }}" : App.storageUrl(data);

                            return `
                                <span class="avatar avatar-circle avatar-sm">
                                    <img class="avatar-img" src="${url}" alt="Foto">
                                </span>
                          `;
                        }
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                        title: 'Nama',
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
            });
        </script>

        <script>
            const handleDelete = (id) => {
                App.destroy('Yakin ingin menghapus user ini?', (result) => {
                    if (result) {
                        $('#formDeleteUser').attr('action', App.dashboardUrl(`/user/${id}`));
                        $('#formDeleteUser').submit();
                    }
                });
            }
        </script>
    </x-slot:script>
</x-layouts.dashboard>
