<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use App\Models\Pesanan;
use App\Http\Requests\DeleteRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUnitKendaraanRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus data unit kendaraan.
     *
     * @return integer
     */
    public function destroy(): int
    {
        /**
         * Hitung jumlah pesanan yang dimiliki
         * oleh unit kendaraan yang ingin dihapus.
         */
        $jumlahPesanan = Pesanan::select('pesanan.id')
            ->leftJoin('unit_kendaraan', 'pesanan.unit_kendaraan_id', '=', 'unit_kendaraan.id')
            ->where('unit_kendaraan.id', $this->unit->id)
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
            throw new \Exception("Penghapusan gagal. Unit kendaraan ini memiliki pesanan yang aktif", 1);
        }

        return $this->unit->delete();
    }
}
