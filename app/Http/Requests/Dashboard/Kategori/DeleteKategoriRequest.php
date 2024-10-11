<?php

namespace App\Http\Requests\Dashboard\Kategori;

use App\Http\Requests\DeleteRequest;
use App\Models\Artikel;
use Illuminate\Foundation\Http\FormRequest;

class DeleteKategoriRequest extends FormRequest implements DeleteRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hapus kategori datri database.
     *
     * @return integer
     */
    public function destroy(): int
    {
        // Hitung apakah ada artikel yang memiliki relasi
        // kepada kategori yang ingin dihapus ini.
        $artikel = Artikel::where('kategori_id', $this->kategori->id)->count();

        // jika terdapat atrikel yang terhubung
        // kirimkan pesan error.
        if ($artikel > 0) {
            throw new \Exception("Kategori gagal dihapus. Kategori ini memiliki atrikel yang masih aktif.", 1);
        }

        // Jalankan proses hapus kategori
        return $this->kategori->delete();
    }
}
