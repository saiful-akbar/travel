<?php

namespace App\Http\Requests\Dashboard\Pembayaran;

use App\Models\Pesanan;
use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class KonfirmasiTagihanPembayaranRequest extends FormRequest implements UpdateRequest
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
            //
        ];
    }

    /**
     * Update sttaus pesanan menjadi dikonfirmasi.
     *
     * @return Returntype
     */
    function update(): void
    {
        Pesanan::where('id', $this->tagihan->pesanan_id)->update([
            'status' => 'Dikonfirmasi'
        ]);
    }
}
