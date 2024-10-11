<?php

namespace App\Http\Requests\Dashboard\Kategori;

use App\Models\Kategori;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DataTableRequest;
use Illuminate\Foundation\Http\FormRequest;
use Yajra\DataTables\Facades\DataTables;

class KategoriRequest extends FormRequest implements DataTableRequest
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
            //
        ];
    }

    /**
     * Mengambil data kategori artikel untuk dataTable
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        return DataTables::of(Kategori::query())
            ->addColumn('action', function (Kategori $model): string {
                return "
                    <button
                        type='button'
                        class='btn btn-sm btn-icon btn-warning rounded-circle'
                        title='Edit'
                        onclick='return handleEdit(`{$model->id}`)'
                    >
                        <i class='bi-pencil'></i>
                    </button>

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
