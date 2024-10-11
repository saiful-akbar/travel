<?php

namespace App\Http\Requests\Dashboard\Kategori;

use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKategoriRequest extends FormRequest implements UpdateRequest
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
            'nama' => "required|string|max:250|unique:kategori,nama,{$this->kategori->id},id"
        ];
    }

    /**
     * Perbarui data kategori didatabase.
     *
     * @return void
     */
    public function update(): void
    {
        $this->kategori->nama = $this->input('nama');
        $this->kategori->save();
    }
}
