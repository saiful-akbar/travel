<x-layout.dashboard title="Kategori Artikel">
    <x-slot:header-action>
        <x-button id="create" start-icon="bi-plus-lg">
            Tambah
        </x-button>
    </x-slot:header-action>

    {{-- DataTable --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="kategoriTable" class="table table-hover table-thead-bordered table-align-middle table-nowrap w-100"></table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal form --}}
    <form id="formModal" autocomplete="off">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="post">

        <div class="modal fade" tabindex="-1" id="modalForm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <label for="nama" class="form-label">
                            Nama Kategori <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            placeholder="Masukan nama kategori..."
                            class="form-control form-control-light"
                            required
                        />

                        <div id="error" class="invalid-feedback"></div>
                    </div>

                    <div class="modal-footer">
                        <x-button type="button" color="secondary" data-bs-dismiss="modal">Tutup</x-button>
                        <x-button type="submit" color="primary">Simpan</x-button>
                    </div>
                </div>
            </div>
          </div>
    </form>

    {{-- Form delete --}}
    <form id="formDelete" method="post" class="d-none">
        @csrf @method('delete')
    </form>

    {{-- Javascript --}}
    <x-slot:script>

        {{-- DataTable --}}
        <script>
            const dataTable = App.dataTable('#kategoriTable', {
                ajax: "{{ route('dashboard.kategori') }}",
                columns: [
                    {
                        data: 'nama',
                        name: 'nama',
                        title: 'Nama Kategori'
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
                    },
                ],
            })
        </script>

        {{-- modal form --}}
        <script>
            const modalForm = new bootstrap.Modal($('#modalForm'), {
                backdrop: 'static',
            });
        </script>

        {{-- script tambah kategori --}}
        <script>
            $('#create').click(function (e) { 
                e.preventDefault();

                // Buka modal form
                modalForm.show();

                // bersihkan form dari value dan error
                $('#nama').val('');
                $('#nama').removeClass('is-invalid');

                // Ubah title modal
                $('#modalFormTitle').text('Tambah Kategori');

                // masuk url untuk action form
                $('#formModal').attr('action', "{{ route('dashboard.kategori.store') }}");

                // ubah method menjadi post
                $("#formModal input[name='_method']").val('POST');
            });
        </script>

        {{-- script untuk edit kategori --}}
        <script>
            function handleEdit(kategoriId) {
                // Buka modal
                modalForm.show();

                // ubah title modal
                $('#modalFormTitle').text('Edit Kategori');

                // kosongkan dan disabled input form
                $('#nama').val('');
                $('#nama').attr('disabled', 'disabled');

                // serta bersihkan pesan error jika ada.
                $('#nama').removeClass('is-invalid');
                
                // update attribute action dan method pada form
                $('#formModal').attr('action', App.dashboardUrl(`/kategori/${kategoriId}`));
                $('#formModal input[name="_method"]').attr('value', 'PATCH');
                
                // request data kategori
                $.ajax({
                    type: "GET",
                    url: App.dashboardUrl(`/kategori/${kategoriId}/edit`),
                    dataType: "json",
                    success: function ({ data }) {
                        // kemablikan form input yang terdisable
                        $('#nama').removeAttr('disabled');

                        // dan isikan value input nama
                        $('#nama').val(data.nama);
                    },
                    error: function (error) {
                        alert(`Error ${error.status} - ${error.statusText}`);
                    }
                });
            }
        </script>

        {{-- script untuk menangani ketika modal form di-submit --}}
        <script>
            $('#formModal').submit(function (e) { 
                e.preventDefault();
                
                // ambil atribut yang dibutuhkan
                const url = $(this).attr('action');
                const method = $('#formModal input[name="_method"]').val();
                const csrf = $('meta[name="csrf-token"]').attr('content');
                const nama = $('#nama').val();

                // disable button pada form
                $('#formModal button').attr('disabled', 'disabled');
                $('#formModal input').attr('disabled', 'disabled');
                $('#formModal button[type="submit"]').text('Menyimpan...');

                $.ajax({
                    url,
                    type: method,
                    dataType: "json",
                    data: {
                        nama,
                        _method: method,
                        _token: csrf,
                    },
                    success: function (response) {
                        // reload datatable dan tutup modal
                        dataTable.ajax.reload();
                        modalForm.hide();
                    },
                    error: function (error) {
                        // tampilkan pesan error
                        $('#nama').addClass('is-invalid');
                        $('#error').text(error.responseJSON.errors.nama.join(', '));
                    },
                    complete: function () {
                        // kembalikan button dan form yang terdisable
                        $('#formModal button').removeAttr('disabled');
                        $('#formModal input').removeAttr('disabled');
                        
                        // kembalikan text pada tombol submit
                        $('#formModal button[type="submit"]').text('Simpan');
                    },
                });
            });
        </script>

        {{-- script untuk delete kategori --}}
        <script>
            function handleDelete(kategoriId) {
                App.destroy('Kategori', function (deleted) {
                    if (deleted) {
                        const url = App.dashboardUrl(`/kategori/${kategoriId}`);
                        const formDelete = $('#formDelete');

                        // isikan attribute action pada form delete
                        formDelete.attr('action', url);

                        // Tampilkan preloader
                        $('#preloader').fadeIn();

                        // submit form delete
                        formDelete.submit();
                    }
                })
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>