<?php

namespace App\Http\Requests\Main\Profil;

use App\Models\User;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilMemberRequest extends FormRequest implements UpdateRequest
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
        $memberId = user()->id;

        return [
            'foto' => 'nullable|mimes:png,jpg,jpeg,webp|max:1024',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => "required|email:filter|string|max:100|unique:user,email,{$memberId},id",
            'telepon' => "nullable|regex:/^[0-9]{10,13}+$/|unique:user,telepon,{$memberId},id",
        ];
    }

    /**
     * Update data member di database.
     *
     * @return void
     */
    public function update() : void {
        $member = User::find(user()->id);

        $member->nama_lengkap = $this->input('nama_lengkap');
        $member->jenis_kelamin = $this->input('jenis_kelamin');
        $member->email = $this->input('email');
        $member->telepon = $this->input('telepon');

        /**
         * Periksa apakah foto di upload atau tidak
         */
        if ($this->hasFile('foto')) {

            /**
             * Periksa apakah user sebelumnya sudah memiliki foto atau belum.
             * Jika sudah hapus foto lama.
             */
            if (!is_null($member->foto)) {
                Storage::disk('public')->delete($member->foto);
            }

            /**
             * Upload foto ke storage dan database
             */
            $member->foto = $this->file('foto')->store('user-foto', 'public');
        }

        /**
         * Simpan hasil perubahan.
         */
        $member->save();
    }
}
