<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeleteRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus user.
     *
     * @return void
     */
    public function destroy(): int
    {
        /**
         * Periksa apakah user memiliki foto atau tidak.
         * Jika ada hapus foto dari storage
         */
        if (!is_null($this->user->foto)) {
            Storage::disk('public')->delete(str_replace(storage(), '', $this->user->foto));
        }

        /**
         * Hapus user dari database.
         */
        return $this->user->delete();
    }
}
