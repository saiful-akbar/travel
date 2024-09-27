<?php

namespace App\Http\Requests\Main\Profil;

use App\Models\User;
use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordMemberRequest extends FormRequest implements UpdateRequest
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
            'password_lama' => 'required|current_password',
            'password_baru' => 'required|string|min:6',
            'password_konfirmasi' => 'required_with:password_baru|same:password_baru|min:6',
        ];
    }

    /**
     * Update password member
     *
     * @return void
     */
    public function update() : void {
        User::where('id', user()->id)->update([
            'password' => bcrypt($this->input('password_baru'))
        ]);
    }
}
