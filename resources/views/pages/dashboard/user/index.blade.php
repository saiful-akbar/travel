<x-layouts.dashboard title="User">
    <x-slot:header-action>
        <a href="{{ route('dashboard.user.create') }}" id="addUser" class="btn btn-primary">
            <i class="bi-person-plus-fill me-1"></i>
            <span>Tambah User</span>
        </a>
    </x-slot:header-action>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-header-title">Tabel data user</h3>
                </div>

                <div class="card-body">
                    <table id="userDataTable" class="w-100 table table-thead-bordered table-nowrap table-align-middle card-table table-hover"></table>
                </div>
            </div>
        </div>
    </div>

    <x-slot:script>
        <script>
            $(function() {
                const dataTable = $("#userDataTable").DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    language: {
                        search: "",
                        searchPlaceholder: 'Search...',
                        lengthMenu:"_MENU_"
                    },
                    ajax: {
                        url: "{{ route('dashboard.user.dataTable') }}"
                    },
                    columns: [
                        {
                            data: 'email',
                            name: 'email',
                            title: 'Email',
                        },
                        {
                            data: 'nama_lengkap',
                            name: 'nama_lengkap',
                            title: 'Nama',
                        },
                        {
                            data: 'role',
                            name: 'role',
                            title: 'Peran',
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin',
                            title: 'Peran',
                            render: function(data, type) {
                                return data === 'L' ? 'Laki-Laki' : 'Perempuan'
                            }
                        },
                    ]
                });
            })
        </script>
    </x-slot:script>
</x-layouts.dashboard>