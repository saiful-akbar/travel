<?php

namespace App\Http\Requests\Dashboard\Destinasi;

use App\Models\Destinasi;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DataTableRequest;
use Illuminate\Foundation\Http\FormRequest;
use Yajra\DataTables\Facades\DataTables;

class DestinasiRequest extends FormRequest implements DataTableRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ambil data destinasi dari database
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        /**
         * Daftar kolom yang akan diambil
         */
        $columns = [
            'destinasi.id as id',
            'destinasi.wilayah as wilayah',
            'destinasi.jumlah_hari as jumlah_hari',
            'destinasi.aktif as aktif',
            'destinasi.created_at as created_at',
            'destinasi.updated_at as updated_at',
            'paket.id as paket_id',
            'paket.nama as paket_nama',
        ];

        /**
         * Buat query select destinasi dan join dengan tabel paket.
         */
        $query = Destinasi::select($columns)->leftJoin('paket', 'destinasi.paket_id', '=', 'paket.id');

        /**
         * Buat datatable dari hasil query.
         */
        return DataTables::of($query)
            ->addColumn('action', function (Destinasi $model): string {
                return "
                    <a
                        role='button'
                        href='" . route('dashboard.destinasi.edit', ['destinasi' => $model->id]) . "'
                        class='btn btn-icon btn-sm btn-warning rounded-pill'
                        title='Edit'
                    >
                        <i class='bi-pencil'></i>
                    </a>

                    <button
                        type='button'
                        class='btn btn-icon btn-sm btn-danger rounded-pill'
                        onclick='handleDelete(`{$model->id}`)'
                        title='Hapus'
                    >
                        <i class='bi-trash'></i>
                    </button>
                ";
            })->toJson();
    }
}
