<?php

namespace App\Http\Requests\Dashboard\Pesanan;

use App\Http\Requests\DeleteRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeletePesananRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus data pesanan dari database.
     *
     * @return integer
     */
    public function destroy(): int
    {
        $deleted = $this->pesanan->delete();

        if ($deleted <= 0) {
            throw new \Exception("Terjadi kesahan. Gagal menghapus pesanan", 1);
        }

        return $deleted;
    }
}
