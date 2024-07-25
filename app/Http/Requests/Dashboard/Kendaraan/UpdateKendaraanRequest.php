<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use Illuminate\Validation\Rule;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKendaraanRequest extends FormRequest implements UpdateRequest
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
        $uniqueRule = Rule::unique('kendaraan', 'merek')
            ->ignore($this->kendaraan->id, 'id')
            ->where('tipe', $this->tipe);

        return [
            'merek' => ['required', 'string', 'max:100', $uniqueRule],
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
     * Perbarui data kendaraan di database.
     *
     * @return void
     */
    public function update(): void
    {
        $this->kendaraan->merek = $this->input('merek');
        $this->kendaraan->tipe = $this->input('tipe');
        $this->kendaraan->kapasitas = $this->input('kapasitas');
        $this->kendaraan->deskripsi = $this->input('deskripsi');

        /**
         * Periksa apakah gambar diupload atau tidak
         */
        if ($this->hasFile('gambar')) {

            /**
             * Jika sebelumnya kendaraan sudah memiliki gambar
             * hapus gambar yang lama dari storage
             */
            if (!is_null($this->kendaraan->gambar)) {
                Storage::disk('public')->delete($this->kendaraan->gambar);
            }

            /**
             * Upload gambar kendaraan baru.
             */
            $this->kendaraan->gambar = $this->file('gambar')->store('kendaraan', 'public');
        }

        /**
         * Simpan perubahan ke database.
         */
        $this->kendaraan->save();
    }
}
