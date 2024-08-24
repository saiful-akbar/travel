<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class StoreUnitKendaraanRequest extends FormRequest implements StoreRequest
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
            'nomor' => 'required|string|max:20|unique:unit_kendaraan,nomor',
            'tahun' => 'required|numeric|date_format:Y|max:' . date('Y') . '|min:' . date('Y') - 20,
            'status' => 'required|in:tersedia,tidak_tersedia,dalam_perbaikan',
        ];
    }

    /**
     * Tambahkan data unit kendaraan ke database.
     *
     * @return Model|null
     */
    public function insert(): ?Model
    {
        return $this->kendaraan
            ->unitKendaraan()
            ->create($this->only('nomor', 'tahun', 'status'));
    }
}
