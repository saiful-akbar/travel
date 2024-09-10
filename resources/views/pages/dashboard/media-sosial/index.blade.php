<x-layout.dashboard title="Media Sosial">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.mediaSosial.create') }}" start-icon="bi-plus-lg">
            Tambah
        </x-button>
    </x-slot:header-action>

    {{-- DataTable --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="mediaSosialTable" class="table table-hover table-thead-bordered table-align-middle table-nowrap w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form delete --}}
    <form id="formDeleteMediaSosial" method="post" class="d-none">
        @csrf @method('delete')
    </form>
    
    <x-slot:script>

        {{-- DataTable --}}
        <script>
            App.dataTable('#mediaSosialTable', {
                ajax: "{{ route('dashboard.mediaSosial') }}",
                columns: [
                    {
                        data: 'nama',
                        name: 'nama',
                        title: 'Nama',
                        render: (data, type, row) => {
                            if (row.icon !== null) {
                                return `
                                    <i class="${row.icon} me-1"></i>
                                    <span>${data}</span>
                                `;
                            }

                            return data;
                        }
                    },
                    {
                        data: 'url',
                        name: 'url',
                        title: 'Url',
                        render: (data) => {
                            return `
                                <a href="${data}" target="_blank" rel="noopener noreferrer">
                                    <span class="d-block h5 text-primary mb-0">
                                        ${data}
                                    </span>
                                </a>
                            `;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        title: 'Dibuat'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        title: 'Diubah'
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
                App.destroy('Media Sosial', (deleted) => {
                    if(deleted) {
                        const form = $('#formDeleteMediaSosial');

                        form.attr('action', App.dashboardUrl(`/media-sosial/${id}`));
                        form.submit();
                    }
                })
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>
