<x-layout.dashboard title="Tambah Harga">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.harga') }}"
            color="white"
            start-icon="bi-chevron-left"
        >
            Kembali
        </x-button>
    </x-slot:header-action>

    <form id="formEditHarga" action="{{ route('dashboard.harga.update', ['harga' => $harga->id]) }}" method="post">
        @csrf @method('patch')

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="kendaraan" class="col-sm-3 col-form-label form-label">
                                Kendaraan <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div class="tom-select-custom @error('kendaraan') is-invalid @enderror">
                                    <select
                                        required
                                        name="kendaraan"
                                        id="kendaraan"
                                        autocomplete="off"
                                        data-hs-tom-select-options='{
                                            "placeholder": "Pilih Kendaraan..."
                                        }'
                                        @class([
                                            'js-select',
                                            'form-select',
                                            'form-control-light',
                                            'is-invalid' => $errors->has('kendaraan'),
                                        ])
                                    >
                                        <option value="">Pilih Kendaraan</option>

                                        @foreach ($kendaraan as $item)
                                            <option value="{{ $item->id }}" @selected(old('kendaraan', $harga->kendaraan_id) == $item->id)>
                                                {{ $item->merek }} - {{ $item->tipe }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('kendaraan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="destinasi" class="col-sm-3 col-form-label form-label">
                                Destinasi <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div class="tom-select-custom @error('destinasi') is-invalid @enderror">
                                    <select
                                        required
                                        name="destinasi"
                                        id="destinasi"
                                        autocomplete="off"
                                        data-hs-tom-select-options='{
                                            "placeholder": "Pilih destinasi..."
                                        }'
                                        @class([
                                            'js-select',
                                            'form-select',
                                            'form-control-light',
                                            'is-invalid' => $errors->has('destinasi'),
                                        ])
                                    >
                                        <option value="">Pilih destinasi</option>

                                        @foreach ($paket as $paketItem)
                                            @foreach ($paketItem->destinasi as $destinasi)
                                                <option value="{{ $destinasi->id }}" @selected(old('destinasi', $harga->destinasi_id) == $destinasi->id)>
                                                    {{ $paketItem->nama }} - {{ $destinasi->wilayah }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                @error('kendaraan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label for="nominal" class="col-sm-3 col-form-label form-label">
                                Nominal Harga <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="number"
                                    name="nominal"
                                    id="nominal"
                                    placeholder="Masukan moninal harga..."
                                    value="{{ old('nominal', $harga->nominal) }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('nominal')
                                    ])
                                >

                                @error('nominal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
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
</x-layout.dashboard>