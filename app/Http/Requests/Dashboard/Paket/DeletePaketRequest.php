<?php

namespace App\Http\Requests\Dashboard\Paket;

use App\Models\Pesanan;
use App\Http\Requests\DeleteRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class DeletePaketRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus paket dari database.
     *
     * @return integer
     */
    public function destroy(): int
    {
        /**
         * Hitung jumlah pesanan yang dimiliki
         * paket yang ingin dihapus.
         */
        $jumlahPesanan = Pesanan::select('pesanan.id')
            ->leftJoin('destinasi', 'pesanan.destinasi_id', '=', 'destinasi.id')
            ->where('destinasi.paket_id', $this->paket->id)
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
            throw new \Exception("Penghapusan gagal. Paket ini memiliki pesanan yang aktif", 1);
        }

        /**
         * Lanjutkan penghapusan jika paket tidak memiliki pesanan.
         */
        return $this->paket->delete();
    }
}
