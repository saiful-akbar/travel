<?php

namespace App\Http\Requests\Dashboard\Supir;

use App\Http\Requests\StoreRequest;
use App\Models\Supir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupirRequest extends FormRequest implements StoreRequest
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
            'foto' => 'nullable|mimes:png,jpg,jpeg,webp|max:1024',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
        ];
    }

    /**
     * Tambah data supir ke database.
     *
     * @return null|Model
     */
    public function insert(): ?Model
    {
        /**
         * Tampung data form
         */
        $data = $this->only('nama_lengkap', 'jenis_kelamin', 'tanggal_lahir');

        /**
         * Periksa apakah foto diupload.
         * 
         * jika diupload simpan ke storage dan tambahkan path
         * foto pada $data.
         */
        if ($this->hasFile('foto')) {
            $data['foto'] = $this->file('foto')->store('supir-foto', 'public');
        }

        /**
         * Tambahkan dan simpan data supir ke database.
         */
        return Supir::create($data);
    }
}
