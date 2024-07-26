<?php

namespace App\Http\Requests\Dashboard\Paket;

use App\Http\Requests\StoreRequest;
use App\Models\Paket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class StorePaketRequest extends FormRequest implements StoreRequest
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
            'nama' => 'required|string|max:100|unique:paket,nama',
            'deskripsi' => 'nullable|string|max:300',
        ];
    }

    /**
     * Tambah data paket baru ke database.
     *
     * @return Model|null
     */
    public function insert(): ?Model
    {
        /**
         * Tampung data form
         */
        $data = $this->only('nama', 'deskripsi');

        /**
         * Tambahkan dan simpan ke database.
         */
        return Paket::create($data);
    }
}
