<?php

namespace App\Http\Requests\Dashboard\Kendaraan;

use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitKendaraanRequest extends FormRequest implements UpdateRequest
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
            'nomor_edit' => "required|string|max:20|unique:unit_kendaraan,nomor,{$this->unit->id},id",
            'tahun_edit' => 'required|numeric|date_format:Y|max:' . date('Y') . '|min:' . date('Y') - 20,
            'status_edit' => 'required|in:tersedia,tidak_tersedia,dalam_perbaikan',
        ];
    }

    /**
     * Daftar pesan kesalahan validasi
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nomor_edit.required' => 'Nomor kendaraan yang diedit harus diisi.',
            'nomor_edit.string' => 'Nomor kendaraan yang diedit harus berupa string.',
            'nomor_edit.unique' => 'Nomor kendaraan yang diedit sudah digunakan.',
            'tahun_edit.required' => 'Tahun kendaraan yang diedit harus diisi.',
            'tahun_edit.numeric' => 'Tahun kendaraan yang diedit harus berupa angka yang valid.',
            'tahun_edit.date_format' => 'Tahun kendaraan yang diedit harus berupa tahun yang valid.',
            'tahun_edit.max' => 'Tahun kendaraan yang diedit tidak boleh lebih dari tahun ' . date('Y') . '.',
            'tahun_edit.min' => 'Tahun kendaraan yang diedit tidak boleh kurang dari tahun ' . date('Y') - 20 . '.',
            'status_edit.required' => 'Status kendaraan yang diedit harus diisi.',
            'status_edit.in' => 'Nilai dari status kendaraan yang diedit harus berupa diantara Tersedia, Tidak Tersedia atau Dalam Perbaikan .',
        ];
    }

    /**
     * Perbarui data unit kendaraan
     *
     * @return void
     */
    public function update(): void
    {
        $this->unit->nomor = $this->input('nomor_edit');
        $this->unit->tahun = $this->input('tahun_edit');
        $this->unit->status = $this->input('status_edit');
        $this->unit->save();
    }
}
