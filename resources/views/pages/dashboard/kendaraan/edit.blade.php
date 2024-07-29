<x-layouts.dashboard title="Edit Kendaraan">
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

    <form
        id="formEditKendaraan"
        action="{{ route('dashboard.kendaraan.update', ['kendaraan' => $kendaraan->id]) }}"
        method="post"
        enctype="multipart/form-data"
    >
        @csrf @method('patch')

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <lable for="merek" class="col-sm-3 col-form-label form-label">
                                Merek <span class="text-danger">*</span>
                            </lable>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="text"
                                    name="merek"
                                    id="merek"
                                    value="{{ old('merek', $kendaraan->merek) }}"
                                    placeholder="Masukan merek kendaraan..."
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('merek'),
                                    ])
                                >

                                @error('merek')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <lable for="tipe" class="col-sm-3 col-form-label form-label">
                                Tipe <span class="text-danger">*</span>
                            </lable>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="text"
                                    name="tipe"
                                    id="tipe"
                                    value="{{ old('tipe', $kendaraan->tipe) }}"
                                    placeholder="Masukan tipe kendaraan..."
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('tipe'),
                                    ])
                                >

                                @error('tipe')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <lable for="kapasitas" class="col-sm-3 col-form-label form-label">
                                Kapasitas <span class="text-danger">*</span>
                            </lable>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="number"
                                    min="1"
                                    name="kapasitas"
                                    id="kapasitas"
                                    value="{{ old('kapasitas', $kendaraan->kapasitas) }}"
                                    placeholder="Masukan kapasitas kendaraan..."
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('kapasitas'),
                                    ])
                                >

                                @error('kapasitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <lable for="deskripsi" class="col-sm-3 col-form-label form-label">
                                Deskripsi
                            </lable>

                            <div class="col-sm-9">
                                <textarea
                                    name="deskripsi"
                                    id="deskripsi"
                                    placeholder="Masukan deskripsi..."
                                    rows="5"
                                    @class([ 'form-control', 'form-control-light', 'is-invalid' => $errors->has('deskripsi')])
                                >{{ old('deskripsi', $kendaraan->deskripsi) }}</textarea>

                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <lable for="gambar" class="col-sm-3 col-form-label form-label">
                                Gambar
                            </lable>

                            <div class="col-sm-9">
                                <input
                                    type="file"
                                    name="gambar"
                                    id="gambar"
                                    accept=".png,.jpg,.jpeg,.webp"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('gambar'),
                                    ])
                                >
                                
                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                
                                @isset($kendaraan->gambar)
                                    <img
                                        src="{{ storage($kendaraan->gambar) }}"
                                        alt="Kendaraan"
                                        id="imagePreview"
                                        class="img-fluid rounded-2 border border-5 mt-4"
                                    >
                                @else
                                    <img
                                        src="{{ asset('assets/dashboard/images/image_empty.jpg') }}"
                                        alt="Kendaraan"
                                        id="imagePreview"
                                        class="img-fluid rounded-2 border border-5 mt-4"
                                    >
                                @endisset
                            </div>
                        </div>
                    </div>
    
                    <div class="card-footer d-flex justify-content-end">
                        <x-button type="submit" color="success" start-icon="bi-save">
                            Simpan
                        </x-button>
    
                        <x-button type="reset" color="secondary" start-icon="bi-x-lg" class="ms-2">
                            Reset
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-slot:style>
        <style>
            #imagePreview {
                width: 100%;
                height: 250px;
                object-fit: contain;
                object-position: center;
            }
        </style>
    </x-slot:style>
    
    <x-slot:script>

        {{-- Image preview --}}
        <script>
            $('#gambar').change(function (e) { 
                if(this.files.length > 0) {
                    App.imagePreview('#imagePreview', this.files[0]);
                }
            });
        </script>

        {{-- Reset image --}}
        <script>
            $('#formEditKendaraan button[type=reset]').click(function(e) {
                App.imagePreview('#imagePreview', '{{ image($kendaraan->gambar) }}')
            });
        </script>

    </x-slot:script>
</x-layouts.dashboard>