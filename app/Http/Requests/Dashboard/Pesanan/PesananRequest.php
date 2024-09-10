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
     * mengambil data pesanan untuk dataTable
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        /**
         * Daftar kolom yang akan ditampilkan.
         */
        $columns = [
            'pesanan.id as pesanan_id',
            'pesanan.tanggal_keberangkatan as pesanan_tanggal_keberangkatan',
            'pesanan.tanggal_kepulangan as pesanan_tanggal_kepulangan',
            'pesanan.status as pesanan_status',
            'user.id as user_id',
            'user.nama_lengkap as user_nama_lengkap',
        ];

        /**
         * Select data pesanan.
         */
        $query = Pesanan::select($columns)
            ->join('user', 'user.id', '=', 'pesanan.user_id');

        /**
         * Datatable
         */
        return DataTables::of($query)
            ->addColumn('action', function (Model $model) {
                return "
                    <button
                        type='button'
                        class='btn btn-icon btn-sm btn-info rounded-circle'
                        title='Detail'
                        onclick='showDetail(`{$model->id}`)'
                    >
                        <i class='bi-eye'></i>
                    </button>

                    <button
                        type='button'
                        class='btn btn-icon btn-sm btn-warning rounded-circle'
                        title='Edit'
                        onclick='handleEdit(`{$model->id}`)'
                    >
                        <i class='bi-pencil'></i>
                    </button>

                    <button
                        type='button'
                        class='btn btn-icon btn-sm btn-danger rounded-circle'
                        title='Hapus'
                        onclick='handleDelete(`{$model->id}`)'
                    >
                        <i class='bi-trash'></i>
                    </button>
                ";
            })->toJson();
    }
}
