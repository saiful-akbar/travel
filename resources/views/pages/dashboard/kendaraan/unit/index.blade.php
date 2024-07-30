<x-layout.dashboard title="Tambah Unit Kendaraan">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.kendaraan') }}"
            color="white"
            start-icon="bi-chevron-left"
        >
            Kembali
        </x-button>
    </x-slot:header-action>

    <x-slot:header-content>
        <x-button
            type="link"
            href="{{ route('dashboard.kendaraan.create') }}"
            color="primary"
            start-icon="bi-plus-lg"
            class="me-2"
        >
            Tambah Kendaraan
        </x-button>
    </x-slot:header-content>

    {{-- Form tambah --}}
    <div class="row mb-5">
        <div class="col-12">
            <form
                id="formCreateUnit"
                action="{{ route('dashboard.kendaraan.unit.store', ['kendaraan' => $kendaraan->id]) }}"
                method="post"
            >
                @csrf
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mb-md-0 mb-4">
                                <label for="nomor" class="form-label">
                                    No. Kendaraan <span class="text-danger">*</span>
                                </label>

                                <input
                                    required
                                    type="text"
                                    name="nomor"
                                    id="nomor"
                                    placeholder="Masukan nomor kendaraan..."
                                    value="{{ old('nomor') }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('nomor'),
                                    ])
                                >

                                @error('nomor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12 mb-md-0 mb-4">
                                <label for="tahun" class="form-label">
                                    Tahun <span class="text-danger">*</span>
                                </label>

                                <input
                                    required
                                    type="number"
                                    max="{{ date('Y') }}"
                                    min="{{ date('Y') - 20 }}"
                                    name="tahun"
                                    id="tahun"
                                    placeholder="Masukan tahun kendaraan..."
                                    value="{{ old('tahun') }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('tahun'),
                                    ])
                                >

                                @error('tahun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-12">
                                <label for="status" class="form-label">
                                    Status <span class="text-danger">*</span>
                                </label>

                                <div class="tom-select-custom @error('status') is-invalid @enderror is-invalid">
                                    <select
                                        required
                                        name="status"
                                        id="status"
                                        autocomplete="off"
                                        data-hs-tom-select-options='{
                                            "placeholder": "Pilih Status...",
                                            "hideSearch": true
                                        }'
                                        @class([
                                            "js-select",
                                            "form-select",
                                            "form-select-light",
                                            "is-invalid" => $errors->has('status'),
                                        ])
                                    >
                                        <option value="">
                                            Pilih Status...
                                        </option>
                                        <option value="tersedia" @selected(old('status') == 'tersedia')>
                                            Tersedia
                                        </option>
                                        <option value="tidak_tersedia" @selected(old('status') == 'tidak_tersedia')>
                                            Tidak Tersedia
                                        </option>
                                        <option value="dalam_perbaikan" @selected(old('status') == 'dalam_perbaikan')>
                                            Dalam Perbaikan
                                        </option>
                                    </select>
                                  </div>

                                  @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                  @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <x-button type="submit" start-icon="bi-plus-lg">
                            Tambah Unit
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Table daftar kendaraan --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="unitTable" class="table table-hover table-align-middle table-thead-bordered table-nowrap w-100">
                        <thead>
                            <tr>
                                <th>No. Kendaraan</th>
                                <th class="text-start">Tahun</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Diubah</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($kendaraan->unitKendaraan as $unit)
                                <tr>
                                    <td>{{ $unit->nomor }}</td>
                                    <td class="text-start">{{ $unit->tahun }}</td>
                                    <td>
                                        <span
                                            @class([
                                                'badge',
                                                'bg-soft-success' => $unit->status === 'tersedia',
                                                'text-success' => $unit->status === 'tersedia',
                                                'bg-soft-danger' => $unit->status === 'tidak_tersedia',
                                                'text-danger' => $unit->status === 'tidak_tersedia',
                                                'bg-soft-warning' => $unit->status === 'dalam_perbaikan',
                                                'text-warning' => $unit->status === 'dalam_perbaikan',
                                            ])
                                        >
                                            {{ ucwords(str_replace('_', ' ', $unit->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $unit->created_at }}</td>
                                    <td>{{ $unit->updated_at }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-icon btn-sm btn-light rounded-pill"
                                            title="Edit"
                                            onclick="handleEdit({{ $unit }})"
                                        >
                                            <i class="bi-pencil"></i>
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-icon btn-sm btn-light rounded-pill"
                                            title="Hapus"
                                            onclick="handleDelete('{{ $kendaraan->id }}', '{{ $unit->id }}')"
                                        >
                                            <i class="bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal form edit --}}
    <form id="formEditUnit" method="post">
        @csrf @method('patch')

        <div
            class="modal fade"
            id="modalEdit"
            data-bs-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalEditLable"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header py-4 border-bottom">
                        <h4 class="modal-title" id="modalEditLable">Edit Unit</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="nomor" class="form-label">
                                    No. Kendaraan <span class="text-danger">*</span>
                                </label>

                                <input
                                    required
                                    type="text"
                                    name="nomor_edit"
                                    id="nomorEdit"
                                    placeholder="Masukan nomor kendaraan..."
                                    class="form-control form-control-light"
                                >

                                @error('nomor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="tahun" class="form-label">
                                    Tahun <span class="text-danger">*</span>
                                </label>

                                <input
                                    required
                                    type="number"
                                    max="{{ date('Y') }}"
                                    min="{{ date('Y') - 20 }}"
                                    name="tahun_edit"
                                    id="tahunEdit"
                                    placeholder="Masukan tahun kendaraan..."
                                    class="form-control form-control-light"
                                >

                                @error('tahun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="status" class="form-label">
                                    Status <span class="text-danger">*</span>
                                </label>
                                
                                <select
                                    required
                                    name="status_edit"
                                    id="statusEdit"
                                    autocomplete="off"
                                    class="form-select form-select-light"
                                >
                                    <option value="tersedia">Tersedia</option>
                                    <option value="tidak_tersedia">Tidak Tersedia</option>
                                    <option value="dalam_perbaikan">Dalam Perbaikan</option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <x-button type="button" color="white" start-icon="bi-x-lg" data-bs-dismiss="modal">
                            Batal
                        </x-button>
    
                        <x-button type="submit" color="primary" start-icon="bi-save" autofocus>
                            Simpan
                        </x-button>
                    </div>
                </div>
            </div>
          </div>
    </form>

    {{-- Form delete --}}
    <form action="#" method="post" id="formDeleteUnit" class="d-none">
        @csrf @method('delete')
    </form>

    <x-slot:script>

        {{-- datatable --}}
        <script>
            $('#unitTable').DataTable({
                responsive: true,
                language: {
                    search: "",
                    searchPlaceholder: 'Search...',
                    lengthMenu: "_MENU_"
                },
            });
        </script>

        {{-- handle delete --}}
        <script>
            function handleDelete(kendaraanId, unitId) {
                App.destroy('Unit', function(deleted) {
                    if(deleted) {
                        $('#formDeleteUnit').attr('action', App.dashboardUrl(`/kendaraan/${kendaraanId}/unit/${unitId}`));
                        $('#formDeleteUnit').submit();
                    }
                });
            }
        </script>

        {{-- Handle edit --}}
        <script>
            function handleEdit(unit) { 
                new bootstrap.Modal($('#modalEdit'), {}).show();

                $('#nomorEdit').val(unit.nomor);
                $('#tahunEdit').val(unit.tahun);
                $('#statusEdit').val(unit.status);


                const form = $('#formEditUnit');
                const idKendaraan = '{{ $kendaraan->id }}';
                const url = App.dashboardUrl(`/kendaraan/${idKendaraan}/unit/${unit.id}`);

                form.attr('action', url);
            }
        </script>

    </x-slot:script>
</x-layout.dashboard>