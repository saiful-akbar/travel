<?php

namespace App\Http\Requests\Dashboard\Paket;

use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaketRequest extends FormRequest implements UpdateRequest
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
            'nama' => "required|string|max:100|unique:paket,nama,{$this->paket->id},id",
            'deskripsi' => 'nullable|string|max:300',
        ];
    }

    /**
     * Update paket di database.
     *
     * @return void
     */
    public function update(): void
    {
        $this->paket->nama = $this->input('nama');
        $this->paket->deskripsi = $this->input('deskripsi');
        $this->paket->save();
    }
}
