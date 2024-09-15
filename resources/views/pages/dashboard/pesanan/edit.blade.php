<x-layout.dashboard title="Edit Pesanan">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.pesanan') }}" color="white" start-icon="bi-chevron-left">
            Kembali
        </x-button>
    </x-slot:header-action>

    <x-slot:header-content>
        <h3 class="text-secondary">#{{ $pesanan->id }}</h3>
    </x-slot:header-content>

    <form method="post" id="formEditPesanan" class="mb-10"
        action="{{ route('dashboard.pesanan.update', ['pesanan' => $pesanan->id]) }}">
        @csrf @method('patch')

        {{-- Form data pesanan --}}
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Data Pesanan</h4>
                    </div>

                    <div class="card-body">
                        {{-- Status --}}
                        <div class="row mb-4">
                            <label for="status_pesanan" class="form-label col-form-label col-sm-4">
                                Status Pesanan <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-8">
                                <select name="status_pesanan" id="status_pesanan"
                                    class="form-select form-select-light @error('status_pesanan') is-invalid @enderror">
                                    <option value="Menunggu Pembayaran" @selected($pesanan->status == 'Menunggu Pembayaran')>Menunggu Pembayaran</option>
                                    <option value="Dibayar" @selected($pesanan->status == 'Dibayar')>Dibayar</option>
                                    <option value="Dikonfirmasi" @selected($pesanan->status == 'Dikonfirmasi')>Dikonfirmasi</option>
                                    <option value="Selesai" @selected($pesanan->status == 'Selesai')>Selesai</option>
                                    <option value="Dibatalkan" @selected($pesanan->status == 'Dibatalkan')>Dibatalkan</option>
                                </select>

                                @error('status_pesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Tanggal keberangkatan --}}
                        <div class="row mb-4">
                            <label for="tanggal_keberangkatan_pesanan" class="form-label col-form-label col-sm-4">
                                Tgl Keberangkatan <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-8">
                                <input type="date" name="tanggal_keberangkatan_pesanan" id="tanggal_keberangkatan_pesanan"
                                    value="{{ old('tanggal_keberangkatan_pesanan', $pesanan->tanggal_keberangkatan) }}"
                                    class="form-control form-control-light @error('tanggal_keberangkatan_pesanan') is-invalid @enderror"
                                    placeholder="Tanggal keberangkatan..." required>
    
                                @error('tanggal_keberangkatan_pesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tanggal kepulangan --}}
                        <div class="row mb-4">
                            <label for="tanggal_kepulangan_pesanan" class="form-label col-form-label col-sm-4">
                                Tgl Kepulangan <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-8">
                                <input type="date" name="tanggal_kepulangan_pesanan" id="tanggal_kepulangan_pesanan"
                                    value="{{ old('tanggal_kepulangan_pesanan', $pesanan->tanggal_kepulangan) }}"
                                    class="form-control form-control-light @error('tanggal_kepulangan_pesanan') is-invalid @enderror"
                                    placeholder="Tanggal keberangkatan..." required>
    
                                @error('tanggal_kepulangan_pesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat tujuan --}}
                        <div class="row mb-4">
                            <label for="alamat_tujuan_pesanan" class="form-label col-form-label col-sm-4">
                                Alamat Tujuan <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-8">
                                <textarea name="alamat_tujuan_pesanan" id="alamat_tujuan_pesanan" rows="3"
                                    class="form-control form-control-light @error('alamat_tujuan_pesanan') is-invalid @enderror"
                                    placeholder="Masukan alamat tujuan..."
                                    required>{{ old('alamat_tujuan_pesanan', $pesanan->alamat_tujuan) }}</textarea>

                                @error('alamat_tujuan_pesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Alamat penjemputan --}}
                        <div class="row mb-4">
                            <label for="alamat_penjemputan_pesanan" class="form-label col-form-label col-sm-4">
                                Alamat Penjemputan <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-8">
                                <textarea name="alamat_penjemputan_pesanan" id="alamat_penjemputan_pesanan" rows="3"
                                    class="form-control form-control-light @error('alamat_penjemputan_pesanan') is-invalid @enderror"
                                    placeholder="Masukan alamat penjemputan..."
                                    required>{{ old('alamat_penjemputan_pesanan', $pesanan->alamat_penjemputan) }}</textarea>

                                @error('alamat_penjemputan_pesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Catatan --}}
                        <div class="row">
                            <label for="catatan_pesanan" class="form-label col-form-label col-sm-4">
                                Catatan
                            </label>

                            <div class="col-sm-8">
                                <textarea name="catatan_pesanan" id="catatan_pesanan" rows="3"
                                    class="form-control form-control-light @error('catatan_pesanan') is-invalid @enderror"
                                    placeholder="Masukan catatan...">{{ old('catatan_pesanan', $pesanan->catatan) }}</textarea>

                                @error('catatan_pesanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form data tagihan --}}
        <div class="row justify-content-center mt-7">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Data Tagihan</h4>
                    </div>

                    <div class="card-body">
                        {{-- Jumlah tagihan --}}
                        <div class="row mb-4">
                            <lable for="jumlah_tagihan" class="form-label col-form-label col-sm-4">
                                Jumlah Tagihan <span class="text-danger">*</span>
                            </lable>

                            <div class="col-sm-8">
                                <input type="number" name="jumlah_tagihan" id="jumlah_tagihan"
                                    class="form-control form-control-light @error('jumlah_tagihan') is-invalid @enderror"
                                    value="{{ old('jumlah_tagihan', $pesanan->tagihan->jumlah) }}"
                                    palceholder="Masukan jumlah tagihan...">
                                
                                @error('record')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tanggal pembayaran --}}
                        <div class="row mb-4">
                            <label for="tanggal_pembayaran_tagihan" class="form-label col-form-label col-sm-4">
                                Tanggal Pembayaran
                            </label>

                            <div class="col-sm-8">
                                <input type="datetime-local" name="tanggal_pembayaran_tagihan" id="tanggal_pembayaran_tagihan"
                                    placeholder="Masukan tanggal pembayaran..."
                                    value="{{ old('tanggal_pembayaran_tagihan', $pesanan->tagihan->tanggal_pembayaran) }}"
                                    class="form-control form-control-light @error('tanggal_pembayaran_tagihan') is-invalid @enderror">

                                @error('tanggal_pembayaran_tagihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Catatan tagihan --}}
                        <div class="row mb-4">
                            <label for="catatan_tagihan" class="form-label col-form-label col-sm-4">
                                Catatan
                            </label>

                            <div class="col-sm-8">
                                <textarea name="catatan_tagihan" id="catatan_tagihan"
                                    placeholder="Masukan catatan..." rows="3"
                                    class="form-control form-control-light @error('catatan_tagihan') is-invalid @enderror"
                                >{{ old('catatan_tagihan', $pesanan->tagihan->catatan) }}</textarea>

                                @error('catatan_tagihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Bukti pembayaran --}}
                        <div class="row">
                            <label for="bukti_pembayaran_tagihan" class="form-label col-form-label col-sm-4">
                                Bukti Pembayaran
                            </label>

                            <div class="col-sm-8">
                                <input type="file" name="bukti_pembayaran_tagihan" id="bukti_pembayaran_tagihan"
                                    placeholder="Unggah bukti pembayaran..."
                                    class="form-control form-control-light @error('bukti_pembayaran_tagihan') is-invalid @enderror"
                                    accept=".jpeg,.jpg,.png,.pdf,.docx">

                                @error('bukti_pembayaran_tagihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <span class="form-text">
                                        Biarkan bukti pembayaran tetap kosong jika anda tidak ingin merubah bikti pembayaran yang sudah ada.
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Button submit --}}
        <div class="position-fixed start-50 bottom-0 translate-middle-x w-100 zi-99 mb-3 zi-999" style="max-width: 30rem;">
            <div class="card card-sm bg-dark border-dark mx-2">
                <div class="card-body">
                    <div class="d-flex justify-content-center justify-content-center">
                        <button type="reset" class="btn btn-ghost-secondary btn-sm me-2">
                            <i class="bi-x-lg me-1"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi-save me-1"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout.dashboard>