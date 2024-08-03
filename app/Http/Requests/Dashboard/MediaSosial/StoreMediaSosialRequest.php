<?php

namespace App\Http\Requests\Dashboard\MediaSosial;

use App\Http\Requests\StoreRequest;
use App\Models\MediaSosial;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediaSosialRequest extends FormRequest implements StoreRequest
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
            'nama' => 'required|string|max:100|unique:media_sosial,nama',
            'url' => 'required|url',
            'icon' => 'nullable|string|max:30'
        ];
    }

    /**
     * Tambah data media sosial ke database.
     *
     * @return MediaSosial
     */
    public function insert(): MediaSosial
    {
        return MediaSosial::create($this->only('nama', 'url', 'icon'));
    }
}
