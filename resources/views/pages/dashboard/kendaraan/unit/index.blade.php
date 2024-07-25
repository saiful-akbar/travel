<x-layouts.dashboard title="Tambah Unit Kendaraan">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.kendaraan') }}"
            color="dark"
            start-icon="bi-chevron-left"
        >
            Kembali
        </x-button>
    </x-slot:header-action>

    <x-slot:header-content>
        <x-button
            type="link"
            href="{{ route('dashboard.kendaraan') }}"
            color="primary"
            start-icon="bi-plus-lg"
            class="me-2"
        >
            Tambah Kendaraan
        </x-button>
    </x-slot:header-content>

    <div class="row mb-5">
        <div class="col-12">
            <form action="{{ route('dashboard.kendaraan.unit.store', ['kendaraan' => $kendaraan->id]) }}" method="post">
                @csrf
                
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Form Unit Kendaraan</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-md-0 mb-4">
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

                            <div class="col-md-6 col-12">
                                <label for="tahun" class="form-label">
                                    Tahun <span class="text-danger">*</span>
                                </label>

                                <input
                                    required
                                    type="year"
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
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <x-button type="submit" color="success" start-icon="bi-save">
                            Simpan
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
                                <th>Waktu Dibuat</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($kendaraan->unitKendaraan as $unit)
                                <tr>
                                    <td>{{ $unit->nomor }}</td>
                                    <td class="text-start">{{ $unit->tahun }}</td>
                                    <td>{{ $unit->created_at }}</td>
                                    <td>
                                        <button
                                            class="btn btn-icon btn-sm btn-danger"
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
                App.destroy('Yakin ingin menghpau unit ini?', function(result) {
                    $('#formDeleteUnit').attr('action', App.dashboardUrl(`/kendaraan/${kendaraanId}/unit/${unitId}`));
                    $('#formDeleteUnit').submit();
                });
            }
        </script>
        
    </x-slot:script>
</x-layouts.dashboard>