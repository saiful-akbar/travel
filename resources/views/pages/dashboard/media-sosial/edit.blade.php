<x-layout.dashboard title="Tambah Media Sosial">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.mediaSosial') }}"
            color="white"
            start-icon="bi-chevron-left"
        >
            Kembali
        </x-button>
    </x-slot:header-action>

    <form
        id="formEditMediaSosial"
        action="{{ route('dashboard.mediaSosial.update', ['mediaSosial' => $mediaSosial->id]) }}"
        method="post"
    >
        @csrf
        @method('patch')

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <label for="nama" class="col-sm-3 col-form-label form-label">
                                Nama Media Sosial <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="text"
                                    name="nama"
                                    id="nama"
                                    placeholder="Masukan nama media sosial..."
                                    value="{{ old('nama', $mediaSosial->nama) }}"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('nama'),
                                    ])
                                >

                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="url" class="col-sm-3 col-form-label form-label">
                                Url <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <input
                                    required
                                    type="url"
                                    name="url"
                                    id="url"
                                    placeholder="https://www.example.com"
                                    value="{{ old('url', $mediaSosial->url) }}"
                                    pattern="https://.*"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('url'),
                                    ])
                                >

                                @error('url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label for="icon" class="col-sm-3 col-form-label form-label">
                                Icon
                            </label>

                            <div class="col-sm-9">
                                <div class="tom-select-custom @error('icon') is-invalid @enderror">
                                    <select
                                        name="icon"
                                        id="icon"
                                        autocomplete="off"
                                        data-hs-tom-select-options='{"placeholder": "Pilih Icon..."}'
                                        @class([
                                            "js-select",
                                            "form-select",
                                            "form-select-light",
                                            "is-invalid" => $errors->has('icon'),
                                        ])
                                    >
                                        <option value="">Pilih Icon</option>

                                        @foreach ($icons as $icon)
                                            <option
                                                @selected(old('icon', $mediaSosial->icon) == $icon)
                                                value="{{ $icon }}"
                                                data-option-template='
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <i class="{{ $icon }}"></i>
                                                        </div>
                                                        
                                                        <div class="flex-grow-1 ms-2">
                                                            <span class="d-block">{{ $icon }}</span>
                                                        </div>
                                                    </div>
                                                '
                                            >
                                                {{ $icon }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <x-button type="submit" start-icon="bi-save">Simpan</x-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout.dashboard>