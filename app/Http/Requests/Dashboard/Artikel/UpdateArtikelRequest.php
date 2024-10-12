<?php

namespace App\Http\Requests\Dashboard\Artikel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UpdateArtikelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kategori' => 'required|exists:kategori,id',
            'judul' => 'required|string|max:200',
            'gambar' => 'nullable|mimes:jpeg,jpg,png,webp|max:5000',
            'publikasikan' => 'required|boolean',
            'konten' => 'required|string',
        ];
    }

    /**
     * Update data artikel di database.
     *
     * @return void
     */
    public function update(): void
    {
        $this->artikel->kategori_id = $this->input('kategori');
        $this->artikel->judul = $this->input('judul');
        $this->artikel->publikasikan = $this->input('publikasikan');
        $this->artikel->konten = $this->input('konten');

        // Periksa apakah gambar diupload (diganti) atau tidak.
        if ($this->hasFile('gambar')) {

            // Jika diganti hapus gambar yang lama
            Storage::disk('public')->delete($this->artikel->gambar);

            // simpan gambar yang baru
            $this->artikel->gambar = $this->file('gambar')->store('artikel', 'public');
        }

        // Simpan hasil perubahan
        $this->artikel->save();
    }
}
