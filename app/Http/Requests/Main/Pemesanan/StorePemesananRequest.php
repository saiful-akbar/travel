<?php

namespace App\Http\Requests\Main\Pemesanan;

use App\Models\Pesanan;
use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class StorePemesananRequest extends FormRequest implements StoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'destinasi'             => 'required|exists:destinasi,id',
            'alamat_tujuan'         => 'required|string|max:500',
            'tanggal_keberangkatan' => 'required|date',
            'tanggal_kepulangan'    => 'required|date',
            'kendaraan'             => 'required|exists:kendaraan,id',
            'waktu_penjemputan'     => 'required|date_format:H:i',
            'lokasi_penjemputan'    => 'required|string|max:500',
        ];
    }

    /**
     * Method untuk memeriksa ketersediaan kendaraan.
     *
     * @return integer
     */
    private function cekKetersediaanKendaraan(): int
    {
        /**
         * select id dari tabel pesanan.
         */
        $query = Pesanan::select('pesanan.id');

        /**
         * Join tabel pesanan dengan tabel unit_kendaraan
         */
        $query->leftJoin('unit_kendaraan', 'unit_kendaraan.id', '=', 'pesanan.unit_kendaraan_id');

        /**
         * Filter unit kendaraan berdasarkan id kendaraan yang direquest.
         */
        $query->where('unit_kendaraan.kendaraan_id', $this->input('kendaraan'));

        /**
         * Tambahkan where untuk memfilter berdasarkan tanggal keberangkatan dan tanggal kepulangan.
         */
        $query->where(function (Builder $subQuery): void {

            /**
             * Perisak apakah ada tanggal_keberangkatan pada tabel pesanan yang berada
             * diantara tanggal keberangkatan dan tanggal kepulangan yang dipilih oleh user.
             */
            $subQuery->whereBetween('pesanan.tanggal_keberangkatan', [
                $this->input('tanggal_keberangkatan'),
                $this->input('tanggal_kepulangan'),
            ]);

            /**
             * Dan perisak apakah ada tanggal_kepulangan pada tabel pesanan yang berada
             * diantara tanggal keberangkatan dan tanggal kepulangan yang dipilih oleh user.
             */
            $subQuery->orWhereBetween('pesanan.tanggal_kepulangan', [
                $this->input('tanggal_keberangkatan'),
                $this->input('tanggal_kepulangan'),
            ]);

            /**
             * Dan periksa apakah ada tanggal keberangkatan yang dipilih oleh user yang berada
             * diantara tanggal_keberangkatan dan tanggal_kepulangan yang ada pada tabel pesanan.
             */
            $subQuery->orWhere(function (Builder $subQuery): void {
                $subQuery->where('pesanan.tanggal_keberangkatan', '<=', $this->input('tanggal_keberangkatan'))
                    ->where('pesanan.tanggal_kepulangan', '>=', $this->input('tanggal_keberangkatan'));
            });

            /**
             * Dan periksa apakah ada tanggal kepulangan yang dipilih oleh user yang berada
             * diantara tanggal_keberangkatan dan tanggal_kepulangan yang ada pada tabel pesanan.
             */
            $subQuery->orWhere(function (Builder $subQuery): void {
                $subQuery->where('pesanan.tanggal_keberangkatan', '<=', $this->input('tanggal_kepulangan'))
                    ->where('pesanan.tanggal_kepulangan', '>=', $this->input('tanggal_kepulangan'));
            });
        });

        return $query->count();
    }

    /**
     * Tambahkan pesanan baru ke database.
     *
     * @return Model
     */
    public function insert(): Model
    {
        /**
         * Periksa apakah mobil tersedia atau tidak
         * Jika jumlahnya lebih dari 0 atrinya mobi 
         */
    }
}
