<?php

namespace App\Http\Requests\Dashboard\MediaSosial;

use App\Http\Requests\DataTableRequest;
use App\Models\MediaSosial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class MediaSosialRequest extends FormRequest implements DataTableRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * ambil data media sosial untuk dataTable
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        return DataTables::of(MediaSosial::query())
            ->addColumn('action', function (MediaSosial $model): string {
                return "
                    <a
                        href='" . route('dashboard.mediaSosial.edit', ['mediaSosial' => $model->id]) . "'
                        role='button'
                        class='btn btn-icon btn-sm btn-light rounded-pill'
                        title='Edit'
                    >
                        <i class='bi-pencil'></i>
                    </a>

                    <button
                        type='button'
                        class='btn btn-icon btn-sm btn-light rounded-pill'
                        onclick='handleDelete(`{$model->id}`)'
                        title='Hapus'
                    >
                        <i class='bi-trash'></i>
                    </button>
                ";
            })->toJson();
    }
}
