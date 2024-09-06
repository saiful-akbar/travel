<?php

namespace App\Http\Requests\Main\Pemesanan;

use App\Models\Harga;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRequest;
use App\Models\UnitKendaraan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
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
            'tanggal_kepulangan'    => 'required|date|after_or_equal:tanggal_keberangkatan',
            'kendaraan'             => 'required|exists:kendaraan,id',
            'waktu_penjemputan'     => 'required|date_format:H:i',
            'alamat_penjemputan'    => 'required|string|max:500',
        ];
    }

    /**
     * mengambil data unit kendaraan yang tersedia.
     *
     * @return Model|null
     */
    private function getUnitKendaraan(): ?Model
    {
        return UnitKendaraan::select('unit_kendaraan.*')
            ->leftJoin('pesanan', function (JoinClause $join): void {
                $join->on('pesanan.unit_kendaraan_id', '=', 'unit_kendaraan.id')
                    ->where('pesanan.tanggal_keberangkatan', '<=', $this->input('tanggal_kepulangan'))
                    ->where('pesanan.tanggal_kepulangan', '>=', $this->input('tanggal_keberangkatan'));
            })
            ->where('unit_kendaraan.kendaraan_id', $this->input('kendaraan'))
            ->where('unit_kendaraan.status', 'tersedia')
            ->whereNull('pesanan.id')
            ->first();
    }

    /**
     * Tambahkan pesanan baru ke database.
     *
     * @return Model
     */
    public function insert(): Model
    {
        /**
         * Ambil data unit kendaraan yang tersedia.
         */
        $unitkendaraan = $this->getUnitKendaraan();

        /**
         * Periksa jika unit kendaraan tidak tersedia (null)
         * kirimkan pesan bahwa kendaraan tidak tersedia.
         */
        if (is_null($unitkendaraan)) {
            throw new \Exception("Unit kendaraan tidak tersedia.", 1);
        }

        /**
         * Select nominal pada tabel harga berdasarkan id_kendaraan
         * dan id_destinasi yang dipilih oleh member.
         */
        $harga = Harga::where('destinasi_id', $this->input('destinasi'))
            ->where('kendaraan_id', $this->input('kendaraan'))
            ->first();

        /**
         * Ambil nominal harga
         */
        $nominal = (int) $harga?->nominal;

        /**
         * Ambil selisih hari dari tanggal yang dipilih
         */
        $startDate = new \DateTime($this->input('tanggal_keberangkatan'));
        $endDate = new \DateTime($this->input('tanggal_kepulangan'));
        $diffDate = $startDate->diff($endDate)->days;

        /**
         * Kalikan nominal dengan jumlah hari
         */
        $totalTagihan = ($diffDate + 1) * $nominal;

        return Pesanan::create([
            'user_id'               => user()->id,
            'unit_kendaraan_id'     => $unitkendaraan->id,
            'destinasi_id'          => $this->input('destinasi'),
            'tanggal_keberangkatan' => $this->input('tanggal_keberangkatan'),
            'tanggal_kepulangan'    => $this->input('tanggal_kepulangan'),
            'alamat_tujuan'         => $this->input('alamat_tujuan'),
            'alamat_penjemputan'    => $this->input('alamat_penjemputan'),
            'waktu_penjemputan'     => $this->input('waktu_penjemputan'),
            'status_pembayaran'     => 'pending',
            'total_tagihan'         => $totalTagihan,
        ]);
    }
}
