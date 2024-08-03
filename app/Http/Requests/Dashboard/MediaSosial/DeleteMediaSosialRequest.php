<?php

namespace App\Http\Requests\Dashboard\MediaSosial;

use App\Http\Requests\DeleteRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeleteMediaSosialRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus data media sosial dari database.
     *
     * @return integer
     */
    public function destroy(): int
    {
        return $this->mediaSosial->delete();
    }
}
