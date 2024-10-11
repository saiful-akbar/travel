<?php

namespace App\Http\Requests\Dashboard\Kategori;

use App\Models\Kategori;
use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriRequest extends FormRequest implements StoreRequest
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
            'nama' => 'required|string|max:250|unique:kategori,nama'
        ];
    }

    /**
     * Insert kategori ke database.
     *
     * @return Model
     */
    public function insert(): Model
    {
        return Kategori::create([
            'nama' => $this->input('nama'),
        ]);
    }
}
