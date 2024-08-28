<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use App\Models\Kendaraan;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DataTableRequest;
use Illuminate\Foundation\Http\FormRequest;
use Yajra\DataTables\Facades\DataTables;

class KendaraanRequest extends FormRequest implements DataTableRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ambil data kendaraan
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        /**
         * Daftar kolom yang akan diambil datanya
         */
        $columns = [
            'kendaraan.id as id',
            'kendaraan.merek as merek',
            'kendaraan.tipe as tipe',
            'kendaraan.kapasitas as kapasitas',
            'kendaraan.gambar as gambar',
            'kendaraan.deskripsi as deskripsi',
            'kendaraan.created_at as created_at',
            'kendaraan.updated_at as updated_at',
        ];

        /**
         * Buat query SQL
         */
        $query = Kendaraan::select($columns)
            ->selectRaw('count(unit_kendaraan.id) as jumlah_unit')
            ->leftJoin('unit_kendaraan', 'unit_kendaraan.kendaraan_id', '=', 'kendaraan.id')
            ->groupBy('kendaraan.id')->get();

        /**
         * Datatable
         */
        return DataTables::of($query)->addColumn('action', function (Kendaraan $model) {
            return "
                <a
                    href='" . route('dashboard.kendaraan.unit', ['kendaraan' => $model->id]) . "'
                    class='btn btn-sm btn-icon btn-info rounded-pill'
                    title='Unit Kendaraan'
                    role='button'
                >
                    <i class='bi-car-front'></i>
                </a>

                <a
                    href='" . route('dashboard.kendaraan.edit', ['kendaraan' => $model->id]) . "'
                    class='btn btn-sm btn-icon btn-warning rounded-pill'
                    title='Edit'
                    role='button'
                >
                    <i class='bi-pencil'></i>
                </a>

                <button
                    type='button'
                    class='btn btn-sm btn-icon btn-danger rounded-pill'
                    title='Hapus'
                    onclick='handleDelete(`{$model->id}`)'
                >
                    <i class='bi-trash'></i>
                </button>
            ";
        })->toJson();
    }
}
