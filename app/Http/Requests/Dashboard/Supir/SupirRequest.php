<?php

namespace App\Http\Requests\Dashboard\Supir;

use App\Http\Requests\DataTableRequest;
use App\Models\Supir;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class SupirRequest extends FormRequest implements DataTableRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function dataTable(): JsonResponse
    {
        return DataTables::of(Supir::query())
            ->addColumn('action', function (Supir $supir) {
                return '
                    <a
                        href="' . route('dashboard.supir.edit', ['supir' => $supir->id]) . '"
                        class="btn btn-icon btn-light btn-sm rounded-pill"
                        role="button"
                        title="Edit"
                    >
                        <i class="bi-pencil"></i>
                    </a>

                    <button
                        type="button"
                        class="btn btn-icon btn-light btn-sm rounded-pill"
                        onclick="handleDelete(`' . $supir->id . '`)"
                        title="Hapus"
                    >
                        <i class="bi-trash"></i>
                    </button>
                ';
            })->toJson();
    }
}
