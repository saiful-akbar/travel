<x-layout.dashboard title="Artikel">
    <x-slot:header-action>
        <x-button
            type="link"
            href="{{ route('dashboard.artikel')}}"
            color="white"
            start-icon="bi-chevron-left"
        >
            Kembali
        </x-button>
    </x-slot:header-action>

    {{-- DataTable --}}
    <form id="formCreateArtikel" action="{{ route('dashboard.artikel.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <input type="hidden" name="konten" id="konten">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-body">
    
                        {{-- Form kategori --}}
                        <div class="row mb-4">
                            <label for="kategori" class="form-label col-form-label col-lg-3 col-12">
                                Kategori <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-lg-9 col-12">
                                <select
                                    required
                                    name="kategori"
                                    id="kategori"
                                    @class([
                                        'form-select',
                                        'form-select-light',
                                        'is-invalid' => $errors->has('kategori')
                                    ])
                                >
                                    <option value="" disabled selected>Pilih Kategori</option>
    
                                    @foreach ($kategori as $kategoriItem)
                                        <option value="{{ $kategoriItem->id}}" @selected(old('kategori') == $kategoriItem->id)>
                                            {{ $kategoriItem->nama}}
                                        </option>
                                    @endforeach
                                </select>
    
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                        </div>
    
                        {{-- Form judul --}}
                        <div class="row mb-4">
                            <label for="judul" class="form-label col-form-label col-lg-3 col-12">
                                Judul <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-lg-9 col-12">
                                <input
                                    required
                                    type="text"
                                    name="judul"
                                    id="judul"
                                    value="{{ old('judul')}}"
                                    placeholder="Masukan judul artikel..."
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('judul'),
                                    ])
                                />
    
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                        </div>
    
                        {{-- Form gambar --}}
                        <div class="row mb-4">
                            <label for="gambar" class="form-label col-form-label col-lg-3 col-12">
                                Gambar <span class="text-danger">*</span>
                            </label>
    
                            <div class="col-lg-9 col-12">
                                <input
                                    required
                                    type="file"
                                    name="gambar"
                                    id="gambar"
                                    value="{{ old('gambar')}}"
                                    accept=".jpeg,.jpg,.png,.webp"
                                    @class([
                                        'form-control',
                                        'form-control-light',
                                        'is-invalid' => $errors->has('gambar'),
                                    ])
                                />
    
                                <span class="form-text">Gambar ini akan ditampilkan pada judul artikel</span>
    
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                        </div>
    
                        {{-- Form publikasikan --}}
                        <div class="row mb-4">
                            <label for="publikasikan" class="form-label col-form-label col-lg-3 col-12">
                                Publikasikan
                            </label>
    
                            <div class="col-lg-9 col-12">
                                <div
                                    @class([
                                        "input-group",
                                        "input-group-sm-vertical",
                                        "is-invalid" => $errors->has('publikasikan'),
                                        "is-invalid",
                                    ])
                                >
                                    <label
                                        for="ya"
                                        @class([
                                            "form-control",
                                            "form-control-light",
                                            "is-invalid" => $errors->has('publikasikan'),
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                type="radio"
                                                name="publikasikan"
                                                id="ya"
                                                value="1"
                                                @checked(old('publikasikan', 1) == '1')
                                                @class([
                                                    "form-check-input",
                                                    "is-invalid" => $errors->has('publikasikan'),
                                                ])
                                            />
                                            
                                            <span class="form-check-label">Ya</span>
                                        </span>
                                    </label>
                                    
                                    <label
                                        for="tidak"
                                        @class([
                                            "form-control",
                                            "form-control-light",
                                            "is-invalid" => $errors->has('publikasikan'),
                                        ])
                                    >
                                        <span class="form-check">
                                            <input
                                                type="radio"
                                                name="publikasikan"
                                                id="tidak"
                                                value="0"
                                                @checked(old('publikasikan', 1) == '0')
                                                @class([
                                                    "form-check-input",
                                                    "is-invalid" => $errors->has('publikasikan'),
                                                ])
                                            />
                                            
                                            <span class="form-check-label">Tidak</span>
                                        </span>
                                    </label>
                                </div>
    
                                @error('publikasikan')
                                    <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mb-10">
            <div class="col-12 mb-3 mb-md-0">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Konten</h4>
                    </div>
                    
                    <div class="card-body">
                        <div class="quill-custom">
                            <div id="editor" style="min-height: 20rem;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3 zi-999" style="max-width: 30rem;">
            <div class="card card-sm bg-dark border-dark mx-2">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi-save me-1"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Javascript --}}
    <x-slot:script>
        <script>
            $('.ql-picker-options').addClass('bg-white');
            const toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                ['link', 'image', 'video', 'formula'],
                ['clean'],
                [{'list': 'ordered'}, {'list': 'bullet'}, {'list': 'check'}],
                [{'script': 'sub'}, {'script': 'super'}],
                [{'indent': '-1'}, {'indent': '+1'}],
                [{'direction': 'rtl'}],
                [{'color': []}, {'background': []}],
                [{'align': []}],
                [{'size': ['small', false, 'large', 'huge']}],
                [{'header': [1, 2, 3, 4, 5, 6, false]}],
                [{'font': []}],
            ];

            // Initialize Quill editor
            const quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Masukan konten artikel...',
                modules: {
                    toolbar: toolbarOptions
                }
            });

            // Saat formulir dikirimkan, perbarui input konten dengan konten HTML
            document.getElementById('formCreateArtikel').onsubmit = function() {
                const content = document.getElementById('konten');
                content.value = quill.root.innerHTML;
            };
        </script>

        {{-- Mengisikan kembali isi konten jika ada form yang salah --}}
        @if (old('konten'))
            <script>
                quill.pasteHTML("{!! old('konten') !!}");
            </script>
        @endif
    </x-slot:script>
</x-layout.dashboard>