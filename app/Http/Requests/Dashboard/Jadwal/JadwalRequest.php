<?php

namespace App\Http\Requests\Dashboard\Jadwal;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DataTableRequest;
use App\Models\Pesanan;
use Illuminate\Foundation\Http\FormRequest;
use Yajra\DataTables\Facades\DataTables;

class JadwalRequest extends FormRequest implements DataTableRequest
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
            'tanggal_awal' => 'nullable|date',
            'tanggal_akhir' => 'required_with:tanggal_awal|date',
            'kategori' => 'nullable|in:tanggal_keberangkatan,tanggal_kepulangan,created_at'
        ];
    }

    /**
     * mengambil data jadwal untuk datatable
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        $tanggalAwal = $this->query('tanggal_awal') ?? date('Y-m-01');
        $tanggalAkhir = $this->query('tanggal_akhir') ?? date('Y-m-t');
        $kategori = $this->query('kategori') ?? 'tanggal_keberangkatan';

        /**
         * Daftar kolom tabel yang akan diambil
         */
        $columns = [
            'pesanan.id as pesanan_id',
            DB::raw('DATE(pesanan.created_at) as pesanan_tanggal_pemesanan'),
            'pesanan.tanggal_keberangkatan as pesanan_tanggal_keberangkatan',
            'pesanan.tanggal_kepulangan as pesanan_tanggal_kepulangan',
            DB::raw('(DATEDIFF(pesanan.tanggal_kepulangan, pesanan.tanggal_keberangkatan) + 1) as pesanan_jumlah_hari'),
            'kendaraan.merek as kendaraan_merek',
            'kendaraan.tipe as kendaraan_tipe',
            'unit_kendaraan.nomor as unit_kendaraan_nomor',
            'destinasi.wilayah as destinasi_wilayah',
        ];

        /**
         * Buat query select
         */
        $query = Pesanan::select($columns)
            ->join('destinasi', 'destinasi.id', '=', 'pesanan.destinasi_id')
            ->join('unit_kendaraan', 'unit_kendaraan.id', '=', 'pesanan.unit_kendaraan_id')
            ->join('kendaraan', 'kendaraan.id', '=', 'unit_kendaraan.kendaraan_id')
            ->whereBetween(DB::raw("DATE(pesanan.{$kategori})"), [$tanggalAwal, $tanggalAkhir])
            ->where('pesanan.status', 'Dikonfirmasi')
            ->orderBy('pesanan.tanggal_keberangkatan', 'asc')
            ->get();

        return DataTables::of($query)->toJson();
    }
}
