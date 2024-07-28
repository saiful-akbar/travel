<?php

namespace App\Http\Requests\Dashboard\Destinasi;

use App\Models\Paket;
use App\Models\Destinasi;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class StoreDestinasiRequest extends FormRequest implements StoreRequest
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
                Rule::unique('destinasi', 'wilayah')->where('paket_id', $this->input('paket_id')),
            ],
            'jumlah_hari' => 'required|numeric|min:1|max:1000',
            'status' => 'required|boolean',
        ];
    }

    /**
     * Pesan kesahalan validasi.
     *
     * @return array
     */
    public function messages(): array
    {
        $paket = Paket::where('id', $this->input('paket_id'))->first();

        return [
            'wilayah.unique' => 'Wilayah ' . $this->input('wilayah') . ' dengan paket ' . $paket->nama . ' sudah ada.'
        ];
    }

    /**
     * Insert data destinasi.
     *
     * @return Model
     */
    public function insert(): Model
    {
        return Destinasi::create([
            'paket_id' => $this->input('paket_id'),
            'wilayah' => $this->input('wilayah'),
            'jumlah_hari' => $this->input('jumlah_hari'),
            'aktif' => $this->input('status'),
        ]);
    }
}
