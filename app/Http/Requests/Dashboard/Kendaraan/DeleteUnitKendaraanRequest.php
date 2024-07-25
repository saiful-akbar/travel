<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use App\Http\Requests\DeleteRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUnitKendaraanRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus data unit kendaraan.
     *
     * @return integer
     */
    public function destroy(): int
    {
        return $this->unit->delete();
    }
}
