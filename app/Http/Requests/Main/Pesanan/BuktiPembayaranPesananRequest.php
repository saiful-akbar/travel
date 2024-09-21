<?php

namespace App\Http\Requests\Main\Pesanan;

use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class BuktiPembayaranPesananRequest extends FormRequest implements UpdateRequest
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
            'file' => 'required|mimes:png,jpg,jpeg,pdf,docx|max:2048',
            'catatan' => 'required|string|max:500',
        ];
    }

    /**
     * Upload bukti pembayaran
     *
     * @return void
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->pesanan->status = 'Dibayar';
            $this->pesanan->save();

            $this->pesanan->tagihan->tanggal_pembayaran = now();
            $this->pesanan->tagihan->catatan = $this->input('catatan');
            $this->pesanan->tagihan->bukti_pembayaran = $this->file('file')->store('bukti-tagihan', 'public');
            $this->pesanan->tagihan->save();
        });
    }
}
