<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest implements StoreRequest
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
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'in:Laki-Laki,Perempuan'],
            'telepon' => ['nullable', 'regex:/^[0-9]{10,13}+$/', 'unique:user,telepon'],
            'email' => ['required', 'email:filter', 'max:100', 'unique:user,email'],
            'password' => ['required', 'string', 'min:4', 'max:250'],
        ];
    }

    /**
     * Insert data member ke database.
     *
     * @return Model
     */
    public function insert(): Model
    {
        return User::create([
            'aktif' => true,
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin == 'Perempuan' ? 'P' : 'L',
            'telepon' => $this->telepon,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'member',
        ]);
    }
}
