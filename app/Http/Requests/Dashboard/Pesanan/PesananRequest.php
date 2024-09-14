<?php

namespace App\Http\Requests\Dashboard\Pesanan;

use App\Models\Pesanan;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DataTableRequest;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Http\FormRequest;

class PesananRequest extends FormRequest implements DataTableRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Update status pesanan yang sudah dikonfirmasi menjadi selesai jika tanggal saat ini
     * sudah melewati tanggal keberangkatan dan tanggal kepulangan.
     */
    private function statusSelesai(): void
    {
        Pesanan::where('status', 'Dikonfirmasi')
            ->where('tanggal_keberangkatan', '<', date('Y-m-d'))
            ->where('tanggal_kepulangan', '<', date('Y-m-d'))
            ->update(['status' => 'Selesai']);
    }

    /**
     * mengambil data pesanan untuk dataTable
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        /**
         * Update status menjadi selesai
         */
        $this->statusSelesai();

        /**
         * Daftar kolom yang akan ditampilkan.
         */
        $columns = [
            'user.id as user_id',
            'user.foto as user_foto',
            'user.nama_lengkap as user_nama_lengkap',
            'user.email as user_email',
            'pesanan.id as pesanan_id',
            'pesanan.tanggal_keberangkatan as pesanan_tanggal_keberangkatan',
            'pesanan.tanggal_kepulangan as pesanan_tanggal_kepulangan',
            'pesanan.status as pesanan_status',
            'pesanan.created_at as pesanan_created_at',
            'pesanan.updated_at as updated_at',
            'tagihan.id as tagihan_id',
            'tagihan.jumlah as tagihan_jumlah',
            'unit_kendaraan.id as unit_kendaraan_id',
            'unit_kendaraan.nomor as unit_kendaraan_nomor',
            'kendaraan.id as kendaraan_id',
            'kendaraan.merek as kendaraan_merek',
            'kendaraan.tipe as kendaraan_tipe',
            'destinasi.id as destinasi_id',
            'destinasi.wilayah as destinasi_wilayah',
        ];

        /**
         * Select data pesanan.
         */
        $query = Pesanan::select($columns)
            ->join('user', 'user.id', '=', 'pesanan.user_id')
            ->join('tagihan', 'tagihan.pesanan_id', 'pesanan.id')
            ->join('unit_kendaraan', 'unit_kendaraan.id', '=', 'pesanan.unit_kendaraan_id')
            ->join('kendaraan', 'kendaraan.id', '=', 'unit_kendaraan.kendaraan_id')
            ->join('destinasi', 'destinasi.id', '=', 'pesanan.destinasi_id');

        /**
         * Datatable
         */
        return DataTables::of($query)
            ->addColumn('action', function (Model $model) {
                return "
                    <button
                        class='btn btn-sm btn-icon btn-info rounded-circle'
                        type='button'
                        title='Detail Pesanan'
                    >
                        <i class='bi-eye'></i>
                    </button>

                    <button
                        class='btn btn-sm btn-icon btn-warning rounded-circle'
                        type='button'
                        title='Edit Pesanan'
                    >
                        <i class='bi-pencil'></i>
                    </button>
                    
                    <button
                        class='btn btn-sm btn-icon btn-danger rounded-circle'
                        type='button'
                        title='Hapus Pesanan'
                    >
                        <i class='bi-trash'></i>
                    </button>
                ";
            })->toJson();
    }
}
