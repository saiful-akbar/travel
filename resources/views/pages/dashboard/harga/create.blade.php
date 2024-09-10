<x-layout.dashboard title="Tambah Harga">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.harga') }}" color="white" start-icon="bi-chevron-left">
            Kembali
        </x-button>
    </x-slot:header-action>

    <form id="formCreateHarga" action="{{ route('dashboard.harga.store') }}" method="post">
        @csrf

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">

                        {{-- Form kendaraan --}}
                        <div class="row mb-4">
                            <label for="kendaraan" class="col-sm-3 col-form-label form-label">
                                Kendaraan <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <select required name="kendaraan" id="kendaraan"
                                    class="form-select form-control-light @error('kendaraan') is-invalid @enderror">
                                    <option disabled selected>Pilih kendaraan...</option>

                                    @foreach ($kendaraan as $item)
                                        <option value="{{ $item->id }}" @selected(old('kendaraan') == $item->id)>
                                            {{ $item->merek }} - {{ $item->tipe }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('kendaraan')
                                    <div class="invalid-feedback">{!! $message !!}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Form paket --}}
                        <div class="row mb-4">
                            <label for="destinasi" class="col-sm-3 col-form-label form-label">
                                Paket <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <select required name="paket" id="paket"
                                    class="form-select form-control-light @error('paket') is-invalid @enderror">
                                    <option disabled selected>Pilih paket...</option>

                                    @foreach ($paket as $item)
                                        <option value="{{ $item->id }}" @selected(old('paket') == $item->id)>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('paket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Form destinasi --}}
                        <div class="row mb-4">
                            <label for="destinasi" class="col-form-label col-sm-3 form-label">
                                Destinasi <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <select disabled required name="destinasi" id="destinasi"
                                    class="form-select form-control-light @error('destinasi') is-invalid @enderror">
                                    <option disabled selected>Pilih destinasi...</option>
                                </select>

                                @error('destinasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Form nominal harga --}}
                        <div class="row">
                            <label for="nominal" class="col-sm-3 col-form-label form-label">
                                Nominal Harga <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input required type="number" name="nominal" id="nominal"
                                    placeholder="Masukan moninal harga..." value="{{ old('nominal') }}"
                                    class="form-control form-control-light @error('nominal') is-invalid @enderror">

                                @error('nominal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <x-button type="submit" start-icon="bi-save">
                            Simpan
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-slot:script>

        {{-- Mengambil data destinasi jika terjadi error --}}
        @if (old('paket'))
            <script>
                const paketId = "{{ old('paket') }}";
                const destinasiId = "{{ old('destinasi') }}";

                $.ajax({
                    type: "get",
                    url: App.dashboardUrl(`/harga/json/paket/${paketId}/destinasi`),
                    dataType: "json",
                    success: function(res) {
                        let option = '<option selected disabled>Pilih destinasi...</option>';

                        option += res.data.map((destinasi) => (`
                            <option value="${destinasi.id}" ${destinasiId === destinasi.id ? 'selected' : ''}>
                                ${destinasi.wilayah}
                            </option>
                        `));

                        $('#destinasi').html(option);
                    },
                    complete: function() {
                        $('#destinasi').removeAttr('disabled');
                    }
                });
            </script>
        @endif

        {{-- Mengambil data destinasi ketika paket dipilih. --}}
        <script>
            $('#paket').change(function(e) {
                e.preventDefault();
                $('#destinasi').attr('disabled', 'disabled');

                $.ajax({
                    type: "get",
                    url: App.dashboardUrl(`/harga/json/paket/${$(this).val()}/destinasi`),
                    dataType: "json",
                    success: function(res) {
                        let option = '<option selected disabled>Pilih destinasi...</option>';

                        option += res.data.map((destinasi) => (`
                            <option value="${destinasi.id}">${destinasi.wilayah}</option>
                        `));

                        $('#destinasi').html(option);
                    },
                    error: function(err) {
                        alert(`Error - ${err.status} ${err.statusText}`)
                    },
                    complete: function() {
                        $('#destinasi').removeAttr('disabled');
                    }
                });
            });
        </script>

    </x-slot:script>
</x-layout.dashboard>
