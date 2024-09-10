<?php

namespace App\Http\Requests\Dashboard\Harga;

use App\Models\Harga;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DataTableRequest;
use Illuminate\Foundation\Http\FormRequest;
use Yajra\DataTables\Facades\DataTables;

class HargaRequest extends FormRequest implements DataTableRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * mengambil data harga
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        /**
         * Daftar kolom tang akaan diambil.
         */
        $columns = [
            'harga.id as id',
            'harga.nominal as nominal',
            'harga.created_at as created_at',
            'harga.updated_at as updated_at',
            'kendaraan.merek as kendaraan_merek',
            'kendaraan.tipe as kendaraan_tipe',
            'destinasi.wilayah as destinasi_wilayah',
            'destinasi.jumlah_hari as destinasi_jumlah_hari',
        ];

        /**
         * Select data harga
         */
        $query = Harga::select($columns)
            ->leftJoin('kendaraan', 'harga.kendaraan_id', '=', 'kendaraan.id')
            ->leftJoin('destinasi', 'harga.destinasi_id', '=', 'destinasi.id');

        /**
         * Buat datatable
         */
        return DataTables::of($query)->addColumn('action', function (Harga $model): string {
            return "
                <a href='" . route('dashboard.harga.edit', ['harga' => $model->id]) . "'
                    role='button'
                    class='btn btn-icon btn-sm btn-warning rounded-pill'
                    title='Edit'
                >
                    <i class='bi-pencil'></i>
                </a>

                <button type='button'
                    class='btn btn-icon btn-sm btn-danger rounded-pill'
                    title='Hapus'
                    onclick='handleDelete(`{$model->id}`)'
                >
                    <i class='bi-trash'></i>
                </button>
            ";
        })->toJson();
    }
}
