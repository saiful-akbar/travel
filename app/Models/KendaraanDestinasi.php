<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class KendaraanDestinasi extends Pivot
{
    use HasUlids;

    protected $table = 'kendaraan_destinasi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kendaraan_id',
        'destinasi_id',
        'harga',
        'created_at',
        'updated_at',
    ];
}
