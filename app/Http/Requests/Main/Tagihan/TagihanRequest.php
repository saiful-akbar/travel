<?php

namespace App\Http\Requests\Main\Tagihan;

use App\Models\Tagihan;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DataTableRequest;
use Illuminate\Foundation\Http\FormRequest;

class TagihanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Mengambil data tagihan
     *
     * @return JsonResponse
     */
    public function getData()
    {
        return Tagihan::whereRelation('pesanan', 'pesanan.user_id', '=', user()->id)
            ->with('pesanan')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
