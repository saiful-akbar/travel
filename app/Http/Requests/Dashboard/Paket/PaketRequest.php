<?php

namespace App\Http\Requests\Dashboard\Paket;

use App\Http\Requests\DataTableRequest;
use App\Models\Paket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class PaketRequest extends FormRequest implements DataTableRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Paket datatable.
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        return DataTables::of(Paket::query())
            ->addColumn('action', function (Paket $model): string {
                return "
                    <a
                        href='" . route('dashboard.paket.edit', ['paket' => $model->id]) . "'
                        role='button'
                        class='btn btn-icon btn-sm btn-light rounded-pill'
                    >
                        <i class='bi-pencil'></i>
                    </a>

                    <button
                        type='button'
                        class='btn btn-icon btn-sm btn-light rounded-pill'
                        onclick='handleDelete(`$model->id`)'
                    >
                        <i class='bi-trash'></i>
                    </button>
                ";
            })->toJson();
    }
}
