<?php

namespace App\Http\Requests\Dashboard\Artikel;

use App\Models\Artikel;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DataTableRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Http\FormRequest;

class ArtikelRequest extends FormRequest implements DataTableRequest
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
     * Mengambil data artikel untuk dataTable.
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        $columns = [
            'kategori.id as kategori_id',
            'kategori.nama as kategori_nama',
            'artikel.id as artikel_id',
            'artikel.judul as artikel_judul',
            'artikel.gambar as artikel_gambar',
            'artikel.publikasikan as artikel_publikasikan',
            'artikel.created_at as artikel_created_at',
            'artikel.updated_at as artikel_updated_at',
        ];

        $query = Artikel::select($columns)->leftJoin('kategori', 'kategori.id', '=', 'artikel.kategori_id');

        return DataTables::of($query)->addColumn('action', function ($model): string {
            return "
                <a
                    role='button'
                    href='" . route('dashboard.artikel.edit', ['artikel' => $model->artikel_id]) . "'
                    class='btn btn-sm btn-icon btn-warning rounded-circle'
                    title='Edit'
                >
                    <i class='bi-pencil'></i>
                </a>

                <button
                    type='button'
                    class='btn btn-sm btn-icon btn-danger rounded-pill'
                    title='Hapus'
                    onclick='handleDelete(`{$model->artikel_id}`)'
                >
                    <i class='bi-trash'></i>
                </button>
                ";
        })->toJson();
    }
}
