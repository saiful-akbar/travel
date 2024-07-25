<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use App\Http\Requests\DeleteRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class DeleteKendaraanRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus data kendaraan dari database.
     *
     * @return integer
     */
    public function destroy(): int
    {
        /**
         * Periksa apakah kendaraan memiliki kambar
         */
        if (!is_null($this->kendaraan->gambar)) {

            /**
             * Jika ada hapus gambar pada storage.
             */
            Storage::disk('public')->delete($this->kendaraan->gambar);
        }

        /**
         * Hapus data kendaraan dari database.
         */
        return $this->kendaraan->delete();
    }
}
