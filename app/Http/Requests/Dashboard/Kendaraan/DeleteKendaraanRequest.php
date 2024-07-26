<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use App\Models\Pesanan;
use App\Http\Requests\DeleteRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class DeleteKendaraanRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus data kendaraan dari database.
     *
     * @return integer
     */
    public function destroy(): int
    {
        /**
         * Hitung jumlah pesanan yang dimiliki
         * oleh kendaraan yang ingin dihapus.
         */
        $jumlahPesanan = Pesanan::select('pesanan.id')
            ->leftJoin('unit_kendaraan', 'pesanan.unit_kendaraan_id', '=', 'unit_kendaraan.id')
            ->where('unit_kendaraan.kendaraan_id', $this->kendaraan->id)
            ->where(function (Builder $query): void {
                $query->where('pesanan.status', 'dipesan')
                    ->orWhere('pesanan.status', 'dikonfirmasi')
                    ->orWhere('pesanan.status', 'dijemput')
                    ->orWhere('pesanan.status', 'dalam_perjalan');
            })->count();

        /**
         * Batalkan penghapusan jika kendaraan memiliki pesanan.
         */
        if ($jumlahPesanan > 0) {
            throw new \Exception("Penghapusan gagal. Kendaraan ini memiliki pesanan yang aktif", 1);
        }

        /**
         * Periksa apakah kendaraan memiliki kambar
         */
        if (!is_null($this->kendaraan->gambar)) {

            /**
             * Jika ada hapus gambar pada storage.
             */
            Storage::disk('public')->delete($this->kendaraan->gambar);
        }

        /**
         * Hapus data kendaraan dari database.
         */
        return $this->kendaraan->delete();
    }
}
