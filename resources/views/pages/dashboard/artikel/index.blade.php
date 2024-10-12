<x-layout.dashboard title="Artikel">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.artikel.create') }}" start-icon="bi-plus-lg">
            Tambah
        </x-button>
    </x-slot:header-action>

    {{-- DataTable --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="artikelTable" class="table table-hover table-thead-bordered table-align-middle w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form delete --}}
    <form id="formDelete" method="post" class="d-none">
        @csrf
        @method('delete')
    </form>

    {{-- Javascript --}}
    <x-slot:script>

        {{-- DataTable --}}
        <script>
            const artikelTable = App.dataTable('#artikelTable', {
                ajax: "{{ route('dashboard.artikel') }}",
                columns: [
                    {
                        data: 'kategori_nama',
                        name: 'kategori.nama',
                        title: 'Kategori',
                    },
                    {
                        data: 'artikel_judul',
                        name: 'artikel.judul',
                        title: 'Judul',
                    },
                    {
                        data: 'artikel_gambar',
                        name: 'artikel.ga,bar',
                        title: 'Gambar',
                        render: (data) => (`
                            <img
                                src="${App.storageUrl(data)}"
                                alt="Gambar"
                                width="100"
                                height="70"
                                class="rounded-2 border border-2"
                                style="object-fit: cover; object-position: center;"
                            />
                        `)
                    },
                    {
                        data: 'artikel_publikasikan',
                        name: 'artikel.publikasikan',
                        title: 'Dipublikasikan',
                        render: (data) => (`
                            <span class="badge bg-soft-${data ? 'success' : 'danger'} text-${data ? 'success' : 'danger'}">
                                ${data ? 'Dipublikasikan' : 'Tidak Dipublikasikan'}
                            </span>
                        `)
                    },
                    {
                        data: 'action',
                        name: 'action',
                        title: 'Aksi',
                        className: 'nowrap'
                    },
                ]
            })
        </script>

        {{-- Handle delete artikel --}}
        <script>
            const handleDelete = (id) => {
                console.log(id);
                App.destroy('Artikel', (deleted) => {
                    if (deleted) {
                        const url = App.dashboardUrl(`/artikel/${id}`)
                        const form = $('#formDelete');

                        form.attr('action', url);
                        form.submit();
                    }
                })
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>