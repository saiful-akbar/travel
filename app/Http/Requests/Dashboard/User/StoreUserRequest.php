<?php

namespace App\Http\Requests\Dashboard\User;

use App\Models\User;
use App\Http\Requests\StoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest implements StoreRequest
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
            'email'         => 'required|email:filter|string|max:100|unique:user,email',
            'password'      => 'required|string|max:200|min:4',
            'role'          => 'required|in:admin,member',
            'status'        => 'required|boolean',
            'foto'          => 'nullable|mimes:png,jpg,jpeg,webp|max:1024',
            'nama_lengkap'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'telepon'       => 'nullable|string|max:30|unique:user,telepon',
        ];
    }

    /**
     * Tambahkan data user baru ke database.
     *
     * @return void
     */
    public function insert(): void
    {
        /**
         * Tampung data request dari form.
         */
        $data = [
            'email'         => $this->email,
            'password'      => bcrypt($this->password),
            'role'          => $this->role,
            'aktif'         => $this->status,
            'nama_lengkap'  => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'telepon'       => $this->telepon,
        ];


        /**
         * Periksa apakah foto diupload atau tidak.
         * 
         * Jika foto diuploas simpan pada storage
         * dan tambahkan ket foto pada $data.
         */
        if ($this->hasFile('foto')) {
            $data['foto'] = $this->file('foto')->store('user-foto', 'public');
        }

        /**
         * Tambahkan dan simpan ke database.
         */
        User::create($data);
    }
}
