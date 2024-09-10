<?php

namespace App\Http\Requests\Dashboard\Harga;

use App\Models\Destinasi;
use App\Models\Kendaraan;
use Illuminate\Validation\Rule;
use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHargaRequest extends FormRequest implements UpdateRequest
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
            'kendaraan' => [
                'required',
                'exists:kendaraan,id',
                Rule::unique('harga', 'kendaraan_id')
                    ->ignore($this->harga->id, 'id')
                    ->where('destinasi_id', $this->input('destinasi'))
            ],
            'paket' => ['required', 'exists:paket,id'],
            'destinasi' => ['required', 'exists:destinasi,id'],
            'nominal' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * Pesan kesalahan validasi.
     *
     * @return array
     */
    public function messages(): array
    {
        $kendaraan = Kendaraan::where('id', $this->input('kendaraan'))->first();
        $destinasi = Destinasi::where('id', $this->input('destinasi'))->first();

        return [
            'kendaraan.unique' => "Kendaraan <b>$kendaraan?->merek - $kendaraan?->tipe</b> dengan destinasi <b>$destinasi?->wilayah</b> sudah memiliki harga."
        ];
    }

    /**
     * Update data harga di database.
     *
     * @return void
     */
    public function update(): void
    {
        $this->harga->kendaraan_id = $this->input('kendaraan');
        $this->harga->destinasi_id = $this->input('destinasi');
        $this->harga->nominal = $this->input('nominal');
        $this->harga->save();
    }
}
