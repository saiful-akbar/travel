<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use App\Models\Kendaraan;
use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKendaraanRequest extends FormRequest implements StoreRequest
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
            'merek' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kendaraan', 'merek')->where('tipe', $this->tipe)
            ],
            'tipe' => ['required', 'string', 'max:100'],
            'kapasitas' => ['required', 'numeric', 'min:1', 'max:100'],
            'deskripsi' => ['nullable', 'string', 'max:300'],
            'gambar' => ['nullable', 'mimes:png,jpg,jpeg,webp', 'max:1024'],
        ];
    }

    /**
     * Pesan kesalahan validasi.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'merek.unique' => "Merek {$this->merek} dengan tipe {$this->tipe} sudah ada."
        ];
    }

    /**
     * Tambahkan data kendaraan ke database.
     *
     * @return null|Model
     */
    public function insert(): ?Model
    {
        /**
         * Tampung data request
         */
        $data = $this->only('merek', 'tipe', 'kapasitas', 'deskripsi');

        /**
         * Periksa apakah gambar diupload.
         * 
         * Jika diupload simpan pada storage
         * dan tampung path pada $data
         */
        if ($this->hasFile('gambar')) {
            $data['gambar'] = $this->file('gambar')->store('kendaraan', 'public');
        }

        /**
         * Simpan ke database
         */
        return Kendaraan::create($data);
    }
}
