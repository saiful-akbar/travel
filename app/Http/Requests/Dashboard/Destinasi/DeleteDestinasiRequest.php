<?php

namespace App\Http\Requests\Dashboard\Destinasi;

use App\Http\Requests\DeleteRequest;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class DeleteDestinasiRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Delete destinasi.
     *
     * @return integer
     */
    public function destroy(): int
    {
        /**
         * Hitung jumlah pesanan aktif yan dimiliki destinasi yang ingin dihapus.
         */
        $jumlahPesanan = Pesanan::select('id')
            ->where('destinasi_id', $this->destinasi->id)
            ->where(function (Builder $query): void {
                $query->where('pesanan.status', 'dipesan')
                    ->orWhere('pesanan.status', 'dikonfirmasi')
                    ->orWhere('pesanan.status', 'dijemput')
                    ->orWhere('pesanan.status', 'dalam_perjalan');
            })->count();

        /**
         * Periksa apakah ada pesanan.
         * Jika ada, batalkan penghapusan dan kirimkan pesan kesalahan.
         */
        if ($jumlahPesanan > 0) {
            throw new \Exception('Penghapusan gagal. Destinasi ini memiliki pesanan yang masih aktif.', 1);
        }

        /**
         * lanjutkan proses penghapusan jika destinasi tidak memiliki pesanan.
         */
        return $this->destinasi->delete();
    }
}
