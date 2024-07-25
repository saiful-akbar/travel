<?php

namespace App\Http\Requests\Dashboard\Perusahaan;

use App\Models\Perusahaan;
use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class StorePerusahaanRequest extends FormRequest implements StoreRequest
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
            'nama' => 'required|string|max:100',
            'logo' => 'required|mimes:jpg,jpeg,png,webp|max:1024',
            'email' => 'required|email:filter|max:100',
            'telepon' => 'required|regex:/^[0-9]{10,13}+$/',
            'alamat' => 'required|string|max:300',
        ];
    }

    /**
     * Tambahkan perusahaan baru ke database.
     *
     * @return Model|null
     */
    public function insert(): ?Model
    {
        /**
         * Ambil data perusahaan saat ini.
         */
        $perusahaan = Perusahaan::first();

        /**
         * Periksa apakah data perrusahaan ada atau tidak.
         * Jika ada, hapus datanya dari database
         * dan logo-nya dari storage.
         */
        if (!is_null($perusahaan)) {

            /**
             * Periksa apakah ada logo pada perusahaan saat ini.
             * Jika ada, hapus logo dari storage.
             */
            if (!is_null($perusahaan->logo)) {
                Storage::disk('public')->delete($perusahaan->logo);
            }

            /**
             * Hapus data perusahaan saat ini dari database.
             */
            $perusahaan->delete();
        }

        /**
         * Tampung data request form
         */
        $data = $this->only('nama', 'email', 'telepon', 'alamat');

        /**
         * Periksa apakah ada logo yang di-upload pada data
         * perusahaan baru.
         */
        if ($this->hasFile('logo')) {

            /**
             * Jika ada logo yang di-upload
             * simpan pada storage.
             */
            $data['logo'] = $this->file('logo')->store('logo-perusahaan', 'public');
        }

        /**
         * Simpan data perusahaan baru ke database.
         */
        return Perusahaan::create($data);
    }
}
