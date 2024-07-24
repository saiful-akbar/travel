<?php

namespace App\Http\Requests\Dashboard\Supir;

use App\Http\Requests\DeleteRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeleteSupirRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus data supir
     *
     * @return integer
     */
    public function destroy(): int
    {
        return $this->supir->delete();
    }
}
