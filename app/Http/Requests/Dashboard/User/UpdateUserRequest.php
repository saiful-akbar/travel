<?php

namespace App\Http\Requests\Dashboard\User;

use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest implements UpdateRequest
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
            'email'         => "required|email:filter|string|max:100|unique:user,email,{$this->user->id},id",
            'password'      => 'nullable|string|max:200|min:4',
            'role'          => 'required|in:admin,member',
            'status'        => 'required|boolean',
            'nama_lengkap'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'telepon'       => "nullable|string|max:30|unique:user,telepon,{$this->user->id},id",
            'foto'          => 'nullable|mimes:png,jpg,jpeg,webp|max:1024',
        ];
    }

    /**
     * Update data user didatabase.
     *
     * @return void
     */
    public function update(): void
    {
        $this->user->email = $this->email;
        $this->user->role = $this->role;
        $this->user->aktif = $this->status;
        $this->user->nama_lengkap = $this->nama_lengkap;
        $this->user->jenis_kelamin = $this->jenis_kelamin;
        $this->user->telepon = $this->telepon;

        /**
         * Jika password diinput, ganti password yang lama.
         */
        if (!empty($this->password)) {
            $this->user->password = bcrypt($this->password);
        }

        /**
         * Periksa apakah foto di upload atau tidak
         */
        if ($this->hasFile('foto')) {

            /**
             * Periksa apakah user sebelumnya sudah memiliki foto atau belum.
             * Jika sudah hapus foto lama.
             */
            if (!is_null($this->user->foto)) {
                Storage::disk('public')->delete(str_replace(storage(), '', $this->user->foto));
            }

            /**
             * Upload foto ke storage dan database
             */
            $this->user->foto = $this->file('foto')->store('user-foto', 'public');
        }

        /**
         * Simpan hasil perubahan.
         */
        $this->user->save();
    }
}
