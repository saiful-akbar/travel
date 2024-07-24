<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupirRequest extends FormRequest implements UpdateRequest
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
            'foto' => 'nullable|mimes:jpg,jpeg,png,webp|max:1024',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
        ];
    }

    /**
     * Update data supir
     *
     * @return void
     */
    public function update(): void
    {
        $this->supir->nama_lengkap = $this->nama_lengkap;
        $this->supir->jenis_kelamin = $this->jenis_kelamin;
        $this->supir->tanggal_lahir = $this->tanggal_lahir;

        /**
         * Periksa apakah foto dirubah/diupload atau tidak.
         */
        if ($this->hasFile('foto')) {

            /**
             * Periksa apakah user sebelumnya memiliki foto atau tidak.
             * Jika sebelumn ada, hapus foto lama dari storage.
             */
            if (!is_null($this->supir->foto)) {
                Storage::disk('public')->delete($this->supir->foto);
            }

            /**
             * Upload foto baru ke storage.
             */
            $this->supir->foto = $this->file('foto')->store('supir-foto', 'public');
        }

        /**
         * Simpan hasil perubahan ke database.
         */
        $this->supir->save();
    }
}
