<?php

namespace App\Http\Requests\Dashboard\Perusahaan;

use App\Models\Perusahaan;
use Illuminate\Support\Str;
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
            'nama' => 'nullable|string|max:100',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:1024',
            'email' => 'nullable|email:filter|max:100',
            'telepon' => 'nullable|regex:/^[0-9]{10,13}+$/',
            'alamat' => 'nullable|string|max:300',
            'visi' => 'nullable|string|max:500',
            'misi' => 'nullable|string|max:500',
            'profil' => 'nullable|string|max:500',
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
         * Tampung data request form
         */
        $data = $this->only([
            'nama',
            'email',
            'telepon',
            'alamat',
            'visi',
            'misi',
            'profil',
        ]);

        /**
         * Simpan logo pada storage jika di-upload.
         */
        if ($this->hasFile('logo')) {

            /**
             * Jika sebelumnya perusahaan sudah memiliki logo,
             * hapus logo lama dari storage.
             */
            if (!empty($perusahaan->logo)) {
                Storage::disk('public')->delete($perusahaan->logo);
            }

            /**
             * Upload dan simpan logo baru.
             */
            $data['logo'] = $this->file('logo')->store('logo-perusahaan', 'public');
        } else {

            /**
             * Pertahankan logo lama jika ada.
             */
            if (!empty($perusahaan->logo)) {
                $data['logo'] = $perusahaan->logo;
            }
        }

        /**
         * Hapus semua data perusahaan lama.
         */
        if (!empty($perusahaan)) {
            $perusahaan->delete();
        }

        /**
         * Simpan data perusahaan baru.
         */
        return Perusahaan::create($data);
    }
}
