<?php

namespace App\Http\Requests\Dashboard\MediaSosial;

use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaSosialRequest extends FormRequest implements UpdateRequest
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
            'nama' => "required|string|max:100|unique:media_sosial,nama,{$this->mediaSosial->id},id",
            'url' => 'required|url',
            'icon' => 'nullable|string|max:30'
        ];
    }

    /**
     * Perbarui data media sosial ke database.
     *
     * @return void
     */
    public function update(): void
    {
        $this->mediaSosial->update($this->only('nama', 'url', 'icon'));
    }
}
