<?php

namespace App\Http\Requests\Dashboard\User;

use App\Http\Requests\DataTableRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest implements DataTableRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Datatable
     *
     * @return JsonResponse
     */
    public function dataTable(): JsonResponse
    {
        return DataTables::of(User::query())
            ->addColumn('action', function (User $model) {
                return "
                    <a
                        class='btn btn-light btn-icon btn-sm rounded-pill'
                        href='" . route('dashboard.user.edit', ['user' => $model->id]) . "'
                        title='Edit'
                    >
                        <i class='bi-pencil'></i>
                    </a>

                    <button
                        class='btn btn-light btn-icon btn-sm rounded-pill'
                        title='Hapus'
                        onclick='handleDelete(`{$model->id}`)'
                    >
                        <i class='bi-trash'></i>
                    </button>
                ";
            })->toJson();
    }
}
