<x-layout.dashboard title="Edit Paket">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.paket') }}"
            color="white"
            start-icon="bi-chevron-left"
            role="botton"
        >
            Kembali
        </x-button>
    </x-slot:header-action>

    <form action="{{ route('dashboard.paket.update', ['paket' => $paket->id]) }}" method="post" id="formEditPaket">
        @csrf @method('patch')

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="nama" class="col-sm-3 col-form-label form-label">
                                Nama Paket <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="text"
                                    name="nama"
                                    id="nama"
                                    placeholder="Masukan nama paket..."
                                    value="{{ old('nama', $paket->nama) }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('nama')
                                    ])
                                >

                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label for="deskripsi" class="col-sm-3 col-form-label form-label">
                                Deskripsi
                            </label>

                            <div class="col-sm-9">
                                <textarea
                                    name="deskripsi"
                                    id="deskripsi"
                                    rows="5"
                                    placeholder="Masukan deskripsi paket..."
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('deskripsi'),
                                    ])
                                >{{ old('deskripsi', $paket->deskripsi) }}</textarea>

                                @error('deskripsi')
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