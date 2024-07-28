
<x-layouts.dashboard title="Edit Destinasi">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.destinasi') }}"
            role="button"
            title="Kembali"
            start-icon="bi-chevron-left"
        >
            Kembali
        </x-button>
    </x-slot:header-action>

    <form
        action="{{ route('dashboard.destinasi.update', ['destinasi' => $destinasi->id]) }}"
        method="post"
        id="formEditDestinasi"
    >
        @csrf
        @method('patch')

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Form data destinasi</h4>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="paketId" class="col-sm-3 col-form-label form-label">
                                Paket <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div class="tom-select-custom @error('paket_id') is-invalid @enderror">
                                    <select
                                        name="paket_id"
                                        id="paketId"
                                        autocomplete="off"
                                        data-hs-tom-select-options='{"placeholder": "Pilih Paket...", "hideSearch": true}'
                                        @class([
                                            'js-select',
                                            'form-select',
                                            'form-select-light',
                                            'is-invalid' => $errors->has('paket_id')
                                        ])
                                    >
                                        <option value="" selected>Pilih Paket...</option>

                                        @foreach ($paket as $data)
                                            <option value="{{ $data->id }}" @selected(old('paket_id', $destinasi->paket_id) == $data->id)>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('paket_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="wilayah" class="col-sm-3 col-form-label form-label">
                                Wilayah <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <textarea
                                    required
                                    name="wilayah"
                                    id="wilayah"
                                    rows="3"
                                    placeholder="Masukan wilayah..."
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('wilayah'),
                                    ])
                                >{{ old('wilayah', $destinasi->wilayah) }}</textarea>

                                @error('wilayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="jumlahHari" class="col-sm-3 col-form-label form-label">
                                Jumlah Hari <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="number"
                                    min="1"
                                    name="jumlah_hari"
                                    id="jumlahHari"
                                    placeholder="Masukan jumlah hari..."
                                    value="{{ old('jumlah_hari', $destinasi->jumlah_hari) }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('jumlah_hari'),
                                    ])
                                >

                                @error('jumlah_hari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label-form-label">
                                Status <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <div class="input-group input-group-sm-vertical @error('status') is-invalid @enderror">
                                    <label for="aktif" class="form-control form-control-light @error('status') is-invalid @enderror">
                                        <span class="form-check">
                                            <input
                                                type="radio"
                                                name="status"
                                                id="aktif"
                                                value="1"
                                                class="form-check-input"
                                                @checked(old('status', $destinasi->aktif) == '1')
                                            >

                                            <span class="form-check-label">Aktif</span>
                                        </span>
                                    </label>

                                    <label for="tidakAktif" class="form-control form-control-light @error('status') is-invalid @enderror">
                                        <span class="form-check">
                                            <input
                                                type="radio"
                                                name="status"
                                                id="tidakAktif"
                                                value="0"
                                                class="form-check-input"
                                                @checked(old('status', $destinasi->aktif) == '0')
                                            >

                                            <span class="form-check-label">Tidak Aktif</span>
                                        </span>
                                    </label>
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
                        <x-button type="submit" color="success" start-icon="bi-save">Simpan</x-button>
                        <x-button type="reset" color="secondary" start-icon="bi-x-lg" class="ms-2">Reset</x-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layouts.dashboard>