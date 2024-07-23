<?php

namespace App\Http\Requests\Dashboard\Supir;

use App\Http\Requests\DataTableRequest;
use App\Models\Supir;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Yajra\DataTables\Facades\DataTables;

class SupirRequest extends FormRequest implements JsonResponse
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
            ->addColumns('actions', function (Supir $supir) {
                return '
                    <a href="' . route('dashboard.supir.edit', ['supir' => $supir->id]) . '" class="btn btn-icon btn-danger btn-sm">
                        <i class="bi-pencil"></i>
                    </a>
                ';
            })->toJson();
    }
}
