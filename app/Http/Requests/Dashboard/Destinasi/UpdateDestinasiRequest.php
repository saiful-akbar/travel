<?php

namespace App\Http\Requests\Dashboard\Destinasi;

use App\Http\Requests\UpdateRequest;
use App\Models\Paket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDestinasiRequest extends FormRequest implements UpdateRequest
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
            'paket_id' => 'required|exists:paket,id',
            'wilayah' => [
                'required',
                'string',
                'max:200',
                Rule::unique('destinasi', 'wilayah')
                    ->ignore($this->destinasi->id, 'id')
                    ->where('paket_id', $this->input('paket_id')),
            ]
        ];
    }

    /**
     * Pesan kesalahan validasi.
     *
     * @return array
     */
    public function messages(): array
    {
        $paket = Paket::find($this->input('paket_id'));

        return [
            'wilayah.unique' => 'Wilayah ' . $this->input('wilayah') . ' dengan paket ' . $paket->nama . ' sudah ada.',
        ];
    }

    /**
     * Update data destinasi.
     *
     * @return void
     */
    public function update(): void
    {
        $this->destinasi->paket_id = $this->input('paket_id');
        $this->destinasi->wilayah = $this->input('wilayah');
        $this->destinasi->jumlah_hari = $this->input('jumlah_hari');
        $this->destinasi->aktif = $this->input('status');
        $this->destinasi->save();
    }
}
