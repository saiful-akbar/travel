<?php

namespace App\Http\Requests\Dashboard\Harga;

use App\Models\Pesanan;
use App\Http\Requests\DeleteRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class DeleteHargaRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dleete data harga
     *
     * @return integer
     */
    public function destroy(): int
    {
        /**
         * Hitung jumlah pesanan yang dimiliki harga yang ingin dihapus.
         */
        $jumlahPesanan = Pesanan::select('pesanan.id')
            ->leftJoin('unit_kendaraan', 'pesanan.unit_kendaraan_id', '=', 'unit_kendaraan.id')
            ->leftJoin('destinasi', 'pesanan.destinasi_id', '=', 'destinasi.id')
            ->where('unit_kendaraan.kendaraan_id', $this->harga->kendaraan_id)
            ->where('destinasi.id', $this->harga->destinasi_id)
            ->where(function (Builder $query) {
                $query->where('pesanan.status', 'dipesan')
                    ->orWhere('pesanan.status', 'dikonfirmasi')
                    ->orWhere('pesanan.status', 'dijemput')
                    ->orWhere('pesanan.status', 'dalam_perjalan');
            })->count();

        /**
         * Periksa, jika harga memiliki pesanan
         * Batalkan penghapusan.
         */
        if ($jumlahPesanan > 0) {
            throw new \Exception("Penghapusan dibatalkan. Data harga ini memiliki pesanan yang masih aktif.", 1);
        }

        /**
         * Lanjutkan proses penghapusan.
         */
        return $this->harga->delete();
    }
}
