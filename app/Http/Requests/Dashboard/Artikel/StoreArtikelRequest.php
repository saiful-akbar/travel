<?php

namespace App\Http\Requests\Dashboard\Artikel;

use App\Http\Requests\StoreRequest;
use App\Models\Artikel;
use Illuminate\Foundation\Http\FormRequest;

class StoreArtikelRequest extends FormRequest implements StoreRequest
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
            'gambar' => 'required|mimes:jpeg,jpg,png,webp|max:5000',
            'publikasikan' => 'required|boolean',
            'konten' => 'required|string',
        ];
    }

    /**
     * Insert data artikel ke database.
     *
     * @return Artikel
     */
    public function insert(): Artikel
    {
        // Tampung data request.
        $data = $this->only(['judul', 'publikasikan', 'konten']);
        $data['kategori_id'] = $this->input('kategori');

        // Jika gambar diunggah simpan pada storage
        if ($this->hasFile('gambar')) {
            $data['gambar'] = $this->file('gambar')->store('artikel', 'public');
        }

        // simpan
        return Artikel::create($data);
    }
}
